<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ScheduleRequest;
use App\Services\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController{
    //Instanciando serviço
    protected $scheduleService;
    public function __construct(ScheduleService $scheduleService){
        $this->scheduleService = $scheduleService;
    }

    //Função para obter todas agendas
    public function index(Request $request){
        return $this->scheduleService->getSchedules($request);
    }

    //Função para obter uma agenda
    public function show(int $id){
        return $this->scheduleService->getSchedule($id);
    }

    //Função para criar uma agenda
    public function store(ScheduleRequest $request){
        return $this->scheduleService->addSchedule($request);
    }

    //Função para editar uma agenda
    public function update(ScheduleRequest $request, int $id){
        return $this->scheduleService->updateSchedule($request, $id);
    }

    //Função para excluir uma agenda
    public function destroy(int $id){
        return $this->scheduleService->deleteSchedule($id);
    }
}
