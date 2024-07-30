<?php

namespace App\Services;

use App\Http\Requests\SubCriterionRequest;
use App\Models\SubCriterion;
use Exception;
use Illuminate\Support\Facades\DB;

class SubCriterionService{
    //Função privada utilizada para encontrar os criterios ao longo do serviço
    private function findSubCriterion(int $id){
        //Busca e retorna o criterio
        return SubCriterion::with('criterion', 'items')->findOrFail($id);
    }

    //Função pública utilizada para retornar todos os criterios
    public function getSubCriteria(){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () {
                //Retornando todos criterios e o código de respostas
                return response()->json(SubCriterion::with('criterion', 'items')->get(), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all Sub Criteria', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um criterio
    public function getSubCriterion(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornando criterio encontrado com suas informações de endereço e o código de respostas
                return response()->json($this->findSubCriterion($id), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get Sub Criterion', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um criterio
    public function addSubCriterion(SubCriterionRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                //Criando criterio
                $subCriterion = SubCriterion::create($request->only(
                    //Foi deixado o request->only() no lugar do request->all()
                    //Para deixar mais explícito e descritivo em relação as variavéis que estão sendo utilizadas etc..
                    'criterion_id',
                    'name',
                    'points',
                ));

                //Retornando criterio criado com suas informações de endereço e o código de respostas
                return response()->json($subCriterion, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add Sub Criterion', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar um criterio
    public function updateSubCriterion(SubCriterionRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando o criterio
                $subCriterion = $this->findSubCriterion($id);

                //Atualizando dados do criterio e salvando utilizando o método fill
                $subCriterion->fill($request->only(
                    //Explicitando váriaveis
                    'criterion_id',
                    'name',
                    'points',
                ))->save();

                //Retornando criterio atualizado com suas informações de endereço e o código de respostas
                return response()->json($subCriterion, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update Sub Criterion', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um criterio
    public function deleteSubCriterion(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando o criterio
                $subCriterion = $this->findSubCriterion($id);
                //Deletando criterio
                $subCriterion->delete();

                //retornando resposta json
                return response()->json(["Sub Criterion deleted"], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Sub Criterion', 'Details' => $e->getMessage()], 404);
        }
    }
}
