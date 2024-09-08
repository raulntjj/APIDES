<?php

namespace App\Services;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class EventService{
    //Função privada utilizada para encontrar os eventos ao longo do serviço
    private function findEvent(int $id){
        //Busca e retorna o evento
        return Event::with('days.evaluations.participant.user', 'days.event', 'address')->orderBy('name')->findOrFail($id);
    }

    //Função pública utilizada para retornar todos os evento
    public function getEvents(Request $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request) {
                $events = Event::with('days.evaluations.participant.user', 'days.event', 'address');
                if ($request->has('search')) {
                    $search = $request->search;

                    $events->where(function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('type', 'like', '%' . $search . '%');
                    });
                }
                $events->join('event_days', 'events.id', '=', 'event_days.event_id')
                    ->orderBy('date');

                //Retornando todos eventos e o código de respostas
                $page = $request->get('page', 1);
                $perPage = $request->get('perPage', 10);
                return $events->paginate($perPage, ['*'], 'page', $page);
                // return response()->json($events->get(), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get all events', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para retornar um evento
    public function getEvent(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Retornando evento encontrado com suas informações de endereço e o código de respostas
                return response()->json($this->findEvent($id), 200);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to get event', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para atualizar e retornar um evento
    public function addEvent(StoreEventRequest $request){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request){
                //Criando evento
                $event = Event::create($request->only(
                    //Foi deixado o request->only() no lugar do request->all()
                    //Para deixar mais explícito e descritivo em relação as variavéis que estão sendo utilizadas etc..
                    'name',
                    'type',
                    'logo',
                ));

                //Criando endereço do evento
                $event->address()->create($request->only(
                    //Explicitando váriaveis
                    'address',
                    'number',
                    'neighborhood',
                    'city',
                    'state',
                    'country',
                    'cep'
                ));

                $event->days()->create([
                    'date' => $request->date,
                    'start_hour' => $request->start_hour,
                    'index' => 1
                ]);

                //Retornando evento criado com suas informações de endereço e o código de respostas
                return response()->json($event->load('address', 'days'), 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to add event', 'Details' => $e->getMessage()], 400);
        }
        }

    //Função pública utilizada para atualizar e retornar um evento
    public function updateEvent(UpdateEventRequest $request, int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($request, $id){
                //Buscando o evento
                $event = $this->findEvent($id);
                //Atualizando dados do evento e salvando utilizando o método fill
                $event->fill($request->only(
                    //Explicitando váriaveis
                    'name',
                    'type',
                    'logo'
                ))->save();

                //Atualizando dados de endereço
                $event->address->fill($request->only(
                    //Explicitando váriaveis
                    'address',
                    'number',
                    'neighborhood',
                    'city',
                    'state',
                    'country',
                    'cep'
                ))->save();

                //Retornando evento atualizado com suas informações de endereço e o código de respostas
                return response()->json($event->load('address', 'days'), 201);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to update event', 'Details' => $e->getMessage()], 400);
        }
    }

    //Função pública utilizada para excluir um evento
    public function deleteEvent(int $id){
        //Tratativa de erros
        try{
            //DB transaction para lidar com transações de dados com o banco de dados
            return DB::transaction(function () use ($id){
                //Buscando o evento
                $event = $this->findEvent($id);
                //Deletando seus endereços
                $event->address()->delete();
                //Deletando evento
                $event->delete();

                //retornando resposta json
                return response()->json(['Event' => 'Participant deleted'], 204);
            });
        //Não foi utilizado o ModelNotFoundException pois a Exception genérica exibe um detalhamento de erro resumido e acertivo
        } catch(Exception $e){
            //Retorna mensagem de erro com flag e mensagem captada pelo exception
            return response()->json(['Error' => 'Failed to delete event', 'Details' => $e->getMessage()], 404);
        }
    }
}
