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
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use Sluggable;

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
        return $this->hasMany(Fahrzeug::class, 'fahrzeug_id');
    }

    public function albums()
    {
        return $this->hasMany(Album::class, 'user_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'user_id');
    }
}
