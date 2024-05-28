<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controladores
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\EventDayController;
use App\Http\Controllers\Api\InstitutionController;
use App\Http\Controllers\Api\ModalityController;
use App\Http\Controllers\Api\ParticipantController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CriterionController;
use App\Http\Controllers\Api\SubCriterionController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\EvaluationController;
use App\Http\Controllers\Api\JudgmentController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\ScoreController;


//Cria um resource de rotas para eventos, com excessão de create e edit pois não são rotas utilizadas para CRUD
Route::apiResource('usuarios', UserController::class)->except(['create', 'edit']);

Route::apiResource('eventos', EventController::class)->except(['create', 'edit']);

Route::apiResource('dias', EventDayController::class)->except(['create', 'edit']);

Route::apiResource('instituicoes', InstitutionController::class)->except(['create', 'edit']);

Route::apiResource('modalidades', ModalityController::class)->except(['create', 'edit']);

Route::apiResource('participantes', ParticipantController::class)->except(['create', 'edit']);

Route::apiResource('equipes', TeamController::class)->except(['create', 'edit']);

Route::apiResource('criterios', CriterionController::class)->except(['create', 'edit']);

Route::apiResource('subcriterios', SubCriterionController::class)->except(['create', 'edit']);

Route::apiResource('itens', ItemController::class)->except(['create', 'edit']);

Route::apiResource('julgamentos', JudgmentController::class)->except(['create', 'edit']);

Route::apiResource('avaliacoes', EvaluationController::class)->except(['create', 'edit']);

Route::apiResource('agendas', ScheduleController::class)->except(['create', 'edit']);

Route::apiResource('pontuacoes', ScoreController::class)->except(['create', 'edit']);

/*
    Route::apiResource('users', 'UsersController');
    Verb          Path                        Action  Route Name
    GET           /users                      index   users.index
    POST          /users                      store   users.store
    GET           /users/{user}               show    users.show
    PUT|PATCH     /users/{user}               update  users.update
    DELETE        /users/{user}               destroy users.destroy
*/
