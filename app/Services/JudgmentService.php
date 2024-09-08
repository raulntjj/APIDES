<?php

namespace App\Services;

use App\Http\Requests\JudgmentRequest;
use App\Models\Judgment;
use App\Models\Item;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class JudgmentService{
    //Função privada utilizada para encontrar os julgamentos ao longo do serviço
    private function findJudgment(int $id){
        //Busca e retorna o julgamento
        return Judgment::with('item.subcriterion.criterion', 'evaluation.modality', 'evaluation.eventday.event', 'evaluation.participant.user',
            'evaluation.participant.team', 'evaluation.participant.modality', 'evaluation.participant.institution', 'evaluation.judge')->findOrFail($id);
    }

    //Função pública utilizada para retornar todos os julgamentos
    public function getJudgments(Request $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request) {
                //Retornando todos julgamentos e o código de respostas
                $judgemnts = Judgment::with('item.subcriterion.criterion', 'evaluation.modality', 'evaluation.eventday.event', 'evaluation.participant.user',
                'evaluation.participant.team', 'evaluation.participant.modality', 'evaluation.participant.institution', 'evaluation.judge');

                if ($request->has('search')) {
                    $search = $request->search;

                    $judgemnts->where(function ($query) use ($search) {
                        $query->whereHas('item.subcriterion.criterion', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('item.subcriterion', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('item', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('evaluation.modality', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('evaluation.eventday.event', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('evaluation.judge', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('evaluation.participant.user', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('evaluation.participant.user', function ($q) use ($search) {
                            $q->where('last_name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('evaluation.eventday', function ($q) use ($search) {
                            $q->where('date', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('evaluation.participant.team', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        });
                    });
                }

                $page = $request->get('page', 1);
                $perPage = $request->get('perPage', 10);
                return $judgemnts->paginate($perPage, ['*'], 'page', $page);
                // return response()->json($judgemnts->get(), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all Criteria', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um julgamento
    public function getJudgment(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornando julgamento encontrado com suas informações de endereço e o código de respostas
                return response()->json($this->findJudgment($id), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get Judgment', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um julgamento
    public function addJudgment(JudgmentRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                if(! $item = Item::where('id', $request->item_id)->first()){
                    return response()->json([
                        'error' => 'Não foi possível armazenar julgamento',
                        'details' => 'Item não existente'
                    ]);
                }
                if($item['aspect'] === 'quantitative'){
                    if($request->score != null){
                        return response()->json([
                            'error' => 'Não foi possível armazenar julgamento',
                            'details' => 'Julgamentos em items quantitativos deve ter uma quantidade de erros e acertos.'
                        ]);
                    }
                    //Lógica para cálculo de score
                    $attempt = $request->correct_attempt + $request->fail_attempt;
                    $score = (($request->correct_attempt - ($request->fail_attempt * $item['weight'])) / $attempt) * 10;
                } else{
                    $score = $request->score;
                    $attempt = null;
                }

                //Criando julgamento
                $Judgment = Judgment::create([
                    'item_id' => $request->item_id,
                    'evaluation_id' => $request->evaluation_id,
                    'correct_attempt' => $request->correct_attempt,
                    'fail_attempt' => $request->fail_attempt,
                    'attempt' => $attempt,
                    'score' => $score,
                ]);

                //Retornando julgamento criado com suas informações de endereço e o código de respostas
                return response()->json($Judgment, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add Judgment', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar um julgamento
    public function updateJudgment(JudgmentRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando o julgamento
                $judgment = $this->findJudgment($id);
                $item = Item::where('id', $request->item_id)->first()->toArray();
                if($item['aspect'] === 'measurable'){
                    //Lógica para cálculo de score
                    $attempt = $request->correct_attempt + $request->fail_attempt;
                    $score = (($request->correct_attempt - ($request->fail_attempt * $item['weight'])) / $attempt) * 10;
                } else{
                    $score = $request->score;
                    $attempt = null;
                }

                //Atualizando dados do julgamento e salvando utilizando o método fill
                $judgment->fill(
                    array_merge(
                        $request->only(
                            'item_id',
                            'evaluation_id',
                            'correct_attempt',
                            'fail_attempt',
                        ),
                        ['attempt' => $attempt],
                        ['score' => $score],
                    )
                )->save();

                //Retornando julgamento atualizado com suas informações de endereço e o código de respostas
                return response()->json($judgment, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update Judgment', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um julgamento
    public function deleteJudgment(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando o julgamento
                $Judgment = $this->findJudgment($id);
                //Deletando julgamento
                $Judgment->delete();

                //retornando resposta json
                return response()->json(['Success' => 'Judgment deleted'], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Judgment', 'Details' => $e->getMessage()], 404);
        }
    }
}
