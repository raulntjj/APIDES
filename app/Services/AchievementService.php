<?php

namespace App\Services;

use App\Http\Requests\AchievementRequest;
use App\Models\Achievement;
use Exception;
use Illuminate\Support\Facades\DB;

class AchievementService{
    //Função privada utilizada para encontrar os Achievementes ao longo do serviço
    private function findAchievement(int $id){
        //Busca e retorna o Achievemente
        return Achievement::findOrFail($id);
    }

    //Função pública utilizada para retornar todos os Achievementes
    public function getAchievements(){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () {
                //Retornando todos Achievementes e o código de respostas
                return response()->json(Achievement::all(), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all Achievements', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um Achievemente
    public function getAchievement(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornando Achievemente encontrado com suas informações de endereço e o código de respostas
                $achivement = $this->findAchievement($id);
                return response()->json([
                    $achivement
                ], 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get Achievement', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um Achievemente
    public function addAchievement(AchievementRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                $achivement = Achievement::create($request->only(
                    'participant_id',
                    'name',
                ));
                //Retornando Achievemente criado com suas informações de endereço e o código de respostas
                return response()->json($achivement, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add Achievement', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar um Achievemente
    public function updateAchievement(AchievementRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando o Achievemente
                $achivement = $this->findAchievement($id);

                //Atualizando dados do Achievemente e salvando utilizando o método fill
                $achivement->fill($request->only(
                    //Explicitando váriaveis
                    'participant_id',
                    'name',
                ))->save();

                //Retornando Achievemente atualizado com suas informações de endereço e o código de respostas
                return response()->json($achivement, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update Achievement', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um Achievemente
    public function deleteAchievement(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando o Achievemente
                $achivement = $this->findAchievement($id);
                //Deletando Achievemente
                $achivement->delete();

                //retornando resposta json
                return response()->json(["Achievement deleted"], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Achievement', 'Details' => $e->getMessage()], 404);
        }
    }
}
