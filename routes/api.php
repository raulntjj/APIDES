<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controladores
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\EventDayController;
use App\Http\Controllers\Api\InstitutionController;
use App\Http\Controllers\Api\ModalityController;

//Cria um resource de rotas para eventos, com excessão de create e edit pois não são rotas utilizadas para CRUD
Route::apiResource('eventos', EventController::class)->except(['create', 'edit']);

Route::apiResource('dias', EventDayController::class)->except(['create', 'edit']);

Route::apiResource('instituicao', InstitutionController::class)->except(['create', 'edit']);

Route::apiResource('modalidades', ModalityController::class)->except(['create', 'edit']);

Route::prefix('eventos/{event}')->group(function () {
    Route::get('/enderecos', [EventController::class, 'address']);
});

/*
    Route::apiResource('users', 'UsersController');
    Verb          Path                        Action  Route Name
    GET           /users                      index   users.index
    POST          /users                      store   users.store
    GET           /users/{user}               show    users.show
    PUT|PATCH     /users/{user}               update  users.update
    DELETE        /users/{user}               destroy users.destroy
*/
