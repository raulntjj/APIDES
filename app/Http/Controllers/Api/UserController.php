<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController{
    //Instanciando serviço
    protected $userService;
    public function __construct(userService $userService){
        $this->userService = $userService;
    }

    //Função para obter todos usuários
    public function index(Request $request){
        return $this->userService->getUsers($request);
    }
    //Função para obter um usuário
    public function show(int $id){
        return $this->userService->getUser($id);
    }

    //Função para criar um usuário
    public function store(StoreUserRequest $request){
        return $this->userService->addUser($request);
    }

    //Função para editar um usuário
    public function update(UpdateUserRequest $request, int $id){
        return $this->userService->updateUser($request, $id);
    }

    //Função para editar um usuário
    public function destroy(int $id){
        return $this->userService->deleteUser($id);
    }

    public function getJudges(){
        return $this->userService->getJudges();
    }

    public function getAdmins(){
        return $this->userService->getAdmins();
    }
}
