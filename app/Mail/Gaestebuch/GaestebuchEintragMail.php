<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: GaestebuchEintragMail.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2022
 * Time: 8:40
 */

namespace App\Mail\Gaestebuch;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GaestebuchEintragMail extends Mailable
{
    use Queueable, SerializesModels;

    public $gästebuch;

    public function __construct($gästebuch)
    {
        $this->gästebuch = $gästebuch;
    }

    public function build()
    {
        if ($this->gästebuch['email']) {
            $email = $this->gästebuch['email'];
        } else {
            $email = 'noreplay@thueringer-tuning-freunde.de';
        }

        return $this->from($email)->replyTo($this->gästebuch['email'])->subject('Neuer Gästebucheintrag ist eingegangen!')
            ->view('emails.gaestebuch.gaestebuch-eintrag')->with('gästebuch', $this->gästebuch);
    }
}
