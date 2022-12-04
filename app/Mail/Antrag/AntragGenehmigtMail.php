<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: AntragGenehmigtMail.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2022
 * Time: 8:38
 */

namespace App\Mail\Antrag;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AntragGenehmigtMail extends Mailable
{
    use Queueable, SerializesModels;

    public $antrag;

    public function __construct($antrag)
    {
        $this->antrag = $antrag;
    }

    public function build()
    {
        return $this->from('webmaster@thueringer-tuning-freunde.de')->subject('Hallo ' . $this->antrag['title'] . ' dein Mitgliedsantrag wurde genehmigt.')
            ->view('emails.antrag.antrag-genehmigt')->with('antrag', $this->antrag);
    }
}
