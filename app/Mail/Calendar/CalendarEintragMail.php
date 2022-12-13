<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CalendarEintragMail.php
 * User: ${USER}
 * Date: 7.${MONTH_NAME_FULL}.2022
 * Time: 13:13
 */

namespace App\Mail\Calendar;

use Illuminate\Mail\Mailable;

class CalendarEintragMail extends Mailable
{
    public $kalender;

    public function __construct($kalender)
    {
        $this->kalender = $kalender;
    }

    public function build()
    {
        if ($this->kalender['email']) {
            $email = $this->kalender['email'];
        }else {
            $email = 'noreplay@thueringer-tuning-freunde.de';
        }
        return $this->from($email)->subject('Neuer Kalendereintrag erstellt!')
            ->view('emails.calendar.calendar-eintrag')->with('kontakt', $this->kalender);
    }
}
