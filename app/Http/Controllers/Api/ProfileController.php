<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class ProfileController{
    // Instanciando serviço
    protected $userService;
    protected $authenticatedUser;

    public function __construct(UserService $userService){
        $this->userService = $userService;
        $this->authenticatedUser = JWTAuth::parseToken()->authenticate();
    }

    //Função para criar um usuário
    public function store(StoreUserRequest $request){
        return $this->userService->addUser($request);
    }

    // Função para editar um usuário
    public function update(UpdateUserRequest $request){
        return $this->userService->updateUser($request, $this->authenticatedUser->id);
    }

    // Função para deletar um usuário
    public function destroy(){
        return $this->userService->deleteUser($this->authenticatedUser->id);
    }
}
