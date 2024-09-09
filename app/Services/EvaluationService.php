<?php

namespace App\Services;

use App\Http\Requests\EvaluationRequest;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class EvaluationService{
    //Função privada utilizada para encontrar as avaliações ao longo do serviço
    private function findEvaluation(int $id){
        //Busca e retorna a avaliação
        return Evaluation::with('judgments.item.subcriterion.criterion', 'participant.user', 'participant.team',
                                'participant.institution', 'participant.modality', 'modality', 'eventday.event', 'judge')->orderBy('participant_id')->findOrFail($id);
    }

    //Função pública utilizada para retornar todos as avaliação
    public function getEvaluations(Request $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request) {
                //Retornando todas avaliações e o código de respostas
                $evaluations = Evaluation::with('judgments.item.subcriterion.criterion', 'participant.user', 'participant.team', 'participant.institution',
                                                    'participant.modality', 'modality', 'eventday.event', 'judge')->orderBy('participant_id');

                // Filtro de busca
                if ($request->has('search')) {
                    $search = $request->search;

                    $evaluations->where(function ($query) use ($search) {
                        $query->WhereHas('participant.user', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%')
                            ->orWhere('last_name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('participant.team', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('participant.institution', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('participant.modality', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('modality', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('eventday.event', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('judge', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        });
                    });
                }
                // if($request->get('getAll', false)){
                //     return $evaluation->get();
                // }
                // $page = $request->get('page', 1);
                // $perPage = $request->get('perPage', 10);
                // return $evaluations->paginate($perPage, ['*'], 'page', $page);
                return response()->json($evaluations->get(), 200);
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
                    'event_day_id',
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
                    'event_day_id',
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
                return response()->json(['Success' => 'Evaluation deleted'], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Evaluation', 'Details' => $e->getMessage()], 404);
        }
    }
}
