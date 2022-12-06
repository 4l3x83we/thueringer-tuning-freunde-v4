<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Fahrzeug.php
 * User: ${USER}
 * Date: 1.${MONTH_NAME_FULL}.2022
 * Time: 7:58
 */

namespace App\Models\Frontend\Fahrzeuge;

use App\Models\Frontend\Album\Album;
use App\Models\Frontend\Team\Team;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Fahrzeug extends Model
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

    protected $table = 'fahrzeuges';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function albums()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }

    public function teams()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
