<?php

namespace App\Services;

use App\Http\Requests\SubcriterionRequest;
use App\Models\Subcriterion;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class SubcriterionService{
    //Função privada utilizada para encontrar os criterios ao longo do serviço
    private function findSubcriterion(int $id){
        //Busca e retorna o criterio
        return Subcriterion::with('criterion', 'items')->findOrFail($id);
    }

    //Função pública utilizada para retornar todos os criterios
    public function getSubcriteria(Request $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function ()  use ($request) {
                //Retornando todos criterios e o código de respostas
                $subcriterionQuery = Subcriterion::with('criterion', 'items');
                if ($request->has('search')) {
                    $search = $request->search;

                    $subcriterionQuery->where(function ($query) use ($search) {
                        $query->whereHas('criterion', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('items', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhere('name', 'like', '%' . $search . '%');
                    });
                }
                //Retornando todos itenss e o código de respostas
                return response()->json($subcriterionQuery->get(), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all Subcriteria', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um criterio
    public function getSubcriterion(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornando criterio encontrado com suas informações de endereço e o código de respostas
                return response()->json($this->findSubcriterion($id), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get Subcriterion', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um criterio
    public function addSubcriterion(SubcriterionRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                //Criando criterio
                $subcriterion = Subcriterion::create($request->only(
                    //Foi deixado o request->only() no lugar do request->all()
                    //Para deixar mais explícito e descritivo em relação as variavéis que estão sendo utilizadas etc..
                    'criterion_id',
                    'name',
                    'points',
                ));

                //Retornando criterio criado com suas informações de endereço e o código de respostas
                return response()->json($subcriterion, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add Subcriterion', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar um criterio
    public function updateSubcriterion(SubcriterionRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando o criterio
                $subcriterion = $this->findSubcriterion($id);

                //Atualizando dados do criterio e salvando utilizando o método fill
                $subcriterion->fill($request->only(
                    //Explicitando váriaveis
                    'criterion_id',
                    'name',
                    'points',
                ))->save();

                //Retornando criterio atualizado com suas informações de endereço e o código de respostas
                return response()->json($subcriterion, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update Subcriterion', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um criterio
    public function deleteSubcriterion(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando o criterio
                $subcriterion = $this->findSubcriterion($id);
                //Deletando criterio
                $subcriterion->delete();

                //retornando resposta json
                return response()->json(['Success' => 'Subcriterion deleted'], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Subcriterion', 'Details' => $e->getMessage()], 404);
        }
    }
}
