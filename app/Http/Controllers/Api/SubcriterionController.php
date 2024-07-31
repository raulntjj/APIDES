<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SubcriterionRequest;
use App\Services\SubcriterionService;
use Illuminate\Http\Request;

class SubcriterionController{
    //Instanciando serviço
    protected $subcriterionService;
    public function __construct(SubcriterionService $subcriterionService){
        $this->subcriterionService = $subcriterionService;
    }

    //Função para obter todos sub-criterios
    public function index(Request $request){
        return $this->subcriterionService->getSubcriteria($request);
    }

    //Função para obter um sub-criterio
    public function show(int $id){
        return $this->subcriterionService->getSubcriterion($id);
    }

    //Função para criar um sub-criterio
    public function store(SubcriterionRequest $request){
        return $this->subcriterionService->addSubcriterion($request);
    }

    //Função para editar um sub-criterio
    public function update(SubcriterionRequest $request, int $id){
        return $this->subcriterionService->updateSubcriterion($request, $id);
    }

    //Função para excluir um sub-criterio
    public function destroy(int $id){
        return $this->subcriterionService->deleteSubcriterion($id);
    }
}
