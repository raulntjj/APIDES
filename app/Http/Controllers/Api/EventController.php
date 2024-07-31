<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\EventRequest;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController{
    //Instanciando serviço
    protected $eventService;
    public function __construct(EventService $eventService){
        $this->eventService = $eventService;
    }

    //Função para obter todos eventos
    public function index(Request $request){
        return $this->eventService->getEvents($request);
    }

    //Função para obter um evento
    public function show(int $id){
        return $this->eventService->getEvent($id);
    }

    //Função para criar um evento
    public function store(EventRequest $request){
        return $this->eventService->addEvent($request);
    }

    //Função para editar um evento
    public function update(EventRequest $request, int $id){
        return $this->eventService->updateEvent($request, $id);
    }

    //Função para excluir um evento
    public function destroy(int $id){
        return $this->eventService->deleteEvent($id);
    }
}
