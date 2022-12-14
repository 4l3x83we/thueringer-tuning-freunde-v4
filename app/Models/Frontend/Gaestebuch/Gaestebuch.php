<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Gaestebuch.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2022
 * Time: 7:21
 */

namespace App\Models\Frontend\Gaestebuch;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Gaestebuch extends Model
{
    use LogsActivity;

    protected $table = 'gaestebuches';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('Gästebuch')
            ->dontSubmitEmptyLogs();
    }
}
