<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CriterionRequest;
use App\Services\CriterionService;
use Illuminate\Http\Request;

class CriterionController{
    //Instanciando serviço
    protected $criterionService;
    public function __construct(CriterionService $criterionService){
        $this->criterionService = $criterionService;
    }

    //Função para obter todos criterios
    public function index(Request $request){
        return $this->criterionService->getCriteria($request);
    }

    //Função para obter um criterio
    public function show(int $id){
        return $this->criterionService->getCriterion($id);
    }

    //Função para criar um criterio
    public function store(CriterionRequest $request){
        return $this->criterionService->addCriterion($request);
    }

    //Função para editar um criterio
    public function update(CriterionRequest $request, int $id){
        return $this->criterionService->updateCriterion($request, $id);
    }

    //Função para excluir um criterio
    public function destroy(int $id){
        return $this->criterionService->deleteCriterion($id);
    }
}
