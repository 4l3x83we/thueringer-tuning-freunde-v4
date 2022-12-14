<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session;

class LoginSuccessfull
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->subject = 'login';
        $event->description = 'Anmeldung erfolgreich';

        Session::flash('status', 'Hallo ' . $event->user->name . ', willkommen zurück!');
        activity($event->subject)
            ->by($event->user)
            ->log($event->description);
    }
}
