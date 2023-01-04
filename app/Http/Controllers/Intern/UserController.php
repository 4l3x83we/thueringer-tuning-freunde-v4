<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: UserController.php
 * User: ${USER}
 * Date: 4.${MONTH_NAME_FULL}.2023
 * Time: 7:26
 */

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use App\Models\User;
use Cache;
use Carbon\Carbon;

class UserController extends Controller
{
    public function userOnlineStatus()
    {
        $users = User::all();
        foreach ($users as $user)  {
            if (Cache::has('user-is-online-' . $user->id))
                echo $user->name . " ist online. Zuletzt gesehen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
            else
                echo $user->name . " ist offline. Zuletzt gesehen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
        }
    }
}
