<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use App\Services\ParticipantService;
use Illuminate\Http\Request;

class ParticipantController{
    //Instanciando serviço
    protected $participantService;
    public function __construct(ParticipantService $participantService){
        $this->participantService = $participantService;
    }

    public function getAllParticipants(Request $request){
        return $this->participantService->getAllParticipants($request);
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
    public function store(StoreParticipantRequest $request){
        return $this->participantService->addParticipant($request);
    }

    //Função para editar um participante
    public function update(UpdateParticipantRequest $request, int $id){
        return $this->participantService->updateParticipant($request, $id);
    }

    //Função para excluir um participante
    public function destroy(int $id){
        return $this->participantService->deleteParticipant($id);
    }
}
