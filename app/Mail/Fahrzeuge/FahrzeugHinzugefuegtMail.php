<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: FahrzeugHinzugefuegtMail.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2022
 * Time: 8:40
 */

namespace App\Mail\Fahrzeuge;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FahrzeugHinzugefuegtMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fahrzeuge;

    public function __construct($fahrzeuge)
    {
        $this->fahrzeuge = $fahrzeuge;
    }

    public function build()
    {
        return $this->from(auth()->user()->email)->subject('Neues Fahrzeug wurde angelegt von ' . auth()->user()->name . '.')->view('emails.fahrzeuge.fahrzeug-hinzugefuegt')->with('fahrzeuge', $this->fahrzeuge);
    }
}
