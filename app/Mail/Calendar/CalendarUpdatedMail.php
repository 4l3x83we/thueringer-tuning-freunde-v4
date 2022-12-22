<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CalendarUpdatedMail.php
 * User: ${USER}
 * Date: 21.${MONTH_NAME_FULL}.2022
 * Time: 8:22
 */

namespace App\Mail\Calendar;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CalendarUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kalender;

    public function __construct($kalender)
    {
        $this->kalender = $kalender;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Dein Termin wurde geändert!',);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.calendar.calendar-updated',);
    }

    public function attachments(): array
    {
        return [];
    }
}
