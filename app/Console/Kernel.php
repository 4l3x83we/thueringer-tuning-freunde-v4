<?php

namespace App\Console;

use App\Console\Commands\EmailInactiveUsers;
use App\Console\Commands\GenerateSitemap;
use App\Console\Commands\KalenderErinnerungAnsprechpartnerCommand;
use App\Console\Commands\KalenderVersammlungErinnerungCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [EmailInactiveUsers::class, GenerateSitemap::class, KalenderVersammlungErinnerungCommand::class, KalenderErinnerungAnsprechpartnerCommand::class,];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('activitylog:clean')->daily();
        $schedule->command('generate:sitemap')->hourly();
        $schedule->command('email:inactive-users')->weekly()->sundays();
        $schedule->command('kalender:versammlung-erinnerung')->daily();
        $schedule->command('kalender:erinnerung-ansprechpartner')->weekly()->sundays();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
