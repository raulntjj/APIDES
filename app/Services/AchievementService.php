<?php

namespace App\Services;

use App\Http\Requests\AchievementRequest;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class AchievementService{
    //Função privada utilizada para encontrar os Achievementes ao longo do serviço
    private function findAchievement(int $id){
        //Busca e retorna o Achievemente
        return Achievement::with('participant.user')->findOrFail($id);
    }

    //Função pública utilizada para retornar todos os Achievementes
    public function getAchievements(Request $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request) {
                $achievements = Achievement::with('participant.user');
                if ($request->has('search')) {
                    $search = $request->search;

                    $achievements->where(function ($query) use ($search) {
                        $query->whereHas('participant.user', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%')
                            ->orWhere('last_name', 'like', '%' . $search . '%');
                        })
                        ->orWhere('name', 'like', '%' . $search . '%');
                    });
                }
                // if($request->get('getAll', false)){
                //     return $achievements->get();
                // }
                // //Retornando todos Achievementes e o código de respostas
                // $page = $request->get('page', 1);
                // $perPage = $request->get('perPage', 10);
                // return $achievements->paginate(10, ['*'], 'page', $page);
                return response()->json($achievements->get(), 200);
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
                return response()->json(['Success' => 'Achievement deleted'], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Achievement', 'Details' => $e->getMessage()], 404);
        }
    }
}
