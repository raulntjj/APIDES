<?php

namespace App\Services;

use App\Http\Requests\ModalityRequest;
use App\Models\Modality;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class ModalityService{
    //Função privada utilizada para encontrar as modalidades ao longo do serviço
    private function findModality(int $id){
        //Busca e retorna a modalidade
        return Modality::findOrFail($id);
    }

    //Função pública utilizada para retornar todos as modalidade
    public function getModalities(Request $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request) {
                //Retornando todas modalidades e o código de respostas
                if ($request->has('search')) {
                    $search = $request->search;

                    return response()->json(Modality::where(function ($query) use ($search) {
                        $query->Where('name', 'like', '%' . $search . '%');
                    })->get(), 200);
                } else {
                    return response()->json(Modality::all(), 200);
                }
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all modalities', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um modalidade
    public function getModality(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornanda modalidade encontrado com suas informações de endereço e o código de respostas
                return response()->json($this->findModality($id), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get modality', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um modalidade
    public function addModality(ModalityRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                //Crianda modalidade
                $modality = Modality::create($request->only(
                    //Foi deixado o request->only() no lugar do request->all()
                    //Para deixar mais explícito e descritivo em relação as variavéis que estão sendo utilizadas etc..
                    'name',
                    'photo'
                ));

                //Retornanda modalidade criado com suas informações de endereço e o código de respostas
                return response()->json($modality, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add modality', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar um modalidade
    public function updateModality(ModalityRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando a modalidade
                $modality = $this->findModality($id);

                //Atualizando dados da modalidade e salvando utilizando o método fill
                $modality->fill($request->only(
                    //Explicitando váriaveis
                    'name',
                    'photo'
                ))->save();

                //Retornanda modalidade atualizado com suas informações de endereço e o código de respostas
                return response()->json($modality, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update modality', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um modalidade
    public function deleteModality(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando a modalidade
                $modality = $this->findModality($id);

                //Deletanda modalidade
                $modality->delete();

                //retornando resposta json
                return response()->json(['Success' => 'Modality deleted'], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete modality', 'Details' => $e->getMessage()], 404);
        }
    }

    //Função pública utilizada para retornar endereço da modalidade
    public function getAddress(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                return response()->json($this->findModality($id)->address, 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get modality', 'Details' => $e->getMessage()], 400);
        }
    }
}
