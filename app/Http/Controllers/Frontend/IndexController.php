<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: IndexController.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2022
 * Time: 15:49
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Album\Album;
use App\Models\Frontend\Album\Photo;
use App\Models\Frontend\Fahrzeuge\Fahrzeug;
use App\Models\Frontend\Team\Team;

class IndexController extends Controller
{
    public function index()
    {
        $teams = Team::where('published', true)->orderBy('title', 'ASC')->get();
        $fahrzeuges = Fahrzeug::where('published', true)->orderBy('updated_at', 'DESC')->get();
        $albums = Album::where('published', true)->inRandomOrder()->get();
        foreach ($albums as $album) {
            if ($album->thumbnail_id) {
                $preview[$album->id] = $album->path.'/'.Photo::where('id', $album->thumbnail_id)->first()->images_thumbnail;
            }
        }
        $albums->preview = $preview;
        $count = [
            'team' => $teams->count(),
            'fahrzeuge' => $fahrzeuges->count(),
            'treffen' => 0,
            'projekte' => Album::where('kategorie', 'Projekte')->count(),
        ];
        return view('frontend.index', compact('teams', 'albums', 'fahrzeuges', 'preview', 'count'));
    }

    public function impressum()
    {
        return view('frontend.impressum');
    }

    public function datenschutz()
    {
        return view('frontend.datenschutz');
    }
}
