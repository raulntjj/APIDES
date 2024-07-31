<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TeamRequest;
use App\Services\TeamService;
use Illuminate\Http\Request;

class TeamController{
    //Instanciando serviço
    protected $teamService;
    public function __construct(TeamService $teamService){
        $this->teamService = $teamService;
    }

    //Função para obter todos times
    public function index(Request $request){
        return $this->teamService->getTeams($request);
    }

    //Função para obter um time
    public function show(int $id){
        return $this->teamService->getTeam($id);
    }

    //Função para criar um time
    public function store(TeamRequest $request){
        return $this->teamService->addTeam($request);
    }

    //Função para editar um time
    public function update(TeamRequest $request, int $id){
        return $this->teamService->updateTeam($request, $id);
    }

    //Função para excluir um time
    public function destroy(int $id){
        return $this->teamService->deleteTeam($id);
    }
}
