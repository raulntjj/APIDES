<?php

namespace App\Services;

use App\Http\Requests\StoreEventDayRequest;
use App\Http\Requests\UpdateEventDayRequest;
use App\Models\EventDay;
use Exception;
use Illuminate\Support\Facades\DB;

class EventDayService{
    //Função privada utilizada para encontrar os dias de eventos ao longo do serviço
    private function findDayEvent(int $id){
        //Busca e retorna o dia de evento
        return EventDay::findOrFail($id);
    }

    //Função pública utilizada para retornar todos os dia de evento
    public function getDays(){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () {
                //Retornando todos dia de eventos e o código de respostas
                return response()->json(EventDay::with('event')->get(), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all event days', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um dia de evento
    public function getDay(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornando dia de evento encontrado com suas informações de endereço e o código de respostas
                return response()->json(EventDay::whereId($id)->with('event')->get(), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get event day', 'Details' => $e->getMessage()], 400);
        }
    }

    private function currentIndex($date){
        $index = EventDay::where('date', $date)->count();
        return $index + 1;
    }

    //Função pública utilizada para atualizar e retornar um dia de evento
    public function addDay(StoreEventDayRequest $request){
        //Tratativa de erros
        try{
            $index = $this->currentIndex($request->date);
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                //Criando dia de evento
                $eventDay = EventDay::create([
                    'eventDay_id' => $request->eventDay_id,
                    'date' => $request->date,
                    'index' => $index
                ]);

                //Retornando dia de evento criado com suas informações de endereço e o código de respostas
                return response()->json($eventDay, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add event day', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um dia de evento
    public function updateDay(UpdateEventDayRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando o dia de evento
                $eventDay = $this->findDayEvent($id);

                //Atualizando dados do dia de evento e salvando utilizando o método fill
                $eventDay->fill($request->only(
                    'eventDay_id',
                    'date',
                    'index'
                ))->save();

                //Retornando dia de evento atualizado com suas informações de endereço e o código de respostas
                return response()->json($eventDay, 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update event day', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um dia de evento
    public function deleteDay(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando o dia de evento
                $eventDay = $this->findDayEvent($id);
                //Deletando dia de evento
                $eventDay->delete();

                //retornando resposta json
                return response()->json('Event deleted', 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete event day', 'Details' => $e->getMessage()], 404);
        }
    }
}
