<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: EmailInactiveUsersCommand.php
 * User: ${USER}
 * Date: 14.${MONTH_NAME_FULL}.2022
 * Time: 14:43
 */

namespace App\Console\Commands;

use App\Mail\EmailInactiveUsersMail;
use App\Models\Frontend\Team\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mail;

class EmailInactiveUsers extends Command
{
    protected $signature = 'email:inactive-users';

    protected $description = 'Command description';

    public function handle()
    {
        $limit = Carbon::now()->subDay(7);
        $inactive_users = User::where('last_seen', '<', $limit)->get();

        foreach ($inactive_users as $user) {
            $team = Team::where('user_id', $user->id)->first();
            Mail::to($user->email)->send(new EmailInactiveUsersMail($user, $team));
        }
    }
}
