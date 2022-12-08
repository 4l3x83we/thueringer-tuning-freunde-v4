<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: TeamsController.php
 * User: ${USER}
 * Date: 1.${MONTH_NAME_FULL}.2022
 * Time: 7:57
 */

namespace App\Http\Controllers\Frontend\Team;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Frontend\Album\Photo;
use App\Models\Frontend\Team\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yoeunes\Toastr\Facades\Toastr;

class TeamsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:write|edit|destroy')->only(['store']);
        $this->middleware('permission:write')->only(['create','store']);
        $this->middleware('permission:edit')->only(['edit','update']);
        $this->middleware('permission:destroy')->only('destroy');
    }

    public function index()
    {
        $teams = Team::where('published', true)->orderBy('title', 'ASC')->paginate(21);
        return view('frontend.component.team.index', compact('teams'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Team $team)
    {
        $team->gebdatum = Carbon::parse($team->geburtsdatum)->age;
        $team->images = $team->path.'/'.\App\Models\Frontend\Album\Photo::where('team_id', $team->id)->first()->images;

        $team->previous = Helpers::previous('teams', $team->id);
        $team->next = Helpers::next('teams', $team->id);
        return view('frontend.component.team.show', compact('team'));
    }

    public function edit(Team $team)
    {
        return view('frontend.component.team.editNotModal', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $validator = Validator::make($request->all(), [
            'anrede' => 'required',
            'vorname' => 'required|max:255',
            'nachname' => 'required|max:255',
            'straße' => 'required|max:255',
            'plz' => 'required|max:5',
            'ort' => 'required|max:255',
            'email' => 'required|max:255|email',
            'geburtsdatum' => 'required|max:255',
            'mobil' => 'required|max:15',
            'telefon' => 'max:15',
            'beruf' => 'max:255',
            'facebook' => 'max:255',
            'tiktok' => 'max:255',
            'instagram' => 'max:255',
            'description' => 'required|min:250|max:4294967295',
        ], [
            'description.required' => 'Beschreibung muss ausgefüllt werden mit mindestens 250 Zeichen.',
            'description.min' => 'Beschreibung muss mindestens 250 Zeichen lang sein.',
            'plz.required' => 'Postleitzahl muss ausgefüllt werden.',
            'ort.required' => 'Wohnort muss ausgefüllt werden.',
            'mobil.required' => 'Mobilfunk muss ausgefüllt werden.',
            'email.required' => 'E-Mail Adresse muss ausgefüllt werden.',
        ]);

        if ($validator->fails()) {
            return redirect(route('frontend.team.show', $team->slug))->withErrors($validator)->withInput();
        }

        $path = 'images/' . Helpers::replaceStrToLower($team->vorname . ' ' . $team->nachname) . '/profil';
        $photoTeamID = Photo::where('team_id', $team->id)->first();

        if ($request->hasFile('profilbild')) {
            if (empty($photoTeamID->team_id)) {
                $photo = Photo::where('team_id', $team->id)->create([
                    'user_id' => $team->user_id,
                    'team_id' => $team->id,
                    'title' => $team->title,
                    'slug' => $team->slug,
                    'size' => Helpers::allFileSize($path),
                    'images' => Helpers::imageUpload($request, 'profilbild', $path),
                    'published' => true,
                    'published_at' => now(),
                    'updated_at' => now(),
                    'created_at' => now(),
                ]);
            } else {
                $photo = Photo::where('team_id', $team->id)->update([
                    'user_id' => $team->user_id,
                    'team_id' => $team->id,
                    'title' => $team->title,
                    'slug' => $team->slug,
                    'size' => Helpers::allFileSize($path),
                    'images' => Helpers::imageUpload($request, 'profilbild', $path),
                    'published' => true,
                    'published_at' => now(),
                    'updated_at' => now(),
                    'created_at' => now(),
                ]);
            }
        }

        $team->anrede = $request->anrede;
        $team->vorname = $request->vorname;
        $team->nachname = $request->nachname;
        $team->straße = $request->straße;
        $team->plz = $request->plz;
        $team->wohnort = $request->ort;
        $team->telefon = $request->telefon;
        $team->mobil = $request->mobil;
        $team->email = $request->email;
        $team->geburtsdatum = $request->geburtsdatum;
        $team->beruf = $request->beruf;
        $team->facebook = $request->facebook;
        $team->tiktok = $request->tiktok;
        $team->instagram = $request->instagram;
        if (empty($photoTeamID->team_id)) {
            $team->photo_id = $photo->id;
            $team->path = $path;
        }
        $team->description = $request->description;
        $team->updated_at = now();
        $team->save();

        Toastr::success('Änderungen an deinem Profil wurden vorgenommen.', 'Erfolgreich!');
        return redirect(route('frontend.team.show', $team->slug));
    }

    public function updateMember(Request $request, Team $team)
    {
    }

    public function destroy(Team $team)
    {
    }
}
