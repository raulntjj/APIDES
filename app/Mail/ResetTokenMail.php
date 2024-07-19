<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetTokenMail extends Mailable implements ShouldQueue{
    use Queueable, SerializesModels;

    // public $tries = 3;
    // public $timeout = 60;
    protected $token;

    public function __construct($token){
        $this->token = $token;
    }

    public function envelope(): Envelope{
        return new Envelope(
            subject: 'Código de redifinição de senha.',
        );
    }

    public function content(): Content{
        return new Content(
            view: 'mails.password_reset',
            with: [
                'token' => $this->token,
            ],
        );
    }

    public function attachments(): array{
        return [];
    }
}
