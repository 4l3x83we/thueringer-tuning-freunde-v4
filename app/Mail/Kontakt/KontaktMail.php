<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: KontaktMail.php
 * User: ${USER}
 * Date: 30.${MONTH_NAME_FULL}.2022
 * Time: 10:47
 */

namespace App\Mail\Kontakt;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KontaktMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kontakt;

    public function __construct($kontakt)
    {
        $this->kontakt = $kontakt;
    }

    public function build()
    {
        if ($this->kontakt['email']) {
            $email = $this->kontakt['email'];
        } else {
            $email = 'noreplay@thueringer-tuning-freunde.de';
        }

        return $this->from($email)->replyTo($this->kontakt['email'])->subject('Neue Kontaktanfrage!')
            ->view('emails.kontakt.kontakt')->with('kontakt', $this->kontakt);
    }
}
