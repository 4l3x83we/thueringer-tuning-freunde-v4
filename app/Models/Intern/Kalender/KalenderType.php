<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: KalenderType.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2022
 * Time: 9:3
 */

namespace App\Models\Intern\Kalender;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class KalenderType extends Model
{
    use LogsActivity;

    protected $table = 'kalendertype';

    protected $guarded = [];

    public function kalenders()
    {
        return $this->belongsToMany(Kalender::class, 'kalenders_kalendertype');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('KontaktType')
            ->dontSubmitEmptyLogs();
    }
}
