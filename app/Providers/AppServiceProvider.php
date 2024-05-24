<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

use App\Services\EventService;
use App\Services\EventDayService;
use App\Services\InstitutionService;

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
    }

    public function boot(): void{
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}
