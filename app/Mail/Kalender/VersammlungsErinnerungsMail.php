<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: TerminerinnerungMail.php
 * User: ${USER}
 * Date: 15.${MONTH_NAME_FULL}.2022
 * Time: 8:5
 */

namespace App\Mail\Kalender;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VersammlungsErinnerungsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kalenders;

    public function __construct($kalenders = '')
    {
        $this->kalenders = $kalenders;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Terminerinnerung',);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.kalender.versammlungsErinnerungs',);
    }

    public function attachments(): array
    {
        return [];
    }
}
