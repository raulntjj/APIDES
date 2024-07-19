<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationTokenMail extends Mailable{
    use Queueable, SerializesModels;

    // public $tries = 3;
    // public $timeout = 60;
    protected $token;

    public function __construct($token){
        $this->token = $token;
    }

    public function envelope(): Envelope{
        return new Envelope(
            subject: 'Código de confirmação de conta.',
        );
    }

    public function content(): Content{
        return new Content(
            view: 'mails.account_confirmation',
            with: [
                'token' => $this->token,
            ],
        );
    }

    public function attachments(): array{
        return [];
    }
}
