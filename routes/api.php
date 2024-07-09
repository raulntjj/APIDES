<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout']);
Route::post('password/change', [PasswordController::class, 'changePassword']);

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('user', [AuthController::class, 'getAuthenticatedUser']);
});

//Cria um resource de rotas para eventos, com excessão de create e edit pois não são rotas utilizadas para CRUD
Route::apiResource('users', UserController::class)->except(['create', 'edit']);

Route::apiResource('events', EventController::class)->except(['create', 'edit']);

Route::apiResource('achievements', AchievementController::class)->except(['create', 'edit']);

Route::apiResource('days', EventDayController::class)->except(['create', 'edit']);

Route::apiResource('institutions', InstitutionController::class)->except(['create', 'edit']);

Route::apiResource('modalitiues', ModalityController::class)->except(['create', 'edit']);

Route::apiResource('participants', ParticipantController::class)->except(['create', 'edit']);

Route::apiResource('teams', TeamController::class)->except(['create', 'edit']);

Route::apiResource('criteria', CriterionController::class)->except(['create', 'edit']);

Route::apiResource('subcriteria', SubCriterionController::class)->except(['create', 'edit']);

Route::apiResource('items', ItemController::class)->except(['create', 'edit']);

Route::apiResource('judgments', JudgmentController::class)->except(['create', 'edit']);

Route::apiResource('evaluations', EvaluationController::class)->except(['create', 'edit']);

Route::apiResource('schedules', ScheduleController::class)->except(['create', 'edit']);

Route::apiResource('scores', ScoreController::class)->except(['create', 'edit']);
