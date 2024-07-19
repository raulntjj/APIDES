<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\AccountCreated;
use App\Events\PasswordResetRequest;

use App\listeners\SendConfirmationTokenEmail;
use App\listeners\SendPasswordResetTokenEmail;

class EventServiceProvider extends ServiceProvider{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AccountCreated::class => [
            SendConfirmationTokenEmail::class,
        ],
        PasswordResetRequest::class => [
            SendPasswordResetTokenEmail::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void{
        parent::boot();
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool{
        return false;
    }
}
