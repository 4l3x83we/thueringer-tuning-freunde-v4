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

use Carbon\Carbon;
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

    public static function veranstaltungenDate($von, $bis)
    {
        $dateVon = Carbon::parse($von)->isoFormat('DD.MM.YYYY HH:mm');
        $dateBis = Carbon::parse($bis)->isoFormat('DD.MM.YYYY HH:mm');

        $date = [
            'von' => $dateVon,
            'bis' => $dateBis,
        ];

        return $date;
    }

    public static function sort_by_month()
    {
        $month = self::whereBetween('datum_von', [now(), now()->addMonths(12)])
            ->orderBy('datum_von')
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->datum_von)->isoFormat('MMMM');
            });

        return $month;
    }
}
