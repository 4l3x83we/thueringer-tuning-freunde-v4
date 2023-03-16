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

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Frontend\Album\Album;
use App\Models\Frontend\Album\Photo;
use App\Models\Frontend\Fahrzeuge\Fahrzeug;
use App\Models\Frontend\Team\Team;
use App\Models\Frontend\Veranstaltungen\Veranstaltungen;

class IndexController extends Controller
{
    public function index()
    {
        $teams = Team::where('published', true)->select('id', 'vorname', 'nachname', 'slug', 'facebook', 'tiktok', 'instagram', 'funktion', 'description', 'published_at', 'path', 'user_id', 'photo_id')->orderBy('title', 'ASC')->get();
        $fahrzeuges = Fahrzeug::where('published', true)->select('slug', 'title', 'album_id', 'description', 'user_id')->orderBy('updated_at', 'DESC')->get();
        $albums = Album::where('published', true)->select('thumbnail_id', 'path', 'id', 'slug', 'title', 'description')->inRandomOrder()->get();
        $veranstaltungens = Veranstaltungen::where('datum_bis', '>=', now())->select('id', 'anwesend', 'datum_von', 'datum_bis', 'veranstaltung', 'veranstalter', 'eintritt', 'slug', 'veranstaltungsort', 'quelle')->orderBy('datum_von', 'ASC')->limit(6)->get();
        $preview = null;
        foreach ($albums as $album) {
            if (!empty($album->thumbnail_id)) {
                $preview[$album->id] = $album->path.'/'.Photo::where('id', $album->thumbnail_id)->select('images_thumbnail')->first()->images_thumbnail;
            }
        }
        $previewTeam = null;
        foreach ($teams as $team) {
            if (!empty($team->path)) {
                $previewTeam[$team->id] = $team->path . '/' . Photo::where('team_id', $team->id)->select('images')->first()->images;
            }
        }
        $albums->preview = $preview;
        $count = [
            'team' => $teams->count(),
            'fahrzeuge' => $fahrzeuges->count(),
            'treffen' => 0,
            'projekte' => Album::where('kategorie', 'Projekte')->select('kategorie')->count(),
        ];
//        Helpers::activityLogBesucher();
        return view('frontend.index', compact('teams', 'albums', 'fahrzeuges', 'preview', 'count', 'previewTeam', 'veranstaltungens'));
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
