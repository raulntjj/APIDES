<?php

namespace App\Services;

use App\Http\Requests\ScoreRequest;
use App\Models\Score;
use Exception;
use Illuminate\Support\Facades\DB;

class ScoreService{
    //Função privada utilizada para encontrar as pontuações ao longo do serviço
    private function findScore(int $id){
        //Busca e retorna a pontuação
        return Score::findOrFail($id);
    }

    //Função pública utilizada para retornar todos as pontuação
    public function getScores(){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () {
                //Retornando todas pontuações e o código de respostas
                return response()->json(Score::all(), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all modalities', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um pontuação
    public function getScore(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornando pontuação encontrado com suas informações e o código de respostas
                $score = Score::find($id);
                $participant = $score->participant;
                $evaluation = $score->evaluation;
                return response()->json([
                    $score,
                    $participant
                        ->with('team')
                        ->with('institution')
                        ->with('modality')->get(),
                    $evaluation
                        ->with('event')
                        ->with('modality')
                        ->with('criterion')
                        ->with('sub_criterion')
                        ->with('item')
                        ->with('judgment')->get()
                ], 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get Score', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um pontuação
    public function addScore(ScoreRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                //Crianda pontuação
                $score = Score::create($request->only(
                    //Foi deixado o request->only() no lugar do request->all()
                    //Para deixar mais explícito e descritivo em relação as variavéis que estão sendo utilizadas etc..
                    'evaluation_id',
                    'participant_id',
                    'points'
                ));

                //Retornanda pontuação criado com suas informações de endereço e o código de respostas
                return response()->json($score, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add Score', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar um pontuação
    public function updateScore(ScoreRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando a pontuação
                $score = $this->findScore($id);

                //Atualizando dados da pontuação e salvando utilizando o método fill
                $score->fill($request->only(
                    //Explicitando váriaveis
                    'evaluation_id',
                    'participant_id',
                    'points'
                ))->save();

                //Retornanda pontuação atualizado com suas informações de endereço e o código de respostas
                return response()->json($score, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update Score', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um pontuação
    public function deleteScore(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando a pontuação
                $score = $this->findScore($id);
                //Deletando seus endereços
                $score->address()->delete();
                //Deletanda pontuação
                $score->delete();

                //retornando resposta json
                return response()->json(["Score deleted"], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Score', 'Details' => $e->getMessage()], 404);
        }
    }

    //Função pública utilizada para retornar endereço da pontuação
    public function getAddress(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                return response()->json($this->findScore($id)->address, 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get Score', 'Details' => $e->getMessage()], 400);
        }
    }
}
