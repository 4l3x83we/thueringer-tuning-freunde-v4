<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Kalender.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2022
 * Time: 8:44
 */

namespace App\Models\Intern\Kalender;

use App\Models\Frontend\Team\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Kalender extends Model
{
    use LogsActivity;

    protected $table = 'kalenders';

    protected $guarded = [];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'kalender_team');
    }

    public function kalendertype()
    {
        return $this->belongsToMany(KalenderType::class, 'kalenders_kalendertype');
    }

    public function assumed_meeting()
    {
        return $this->hasMany(Assumed_Meeting::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('Kalender')
            ->dontSubmitEmptyLogs();
    }
}
