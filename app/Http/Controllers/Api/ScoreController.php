<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ScoreRequest;
use App\Services\ScoreService;

class ScoreController{
    //Instanciando serviço
    protected $scoreService;
    public function __construct(ScoreService $scoreService){
        $this->scoreService = $scoreService;
    }

    //Função para obter todas pontuações
    public function index(){
        return $this->scoreService->getScores();
    }

    //Função para obter uma pontuação
    public function show(int $id){
        return $this->scoreService->getScore($id);
    }

    //Função para criar uma pontuação
    public function store(ScoreRequest $request){
        return $this->scoreService->addScore($request);
    }

    //Função para editar uma pontuação
    public function update(ScoreRequest $request, int $id){
        return $this->ScoreService->updateScore($request, $id);
    }

    //Função para excluir uma pontuação
    public function destroy(int $id){
        return $this->ScoreService->deleteScore($id);
    }
}
