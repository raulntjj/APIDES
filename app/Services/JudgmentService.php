<?php

namespace App\Services;

use App\Http\Requests\JudgmentRequest;
use App\Models\Judgment;
use Exception;
use Illuminate\Support\Facades\DB;

class JudgmentService{
    //Função privada utilizada para encontrar os julgamentos ao longo do serviço
    private function findJudgment(int $id){
        //Busca e retorna o julgamento
        return Judgment::findOrFail($id);
    }

    //Função pública utilizada para retornar todos os julgamentos
    public function getJudgments(){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () {
                //Retornando todos julgamentos e o código de respostas
                return response()->json(Judgment::with('item')->get(), 200);
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
                return response()->json(Judgment::whereId($id)->with('item')->get(), 200);
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
                //Criando julgamento
                $Judgment = Judgment::create($request->only(
                    //Foi deixado o request->only() no lugar do request->all()
                    //Para deixar mais explícito e descritivo em relação as variavéis que estão sendo utilizadas etc..
                    'item_id',
                    'scores',
                    'aspect'
                ));

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
                $Judgment = $this->findJudgment($id);

                //Atualizando dados do julgamento e salvando utilizando o método fill
                $Judgment->fill($request->only(
                    //Explicitando váriaveis
                    'item_id',
                    'scores',
                    'aspect'
                ))->save();

                //Retornando julgamento atualizado com suas informações de endereço e o código de respostas
                return response()->json($Judgment, 201);
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
                return response()->json(["Judgment deleted"], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Judgment', 'Details' => $e->getMessage()], 404);
        }
    }
}
