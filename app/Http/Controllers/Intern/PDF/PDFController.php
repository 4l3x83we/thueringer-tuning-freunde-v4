<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: PDF.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2022
 * Time: 6:12
 */

namespace App\Http\Controllers\Intern\PDF;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Team\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function geburtstagsliste(Request $request)
    {
        $team = Team::where('published', true)->orderBy('geburtsdatum', 'ASC')->get();

        if ($request->has('download') && $request->get('download') === 'pdf') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('intern.geburtstagsliste.index-list', compact('team'))->setPaper('A4', 'portrait');
            return $pdf->download('Geburtstagsliste_Thueringer_Tuning_Freunde_Stand_'.Carbon::parse(now())->format('m.Y').'.pdf');
        }

        return view('intern.geburtstagsliste.index', compact('team'));
    }

    public function telefonliste(Request $request)
    {
        $team = Team::where('published', true)->orderBy('vorname', 'ASC')->get();

        if ($request->has('download') && $request->get('download') === 'pdf') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('intern.telefonliste.index-list', compact('team'))->setPaper('A4', 'landscape');
            return $pdf->download('Telefonliste_Thueringer_Tuning_Freunde_Stand_'.Carbon::parse(now())->format('m.Y').'.pdf');
        }

        return view('intern.telefonliste.index', compact('team'));
    }

    public function satzung(Request $request)
    {
        $teams = Team::where('published', true)->orderBy('vorname', 'ASC')->get();
        $zahlungGesamt = [];
        $zahlungWB = [];
        $zahlungMB = [];
        foreach ($teams as $team) {
            $zahlungGesamt[] = $team->zahlung;
            if ($team->zahlungsArt === 'wb') {
                $zahlungWB[] = $team->zahlung;
            }
            if ($team->zahlungsArt === 'mb') {
                $zahlungMB[] = $team->zahlung;
            }
        }
        $teams->gesamt = array_sum($zahlungGesamt);
        $teams->wb = array_sum($zahlungWB);
        $teams->mb = array_sum($zahlungMB);
        $team = Team::where('id', auth()->user()->id)->first();
        $teamCount = count($teams);

        if ($request->has('download') && $request->get('download') === 'pdf') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('intern.satzung.index-list', compact('team', 'teams', 'teamCount'))->setPaper('A4', 'portrait');
            return $pdf->download('Satzung_Thueringer_Tuning_Freunde_Stand_'.Carbon::parse(now())->format('m.Y').'.pdf');
        }

        return view('intern.satzung.index', compact('team', 'teams', 'teamCount'));
    }


}
