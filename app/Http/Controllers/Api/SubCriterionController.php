<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SubCriterionRequest;
use App\Services\SubCriterionService;

class SubCriterionController{
    //Instanciando serviço
    protected $subCriterionService;
    public function __construct(SubCriterionService $subCriterionService){
        $this->subCriterionService = $subCriterionService;
    }

    //Função para obter todos sub-criterios
    public function index(){
        return $this->subCriterionService->getSubCriteria();
    }

    //Função para obter um sub-criterio
    public function show(int $id){
        return $this->subCriterionService->getSubCriterion($id);
    }

    //Função para criar um sub-criterio
    public function store(SubCriterionRequest $request){
        return $this->subCriterionService->addSubCriterion($request);
    }

    //Função para editar um sub-criterio
    public function update(SubCriterionRequest $request, int $id){
        return $this->subCriterionService->updateSubCriterion($request, $id);
    }

    //Função para excluir um sub-criterio
    public function destroy(int $id){
        return $this->subCriterionService->deleteSubCriterion($id);
    }
}
