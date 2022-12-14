<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Kontakt.php
 * User: ${USER}
 * Date: 30.${MONTH_NAME_FULL}.2022
 * Time: 10:42
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Kontakt extends Model
{
    use LogsActivity;

    protected $table = 'kontakts';

    protected $fillable = [
        'name',
        'email',
        'message',
        'subject',
        'read'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('Kontakt')
            ->dontSubmitEmptyLogs();
    }
}
