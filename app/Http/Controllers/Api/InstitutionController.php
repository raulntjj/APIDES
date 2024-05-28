<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\InstitutionRequest;
use App\Services\InstitutionService;

class InstitutionController{
    //Instanciando serviço
    protected $institutionService;
    public function __construct(InstitutionService $institutionService){
        $this->institutionService = $institutionService;
    }

    //Função para obter todas instituições
    public function index(){
        return $this->institutionService->getInstitutions();
    }

    //Função para obter uma instituição
    public function show(int $id){
        return $this->institutionService->getInstitution($id);
    }

    //Função para criar uma instituição
    public function store(InstitutionRequest $request){
        return $this->institutionService->addInstitution($request);
    }

    //Função para editar uma instituição
    public function update(InstitutionRequest $request, int $id){
        return $this->institutionService->updateInstitution($request, $id);
    }

    //Função para excluir uma instituição
    public function destroy(int $id){
        return $this->institutionService->deleteInstitution($id);
    }
}
