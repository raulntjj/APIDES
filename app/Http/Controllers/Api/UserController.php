<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Services\UserService;

class UserController{
    //Instanciando serviço
    protected $userService;
    public function __construct(userService $userService){
        $this->userService = $userService;
    }

    //Função para obter todos usuários
    public function index(){
        return $this->userService->getUsers();
    }

    //Função para obter um usuário
    public function show(int $id){
        return $this->userService->getUser($id);
    }

    //Função para criar um usuário
    public function store(UserRequest $request){
        return $this->userService->addUser($request);
    }

    //Função para editar um usuário
    public function update(UserRequest $request, int $id){
        return $this->userService->updateUser($request, $id);
    }

    //Função para excluir um usuário
    public function destroy(int $id){
        return $this->userService->deleteUser($id);
    }
}
