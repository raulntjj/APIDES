<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\PasswordController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIsAdmin;

Route::get('database', function(){
    return view('database');
});

Route::fallback(function(){
    return view('welcome');
});

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('password/change', [PasswordController::class, 'changePassword']);
Route::post('password/forgot', [PasswordController::class, 'forgotPassword']);

Route::post('account/confirmation', [RegisterController::class, 'confirmTokenVerification']);

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('user', [AuthController::class, 'getAuthenticatedUser']);
    Route::post('logout', [AuthController::class, 'logout']);
});


    //Cria um resource de rotas para eventos, com excessão de create e edit pois não são rotas utilizadas para CRUD
    Route::apiResource('users', UserController::class)->except(['create', 'edit']);
    Route::get('judges', [UserController::class, 'getJudges']);
    Route::get('admins', [UserController::class, 'getAdmins']);
    Route::get('defaults', [UserController::class, 'getDefaults']);

    Route::apiResource('events', EventController::class)->except(['create', 'edit']);

    Route::apiResource('achievements', AchievementController::class)->except(['create', 'edit']);

    Route::apiResource('days', EventDayController::class)->except(['create', 'edit']);

    Route::apiResource('institutions', InstitutionController::class)->except(['create', 'edit']);

    Route::apiResource('modalities', ModalityController::class)->except(['create', 'edit']);

    Route::apiResource('participants', ParticipantController::class)->except(['create', 'edit']);

    Route::apiResource('teams', TeamController::class)->except(['create', 'edit']);

    Route::apiResource('criteria', CriterionController::class)->except(['create', 'edit']);

    Route::apiResource('subcriteria', SubCriterionController::class)->except(['create', 'edit']);

    Route::apiResource('items', ItemController::class)->except(['create', 'edit']);

    Route::apiResource('judgments', JudgmentController::class)->except(['create', 'edit']);

    Route::apiResource('evaluations', EvaluationController::class)->except(['create', 'edit']);

    Route::apiResource('schedules', ScheduleController::class)->except(['create', 'edit']);

    Route::apiResource('scores', ScoreController::class)->except(['create', 'edit']);





// <?php

// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Api\Auth\AuthController;
// use App\Http\Controllers\Api\Auth\PasswordController;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
// use App\Http\Middleware\CheckIsAdmin;
// use App\Http\Middleware\CheckIsEvaluator;

// Route::get('database', function(){
//     return view('database');
// });

// Route::fallback(function(){
//     return view('welcome');
// });

// Route::post('login', [AuthController::class, 'login'])->name('login');
// Route::post('password/change', [PasswordController::class, 'changePassword']);
// Route::post('password/forgot', [PasswordController::class, 'forgotPassword']);

// Route::group(['middleware' => ['jwt.auth']], function() {
//     //Rotas de sessão
//     Route::get('user', [AuthController::class, 'getAuthenticatedUser']);
//     Route::apiResource('profile', ProfileController::class)->only(['update', 'destroy']);
//     Route::post('logout', [AuthController::class, 'logout']);

//     //Rotas para separar grupos de usuários
//     Route::get('judges', [UserController::class, 'getJudges']);
//     Route::get('admins', [UserController::class, 'getAdmins']);
//     Route::get('participants', [UserController::class, 'getDefaults']);

//     //Rotas para permitida para todos usuários, desde que esteja logado.
//     Route::apiResource('events', EventController::class)->only(['index', 'show']);
//     Route::apiResource('achievements', AchievementController::class)->only(['index', 'show']);
//     Route::apiResource('days', EventDayController::class)->only(['index', 'show']);
//     Route::apiResource('institutions', InstitutionController::class)->only(['index', 'show']);
//     Route::apiResource('modalities', ModalityController::class)->only(['index', 'show']);
//     Route::apiResource('participants', ParticipantController::class)->only(['index', 'show']);
//     Route::apiResource('teams', TeamController::class)->only(['index', 'show']);
//     Route::apiResource('criteria', CriterionController::class)->only(['index', 'show']);
//     Route::apiResource('subcriteria', SubCriterionController::class)->only(['index', 'show']);
//     Route::apiResource('items', ItemController::class)->only(['index', 'show']);
//     Route::apiResource('judgments', JudgmentController::class)->only(['index', 'show']);
//     Route::apiResource('evaluations', EvaluationController::class)->only(['index', 'show']);

//     //Apenas avaliadores podem fazer julgamentos
//     Route::middleware(CheckIsEvaluator::class)->group(function(){
//         Route::apiResource('judgments', JudgmentController::class)->only(['store', 'update', 'destroy']);
//     });

//     //Apenas administradores podem criar, editar e excluir algumas entidades
//     Route::middleware(CheckIsAdmin::class)->group(function(){
//         Route::apiResource('users', UserController::class)->except(['create', 'edit']);
//         Route::apiResource('events', EventController::class)->only(['store', 'update', 'destroy']);
//         Route::apiResource('achievements', AchievementController::class)->only(['store', 'update', 'destroy']);
//         Route::apiResource('days', EventDayController::class)->only(['store', 'update', 'destroy']);
//         Route::apiResource('institutions', InstitutionController::class)->only(['store', 'update', 'destroy']);
//         Route::apiResource('modalities', ModalityController::class)->only(['store', 'update', 'destroy']);
//         Route::apiResource('participants', ParticipantController::class)->only(['store', 'update', 'destroy']);
//         Route::apiResource('teams', TeamController::class)->only(['store', 'update', 'destroy']);
//         Route::apiResource('criteria', CriterionController::class)->only(['store', 'update', 'destroy']);
//         Route::apiResource('subcriteria', SubCriterionController::class)->only(['store', 'update', 'destroy']);
//         Route::apiResource('items', ItemController::class)->only(['store', 'update', 'destroy']);
//         Route::apiResource('evaluations', EvaluationController::class)->only(['store', 'update', 'destroy']);
//     });
// });
