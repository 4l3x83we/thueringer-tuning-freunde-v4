<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: FahrzeugFreigegebenMail.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2022
 * Time: 8:39
 */

namespace App\Mail\Fahrzeuge;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FahrzeugFreigegebenMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function build()
    {
        return $this->view('emails.fahrzeuge.fahrzeug-freigegeben');
    }
}
