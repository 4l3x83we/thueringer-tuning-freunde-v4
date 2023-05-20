<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: AntragEingangAdminMail.php
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

class AntragEingangAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $team;

    public function __construct($team)
    {
        $this->team = $team;
    }

    public function build()
    {
        if ($this->team['email']) {
            $email = $this->team['email'];
        } else {
            $email = 'noreplay@thueringer-tuning-freunde.de';
        }

        return $this->from($email)->replyTo($this->team['email'])->subject('Neuer Mitgliedsantrag ist eingegangen.')
            ->view('emails.antrag.antrag-eingang-admin')->with('team', $this->team);
    }
}
