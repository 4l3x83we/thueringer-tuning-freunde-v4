<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Album.php
 * User: ${USER}
 * Date: 1.${MONTH_NAME_FULL}.2022
 * Time: 7:56
 */

namespace App\Models\Frontend\Album;

use App\Models\Frontend\Fahrzeuge\Fahrzeug;
use App\Models\Frontend\Team\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teams()
    {
        return $this->belongsTo(Team::class, 'user_id');
    }

    public function fahrzeuges()
    {
        return $this->belongsTo(Fahrzeug::class, 'fahrzeug_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
