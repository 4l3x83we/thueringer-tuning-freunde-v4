<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: AntragEingangMail.php
 * User: ${USER}
 * Date: 2.${MONTH_NAME_FULL}.2022
 * Time: 15:42
 */

namespace App\Mail\Antrag;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AntragEingangMail extends Mailable
{
    use Queueable, SerializesModels;

    public $team;

    public function __construct($team)
    {
        $this->team = $team;
    }

    public function build()
    {
        return $this->from('noreplay@thueringer-tuning-freunde.de')->subject('Dein Mitgliedsantrag bei den Thüringer Tuning Freunden wird geprüft.')
            ->view('emails.antrag.antrag-eingang')->with('team', $this->team);
    }
}
