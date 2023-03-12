<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: SpamMail.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2023
 * Time: 7:18
 */

namespace App\Mail\Kontakt;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SpamMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kontakt;

    public function __construct($kontakt)
    {
        $this->kontakt = $kontakt;
    }

    public function build()
    {
        $email = $this->kontakt['email'];
        $subject = $this->kontakt['subject'];

        return $this->from($email)->subject($subject)
            ->view('emails.kontakt.spam')->with('kontakt', $this->kontakt);
    }
}
