<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Team.php
 * User: ${USER}
 * Date: 1.${MONTH_NAME_FULL}.2022
 * Time: 7:57
 */

namespace App\Models\Frontend\Team;

use App\Models\Frontend\Album\Album;
use App\Models\Frontend\Album\Photo;
use App\Models\Frontend\Fahrzeuge\Fahrzeug;
use App\Models\Intern\Admin\PaymentOpenPaid;
use App\Models\Intern\Kalender\Kalender;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Team extends Model
{
    use Sluggable, LogsActivity;

    protected static $logAttributes = ['vorname', 'nachname'];

    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $table = 'teams';

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function fahrzeuges()
    {
        return $this->hasMany(Fahrzeug::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class, 'user_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'user_id');
    }

    public function photosFahrzeuge()
    {
        return $this->hasMany(Photo::class, 'fahrzeug_id');
    }

    public function photosProfil()
    {
        return $this->hasMany(Photo::class, 'team_id');
    }

    public function kalenders()
    {
        return $this->belongsToMany(Kalender::class, 'kalender_team');
    }

    public function payment_open_paids()
    {
        $this->hasMany(PaymentOpenPaid::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*', 'users.name', 'users.email'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('Team')
            ->dontSubmitEmptyLogs();
    }
}
