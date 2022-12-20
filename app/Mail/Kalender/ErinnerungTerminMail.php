<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: ErinnerungTerminMail.php
 * User: ${USER}
 * Date: 20.${MONTH_NAME_FULL}.2022
 * Time: 8:32
 */

namespace App\Mail\Kalender;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ErinnerungTerminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kalenders;

    public function __construct($kalenders = '')
    {
        $this->kalenders = $kalenders;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Terminerinnerung Thüringer Tuning Freunde',);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.kalender.erinnerung-termin',);
    }

    public function attachments(): array
    {
        return [];
    }
}
