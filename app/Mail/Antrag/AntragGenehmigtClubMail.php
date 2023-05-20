<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: AntragGenehmigtClubMail.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2022
 * Time: 8:38
 */

namespace App\Mail\Antrag;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AntragGenehmigtClubMail extends Mailable
{
    use Queueable, SerializesModels;

    public $antrag;


    public function __construct($antrag)
    {
        $this->antrag = $antrag;
    }

    public function build()
    {
        return $this->from('webmaster@thueringer-tuning-freunde.de')->replyTo($this->antrag['email'])->subject('Mitgliedsantrag von ' . $this->antrag['title'] . ' wurde genehmigt.')
            ->view('emails.antrag.antrag-genehmigt-club')->with('antrag', $this->antrag);
    }
}
