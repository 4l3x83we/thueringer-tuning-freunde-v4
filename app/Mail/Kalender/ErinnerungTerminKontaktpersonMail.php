<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: ErinnerungTerminKontaktpersonMail.php
 * User: ${USER}
 * Date: 17.${MONTH_NAME_FULL}.2022
 * Time: 8:57
 */

namespace App\Mail\Kalender;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ErinnerungTerminKontaktpersonMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kalenders;

    public function __construct($kalenders = '')
    {
        $this->kalenders = $kalenders;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Termine bei den Thüringer Tuning Freunden als Ansprechpartner',);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.kalender.erinnerung-termin-kontaktperson',);
    }

    public function attachments(): array
    {
        return [];
    }
}
