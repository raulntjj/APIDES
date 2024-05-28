<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\JudgmentRequest;
use App\Services\JudgmentService;
use App\Models\Judgment;

class JudgmentController{
    //Instanciando serviço
    protected $judgmentService;
    public function __construct(JudgmentService $judgmentService){
        $this->judgmentService = $judgmentService;
    }

    //Função para obter todos julgamentos
    public function index(){
        return $this->judgmentService->getJudgments();
    }

    //Função para obter um julgamento
    public function show(int $id){
        return $this->judgmentService->getJudgment($id);
    }

    //Função para criar um julgamento
    public function store(JudgmentRequest $request){
        return $this->judgmentService->addJudgment($request);
    }

    //Função para editar um julgamento
    public function update(JudgmentRequest $request, int $id){
        return $this->judgmentService->updateJudgment($request, $id);
    }

    //Função para excluir um julgamento
    public function destroy(int $id){
        return $this->judgmentService->deleteJudgment($id);
    }
}
