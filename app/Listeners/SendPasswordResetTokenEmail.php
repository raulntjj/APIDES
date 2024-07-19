<?php

namespace App\Listeners;

use App\Events\PasswordResetRequested;
use App\Mail\ResetTokenMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordResetTokenEmail implements ShouldQueue{
    use InteractsWithQueue;

    public function handle(PasswordResetRequested $event){
        Mail::to($event->email)->send(new ResetTokenMail($event->token));
    }
}
