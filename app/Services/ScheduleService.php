<?php

namespace App\Services;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Exception;
use Illuminate\Support\Facades\DB;

class ScheduleService{
    //Função privada utilizada para encontrar as agendas ao longo do serviço
    private function findSchedule(int $id){
        //Busca e retorna a agenda
        return Schedule::findOrFail($id);
    }

    //Função pública utilizada para retornar todos as agenda
    public function getSchedules(){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () {
                //Retornando todas agendas e o código de respostas
                return response()->json(Schedule::all(), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all modalities', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um agenda
    public function getSchedule(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornanda agenda encontrado com suas informações de endereço e o código de respostas
                $schedule = $this->findSchedule($id);
                return response()->json([
                    $schedule,
                    $schedule->subCriterion,
                    $schedule->judge
                ], 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get Schedule', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um agenda
    public function addSchedule(ScheduleRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                //Crianda agenda
                $schedule = Schedule::create($request->only(
                    //Foi deixado o request->only() no lugar do request->all()
                    //Para deixar mais explícito e descritivo em relação as variavéis que estão sendo utilizadas etc..
                    'subCriterion_id',
                    'judge_id',
                    'date'
                ));

                //Retornanda agenda criado com suas informações de endereço e o código de respostas
                return response()->json($schedule, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add Schedule', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar um agenda
    public function updateSchedule(ScheduleRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando a agenda
                $schedule = $this->findSchedule($id);

                //Atualizando dados da agenda e salvando utilizando o método fill
                $schedule->fill($request->only(
                    //Explicitando váriaveis
                    'sub_criterion_id',
                    'judge_id',
                    'date'
                ))->save();

                //Retornanda agenda atualizado com suas informações de endereço e o código de respostas
                return response()->json($schedule, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update Schedule', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um agenda
    public function deleteSchedule(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando a agenda
                $schedule = $this->findSchedule($id);
                //Deletando seus endereços
                $schedule->address()->delete();
                //Deletanda agenda
                $schedule->delete();

                //retornando resposta json
                return response()->json(["Schedule deleted"], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete Schedule', 'Details' => $e->getMessage()], 404);
        }
    }

    //Função pública utilizada para retornar endereço da agenda
    public function getAddress(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                return response()->json($this->findSchedule($id)->address, 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get Schedule', 'Details' => $e->getMessage()], 400);
        }
    }
}
