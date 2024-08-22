<?php

namespace App\Services;

use App\Http\Requests\CriterionRequest;
use App\Models\Criterion;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class CriterionService{
    //Função privada utilizada para encontrar os criterios ao longo do serviço
    private function findCriterion(int $id){
        //Busca e retorna o criterio
        return Criterion::with('subcriteria.items')->orderBy('name')->findOrFail($id);
    }

    //Função pública utilizada para retornar todos os criterios
    public function getCriteria(Request $request){
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                //Retornando todos criterios e o código de respostas
                if($request->has('search')){
                    $criteria = Criterion::with('subcriteria.items')->orderBy('name')->where('name', 'like', '%' . $request->search . '%')->get();
                } else {
                    $criteria = Criterion::with('subcriteria.items')->orderBy('name')->get();
                }

                //Retornando todos Achievementes e o código de respostas
                return response()->json($criteria, 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all Criteria', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um criterio
    public function getCriterion(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornando criterio encontrado com suas informações de endereço e o código de respostas
                return response()->json($this->findCriterion($id), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get Criterion', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um criterio
    public function addCriterion(CriterionRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                //Criando criterio
                $criterion = Criterion::create($request->only(
                    //Foi deixado o request->only() no lugar do request->all()
                    //Para deixar mais explícito e descritivo em relação as variavéis que estão sendo utilizadas etc..
                    'name',
                    'points'
                ));

                //Retornando criterio criado com suas informações de endereço e o código de respostas
                return response()->json($criterion, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add Criterion', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar um criterio
    public function updateCriterion(CriterionRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando o criterio
                $criterion = $this->findCriterion($id);

                //Atualizando dados do criterio e salvando utilizando o método fill
                $criterion->fill($request->only(
                    //Explicitando váriaveis
                    'name',
                    'points'
                ))->save();

                //Retornando criterio atualizado com suas informações de endereço e o código de respostas
                return response()->json($criterion, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update Criterion', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um criterio
    public function deleteCriterion(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando o criterio
                $criterion = $this->findCriterion($id);
                //Deletando criterio
                $criterion->delete();

                //retornando resposta json
                return response()->json(['Success' => 'Criterion deleted'], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Criterion', 'Details' => $e->getMessage()], 404);
        }
    }
}
