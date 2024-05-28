<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ModalityRequest;
use App\Services\ModalityService;

class ModalityController{
    //Instanciando serviço
    protected $modalityService;
    public function __construct(ModalityService $modalityService){
        $this->modalityService = $modalityService;
    }

    //Função para obter todas modalidades
    public function index(){
        return $this->modalityService->getModalities();
    }

    //Função para obter uma modalidade
    public function show(int $id){
        return $this->modalityService->getModality($id);
    }

    //Função para criar uma modalidade
    public function store(ModalityRequest $request){
        return $this->modalityService->addModality($request);
    }

    //Função para editar uma modalidade
    public function update(ModalityRequest $request, int $id){
        return $this->modalityService->updateModality($request, $id);
    }

    //Função para excluir uma modalidade
    public function destroy(int $id){
        return $this->modalityService->deleteModality($id);
    }
}
