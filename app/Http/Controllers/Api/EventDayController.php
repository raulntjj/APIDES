<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreEventDayRequest;
use App\Http\Requests\UpdateEventDayRequest;
use App\Services\EventDayService;

class EventDayController{
    //Instanciando serviço
    protected $eventDayService;
    public function __construct(EventDayService $eventDayService){
        $this->eventDayService = $eventDayService;
    }

    //Função para obter todos dia de eventos
    public function index(){
        return $this->eventDayService->getDays();
    }

    //Função para obter um dia de evento
    public function show(int $id){
        return $this->eventDayService->getDay($id);
    }

    //Função para criar um dia de evento
    public function store(StoreEventDayRequest $request){
        return $this->eventDayService->addDay($request);
    }

    //Função para editar um dia de evento
    public function update(UpdateEventDayRequest $request, int $id){
        return $this->eventDayService->updateDay($request, $id);
    }

    //Função para excluir um dia de evento
    public function destroy(int $id){
        return $this->eventDayService->deleteDay($id);
    }
}
