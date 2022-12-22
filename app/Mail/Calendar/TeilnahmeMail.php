<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: TeilnahmeMail.php
 * User: ${USER}
 * Date: 22.${MONTH_NAME_FULL}.2022
 * Time: 9:22
 */

namespace App\Mail\Calendar;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TeilnahmeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kalender;
    public $assumed;
    protected string $von;

    public function __construct($kalender, $assumed)
    {
        $this->kalender = $kalender;
        $this->assumed = $assumed;
        $this->von = Carbon::parse($kalender->von)->format('d.m.Y');
        $this->kalender->adresse = explode(', ', $kalender->eigenesFZ)[1] . ' ' . explode(', ', $kalender->eigenesFZ)[2];
    }

    public function envelope(): Envelope
    {
        if ($this->assumed->present === 1) {
            $present = "Teilnahmebestätigung für die Versammlung am: {$this->von}";
        } else {
            $present = "Absage für die Versammlung am: {$this->von}";
        }
        return new Envelope(subject: $present,);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.calendar.teilnahme',);
    }

    public function attachments(): array
    {
        return [];
    }
}
