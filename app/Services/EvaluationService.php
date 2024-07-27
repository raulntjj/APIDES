<?php

namespace App\Services;

use App\Http\Requests\EvaluationRequest;
use App\Models\Evaluation;
use Exception;
use Illuminate\Support\Facades\DB;

class EvaluationService{
    //Função privada utilizada para encontrar as avaliações ao longo do serviço
    private function findEvaluation(int $id){
        //Busca e retorna a avaliação
        return Evaluation::findOrFail($id);
    }

    //Função pública utilizada para retornar todos as avaliação
    public function getEvaluations(){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () {
                //Retornando todas avaliações e o código de respostas
                return response()->json(Evaluation::with('judgments', 'participant', 'modality', 'event')->get(), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all Evaluations', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um avaliação
    public function getEvaluation(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornanda avaliação encontrado com suas informações de endereço e o código de respostas
                $evaluation = $this->findEvaluation($id);
                return response()->json([
                    $evaluation
                ], 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get Evaluation', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um avaliação
    public function addEvaluation(EvaluationRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                //Crianda avaliação
                $evaluation = Evaluation::create($request->only(
                    //Foi deixado o request->only() no lugar do request->all()
                    //Para deixar mais explícito e descritivo em relação as variavéis que estão sendo utilizadas etc..
                    'participant_id',
                    'event_id',
                    'modality_id',
                    'judge_id',
                    'date',
                ));

                //Retornanda avaliação criado com suas informações de endereço e o código de respostas
                return response()->json($evaluation, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add Evaluation', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar um avaliação
    public function updateEvaluation(EvaluationRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando a avaliação
                $evaluation = $this->findEvaluation($id);

                //Atualizando dados da avaliação e salvando utilizando o método fill
                $evaluation->fill($request->only(
                    //Explicitando váriaveis
                    'participant_id',
                    'event_id',
                    'modality_id',
                    'judge_id',
                    'date',
                ))->save();

                //Retornanda avaliação atualizado com suas informações de endereço e o código de respostas
                return response()->json($evaluation, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update Evaluation', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um avaliação
    public function deleteEvaluation(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando a avaliação
                $evaluation = $this->findEvaluation($id);
                //Deletanda avaliação
                $evaluation->delete();

                //retornando resposta json
                return response()->json(["Evaluation deleted"], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Evaluation', 'Details' => $e->getMessage()], 404);
        }
    }
}
