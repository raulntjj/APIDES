<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ParticipantRequest;
use App\Services\ParticipantService;
use Illuminate\Http\Request;

class ParticipantController{
    //Instanciando serviço
    protected $participantService;
    public function __construct(ParticipantService $participantService){
        $this->participantService = $participantService;
    }

    //Função para obter todos participantes
    public function index(Request $request){
        return $this->participantService->getParticipants($request);
    }

    //Função para obter um participante
    public function show(int $id){
        return $this->participantService->getParticipant($id);
    }

    //Função para criar um participante
    public function store(ParticipantRequest $request){
        return $this->participantService->addParticipant($request);
    }

    //Função para editar um participante
    public function update(ParticipantRequest $request, int $id){
        return $this->participantService->updateParticipant($request, $id);
    }

    //Função para excluir um participante
    public function destroy(int $id){
        return $this->participantService->deleteParticipant($id);
    }
}
