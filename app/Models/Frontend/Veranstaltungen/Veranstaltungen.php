<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Veranstaltungen.php
 * User: ${USER}
 * Date: 9.${MONTH_NAME_FULL}.2022
 * Time: 9:28
 */

namespace App\Models\Frontend\Veranstaltungen;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Veranstaltungen extends Model
{
    use Sluggable, LogsActivity;

    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $table = 'veranstaltungens';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('Veranstaltungen')
            ->dontSubmitEmptyLogs();
    }
}
