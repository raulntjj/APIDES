<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AchievementRequest;
use App\Services\AchievementService;

class AchievementController{
    //Instanciando serviço
    protected $achievementService;
    public function __construct(AchievementService $achievementService){
        $this->achievementService = $achievementService;
    }

    //Função para obter todos Achievementes
    public function index(){
        return $this->achievementService->getAchievements();
    }

    //Função para obter um Achievemente
    public function show(int $id){
        return $this->achievementService->getAchievement($id);
    }

    //Função para criar um Achievemente
    public function store(AchievementRequest $request){
        return $this->achievementService->addAchievement($request);
    }

    //Função para editar um Achievemente
    public function update(AchievementRequest $request, int $id){
        return $this->achievementService->updateAchievement($request, $id);
    }

    //Função para excluir um Achievemente
    public function destroy(int $id){
        return $this->achievementService->deleteAchievement($id);
    }
}
