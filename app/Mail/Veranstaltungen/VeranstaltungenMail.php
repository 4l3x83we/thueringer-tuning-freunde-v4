<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: VeranstaltungenMail.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2022
 * Time: 8:41
 */

namespace App\Mail\Veranstaltungen;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VeranstaltungenMail extends Mailable
{
    use Queueable, SerializesModels;

    public $veranstaltungen;

    public function __construct($veranstaltungen)
    {
        $this->veranstaltungen = $veranstaltungen;
    }

    public function build()
    {
        return $this->from('noreplay@thueringer-tuning-freunde.de')->subject('Neue Veranstaltung eingegangen!')
            ->view('emails.veranstaltungen.veranstaltungen')->with('veranstaltungen', $this->veranstaltungen);
    }
}
