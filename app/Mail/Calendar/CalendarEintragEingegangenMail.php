<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CalendarEintragEingegangenMail.php
 * User: ${USER}
 * Date: 7.${MONTH_NAME_FULL}.2022
 * Time: 13:12
 */

namespace App\Mail\Calendar;

use App\Models\Frontend\Team\Team;
use Illuminate\Mail\Mailable;

class CalendarEintragEingegangenMail extends Mailable
{
    public $kalender;

    public function __construct($kalender)
    {
        $this->kalender = $kalender;
    }



    public function build()
    {
        if ($this->kalender['type']['typeColor'] === 'ver') {
            $subject = 'Eine neue Versammlung steht an!';
        } elseif ($this->kalender['type']['cp_user_id'] === 2) {
            $subject = 'Auf dich wartet Arbeit! :-), '. Team::where('user_id', $this->kalender['type']['cp_user_id'])->first()->vorname;
        } elseif($this->kalender['type']['cp_user_id'] === 3) {
            $subject = 'Auf dich wartet Arbeit! :-), '. Team::where('user_id', $this->kalender['type']['cp_user_id'])->first()->vorname;
        } elseif($this->kalender['type']['id'] === 1) {
            $subject = 'Eine neue Versammlung steht an!';
        }
        return $this->from('noreplay@thueringer-tuning-freunde.de')->subject($subject)
            ->view('emails.calendar.calendar-eintrag-eingegangen')->with('kontakt', $this->kalender);
    }
}
