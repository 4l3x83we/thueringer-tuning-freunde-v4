<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Photo.php
 * User: ${USER}
 * Date: 1.${MONTH_NAME_FULL}.2022
 * Time: 7:57
 */

namespace App\Models\Frontend\Album;

use App\Models\Frontend\Fahrzeuge\Fahrzeug;
use App\Models\Frontend\Team\Team;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
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

    protected $fillable = [
        'user_id',
        'album_id',
        'fahrzeug_id',
        'team_id',
        'title',
        'slug',
        'size',
        'images',
        'images_thumbnail',
        'description',
        'thumbnail',
        'published',
        'published_at',
    ];

    protected $table = 'photos';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teams()
    {
        return $this->belongsTo(Team::class, 'user_id');
    }

    public function albums()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }

    public function fahrzeuges()
    {
        return $this->belongsTo(Fahrzeug::class, 'fahrzeug_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
