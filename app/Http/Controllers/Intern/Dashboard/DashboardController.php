<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: DashboardController.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2022
 * Time: 10:27
 */

namespace App\Http\Controllers\Intern\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Album\Photo;
use App\Models\Frontend\Team\Team;
use App\Models\Intern\Kalender\Assumed_Meeting;
use App\Models\Intern\Kalender\Kalender;
use App\Models\Intern\Kalender\KalenderType;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yoeunes\Toastr\Facades\Toastr;

class DashboardController extends Controller
{
    public function index()
    {
        $team = Team::where('id', auth()->user()->id)->first();
//        $team = Team::where('id', 3)->first();
        $team->fahrzeuge = $team->fahrzeuges;
        $team->alben = $team->albums;
        $team->photos = $team->photos;
        $team->kalender = Kalender::join('kalenders_kalendertype', 'kalenders.id', 'kalenders_kalendertype.kalender_id')
            ->join('kalender_team', 'kalenders.id', 'kalender_team.kalender_id')
            ->orderBy('von', 'ASC')
            ->get();
        $team->assumed = Assumed_Meeting::where('team_id', $team->id)->first();
        foreach ($team->kalender as $item => $kalender) {
            $team->kalender[$item]['type'] = Kalender::find($kalender->id)->kalendertype[0];
            $team->kalender[$item]['team'] = Team::find($kalender->team_id);
        }
        $previewTeam[$team->id] = null;
        if (!empty($team->path)) {
            $previewTeam[$team->id] = $team->path . '/' . Photo::where('team_id', $team->id)->first()->images;
        }
        $preview = null;
        foreach ($team->alben as $album) {
            if (!empty($album->thumbnail_id)) {
                $preview[$album->id] = $album->path.'/'.Photo::where('id', $album->thumbnail_id)->first()->images_thumbnail;
            }
        }
        $teams = Team::where('published', true)->get();
        return view('intern.dashboard.index', compact('team', 'previewTeam', 'preview', 'teams'));
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ], [
            'old_password.required' => 'Altes Passwort muss ausgefüllt werden.',
            'new_password.required' => 'Neues Passwort muss ausgefüllt werden.',
            'new_password.confirmed' => 'Neues Passwort stimmt nicht mit der Bestätigung überein.',
        ]);

        if ($validator->fails()) {
            return redirect(route('intern.dashboard.index').'#password')->withErrors($validator)->withInput();
        }

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            Toastr::error('Altes Passwort stimmt nicht überein!', 'Altes Passwort Falsch');
            return redirect(route('intern.dashboard.index').'#password');
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
            'updated_at' => now(),
        ]);

        Toastr::success('Das Passwort wurde erfolgreich geändert!', 'Erfolgreich!');
        return redirect(route('intern.dashboard.index').'#password');
    }
}
