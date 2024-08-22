<?php

namespace App\Services;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class TeamService{
    //Função privada utilizada para encontrar os times ao longo do serviço
    private function findTeam(int $id){
        //Busca e retorna o time
        return Team::with('participants', 'participants.team', 'participants.modality', 'participants.institution', 'participants.user')->orderBy('name')->findOrFail($id);
    }

    //Função pública utilizada para retornar todos os times
    public function getTeams(Request $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request) {
                $teamQuery = Team::with('participants', 'participants.team', 'participants.modality', 'participants.institution', 'participants.user')->orderBy('name');
                if ($request->has('search')) {
                    $search = $request->search;

                    $teamQuery->where(function ($query) use ($search) {
                        $query->Where('name', 'like', '%' . $search . '%');
                    });
                }
                //Retornando todos times e o código de respostas
                return response()->json($teamQuery->get(), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all Teams', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um time
    public function getTeam(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornando time encontrado com suas informações de endereço e o código de respostas
                return response()->json($this->findTeam($id), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get Team', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um time
    public function addTeam(TeamRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                //Criando time
                $team = Team::create($request->only(
                    //Foi deixado o request->only() no lugar do request->all()
                    //Para deixar mais explícito e descritivo em relação as variavéis que estão sendo utilizadas etc..
                    'name',
                    'logo'
                ));

                //Retornando time criado com suas informações de endereço e o código de respostas
                return response()->json($team, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add Team', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar um time
    public function updateTeam(TeamRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando o time
                $team = $this->findTeam($id);

                //Atualizando dados do time e salvando utilizando o método fill
                $team->fill($request->only(
                    //Explicitando váriaveis
                    'name',
                    'logo'
                ))->save();

                //Retornando time atualizado com suas informações de endereço e o código de respostas
                return response()->json($team, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update Team', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um time
    public function deleteTeam(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando o time
                $team = $this->findTeam($id);
                //Deletando time
                $team->delete();

                //retornando resposta json
                return response()->json(['Success' => 'Team deleted'], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Team', 'Details' => $e->getMessage()], 404);
        }
    }
}
