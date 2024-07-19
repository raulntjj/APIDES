<?php

namespace App\Listeners;

use App\Events\AccountCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationTokenMail;

class SendConfirmationEmail implements ShouldQueue{
    use InteractsWithQueue;

    public function handle(AccountCreated $event): void{
        Mail::to($event->email)->send(new ConfirmationTokenMail($event->name, $event->email, $event->password));
    }
}
