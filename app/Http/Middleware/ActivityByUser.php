<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: ActivityByUserMiddleware.php
 * User: ${USER}
 * Date: 4.${MONTH_NAME_FULL}.2023
 * Time: 7:17
 */

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Cache;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class ActivityByUser
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(1); // 1 Minute online bleiben
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
            // zuletzt gesehen
            User::where('id', Auth::user()->id)->update(['last_seen' => (new \DateTime())->format('Y-m-d H:i:s')]);
        }
        return $next($request);
    }
}
