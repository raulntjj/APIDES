<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\EvaluationRequest;
use App\Services\EvaluationService;

class EvaluationController{
    //Instanciando serviço
    protected $evaluationService;
    public function __construct(EvaluationService $evaluationService){
        $this->evaluationService = $evaluationService;
    }

    //Função para obter todas avaliações
    public function index(){
        return $this->evaluationService->getEvaluations();
    }

    //Função para obter uma avaliação
    public function show(int $id){
        return $this->evaluationService->getEvaluation($id);
    }

    //Função para criar uma avaliação
    public function store(EvaluationRequest $request){
        return $this->evaluationService->addEvaluation($request);
    }

    //Função para editar uma avaliação
    public function update(EvaluationRequest $request, int $id){
        return $this->evaluationService->updateEvaluation($request, $id);
    }

    //Função para excluir uma avaliação
    public function destroy(int $id){
        return $this->evaluationService->deleteEvaluation($id);
    }
}
