<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

use App\Services\EventService;
use App\Services\EventDayService;
use App\Services\InstitutionService;
use App\Services\ModalityService;
use App\Services\ParticipantService;
use App\Services\TeamService;
use App\Services\UserService;
use App\Services\CriterionService;
use App\Services\SubCriterionService;
use App\Services\JugdmentService;
use App\Services\EvaluationService;

class AppServiceProvider extends ServiceProvider{
    /*
        Registrando serviços que serão utilizados na aplicação
    */
    public function register(): void{
        $this->app->singleton(EventService::class, function ($app){
            return new EventService();
        });

        $this->app->singleton(EventDayService::class, function ($app){
            return new EventDayService();
        });

        $this->app->singleton(InstitutionService::class, function ($app){
            return new InstitutionService();
        });

        $this->app->singleton(ModalityService::class, function ($app){
            return new ModalityService();
        });

        $this->app->singleton(ParticipantService::class, function ($app){
            return new ParticipantService();
        });

        $this->app->singleton(TeamService::class, function ($app){
            return new TeamService();
        });

        $this->app->singleton(UserService::class, function ($app){
            return new UserService();
        });

        $this->app->singleton(CriterionService::class, function ($app){
            return new CriterionService();
        });

        $this->app->singleton(SubCriterionService::class, function ($app){
            return new SubCriterionService();
        });

        $this->app->singleton(ItemService::class, function ($app){
            return new ItemService();
        });

        $this->app->singleton(JudgmentService::class, function ($app){
            return new JudgmentService();
        });

        $this->app->singleton(EvaluationService::class, function ($app){
            return new EvaluationService();
        });

        $this->app->singleton(ScheduleService::class, function ($app){
            return new ScheduleService();
        });

        $this->app->singleton(ScoreService::class, function ($app){
            return new ScoreService();
        });

    }

    public function boot(): void{
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}
