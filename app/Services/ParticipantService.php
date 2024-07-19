<?php

namespace App\Services;

use App\Http\Requests\ParticipantRequest;
use App\Models\Participant;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class ParticipantService{
    //Função privada utilizada para encontrar os participantes ao longo do serviço
    private function findParticipant(int $id){
        //Busca e retorna o participante
        return Participant::findOrFail($id);
    }

    //Função pública utilizada para retornar todos os participantes
    public function getParticipants(Request $request){
        //Tratativa de erros
        try {
            $participants = Participant::with('team', 'institution', 'modality', 'user');

            if ($request->has('search')) {
                $participants->where(function($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                          ->orWhere('lastName', 'like', '%' . $request->search . '%');
                });
            }

            if ($request->has('team_id')) {
                $participants->where('team_id', $request->team_id);
            }
            if ($request->has('institution_id')) {
                $participants->where('institution_id', $request->institution_id);
            }
            if ($request->has('modality_id')) {
                $participants->where('modality_id', $request->modality_id);
            }
            if ($request->has('gender')) {
                $participants->where('gender', $request->gender);
            }
            if ($request->has('position')) {
                $participants->where('position', $request->position);
            }

            $result = $participants->orderBy('name')->get();
            return $result;
        }
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all Participants', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um participante
    public function getParticipant(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornando participante encontrado com suas informações de endereço e o código de respostas
                $participant = $this->findParticipant($id);
                return response()->json([
                    $participant,
                    $participant->team,
                    $participant->institution,
                    $participant->modality
                ], 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get Participant', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um participante
    public function addParticipant(StoreParticipantRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                $user->participant()->create($request->only(
                    //Foi deixado o request->only() no lugar do request->all()
                    //Para deixar mais explícito e descritivo em relação as variavéis que estão sendo utilizadas etc..
                    'user_id',
                    'team_id',
                    'institution_id',
                    'modality_id',
                    'position',
                ));

                //Retornando participante criado com suas informações de endereço e o código de respostas
                return response()->json($participant, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add Participant', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar um participante
    public function updateParticipant(ParticipantRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando o participante
                $participant = $this->findParticipant($id);

                //Atualizando dados do participante e salvando utilizando o método fill
                $participant->fill($request->only(
                    //Explicitando váriaveis
                    'user_id',
                    'team_id',
                    'institution_id',
                    'modality_id',
                    'position',
                ))->save();

                //Retornando participante atualizado com suas informações de endereço e o código de respostas
                return response()->json($participant, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update Participant', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um participante
    public function deleteParticipant(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando o participante
                $participant = $this->findParticipant($id);
                //Deletando participante
                $participant->delete();

                //retornando resposta json
                return response()->json(["Participant deleted"], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Participant', 'Details' => $e->getMessage()], 404);
        }
    }
}
