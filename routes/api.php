<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\PasswordController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIsAdmin;
use App\Http\Middleware\CheckIsEvaluator;

Route::get('database', function(){
    return view('database');
});

Route::get('download', [Controller::class, 'downloadCollection'])->name('download.collection');

Route::fallback(function(){
    return view('welcome');
});

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('password/change', [PasswordController::class, 'changePassword']);
Route::post('password/forgot', [PasswordController::class, 'forgotPassword']);

// Route::group(['middleware' => ['jwt.auth']], function() {
    //Rotas de sessão
    Route::get('user', [AuthController::class, 'getAuthenticatedUser']);
    Route::put('post', [ProfileController::class, 'store']);
    Route::put('user', [ProfileController::class, 'update']);
    Route::delete('user', [ProfileController::class, 'destroy']);
    Route::post('logout', [AuthController::class, 'logout']);

    //Rotas para separar grupos de usuários
    Route::get('judges', [UserController::class, 'getJudges']);
    Route::get('admins', [UserController::class, 'getAdmins']);
    Route::get('participants', [UserController::class, 'getDefaults']);

    //Rotas para permitida para todos usuários, desde que esteja logado.
    Route::apiResource('events', EventController::class)->only(['index', 'show']);
    Route::apiResource('achievements', AchievementController::class)->only(['index', 'show']);
    Route::apiResource('days', EventDayController::class)->only(['index', 'show']);
    Route::apiResource('institutions', InstitutionController::class)->only(['index', 'show']);
    Route::apiResource('modalities', ModalityController::class)->only(['index', 'show']);
    Route::apiResource('participants', ParticipantController::class)->only(['index', 'show']);
    Route::apiResource('teams', TeamController::class)->only(['index', 'show']);
    Route::apiResource('criteria', CriterionController::class)->only(['index', 'show']);
    Route::apiResource('subcriteria', SubcriterionController::class)->only(['index', 'show']);
    Route::apiResource('items', ItemController::class)->only(['index', 'show']);
    Route::apiResource('judgments', JudgmentController::class)->only(['index', 'show']);
    Route::apiResource('evaluations', EvaluationController::class)->only(['index', 'show']);

    //Apenas avaliadores podem fazer julgamentos
    // Route::middleware(CheckIsEvaluator::class)->group(function(){
        Route::apiResource('judgments', JudgmentController::class)->only(['store', 'update', 'destroy']);
    // });

    // Apenas administradores podem criar, editar e excluir algumas entidades
    // Route::middleware(CheckIsAdmin::class)->group(function(){
        Route::apiResource('users', UserController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::apiResource('events', EventController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('days', EventDayController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('institutions', InstitutionController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('modalities', ModalityController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('participants', ParticipantController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('teams', TeamController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('criteria', CriterionController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('subcriteria', SubcriterionController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('items', ItemController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('evaluations', EvaluationController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('achievements', AchievementController::class)->only(['store', 'update', 'destroy']);
    // });
// });
