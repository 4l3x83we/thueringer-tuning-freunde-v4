<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: AntragController.php
 * User: ${USER}
 * Date: 30.${MONTH_NAME_FULL}.2022
 * Time: 11:40
 */

namespace App\Http\Controllers\Frontend;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AntragController extends Controller
{
    public function index()
    {
        return view('frontend.antrag');
    }

    public function store(Request $request)
    {
        $anrede = !$request->anrede ? 'keine Angabe' : $request->anrede;
        $teamMitglied = Helpers::replaceStrToLower($request->vorname .'-'. $request->nachname);
        $beruf = !$request->beruf ? 'Keinen' : $request->beruf;
        $besonderheiten = !$request->besonderheiten ? 'Keine' : $request->besonderheiten;
        $karosserie = !$request->karosserie ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->karosserie;
        $fahrwerk = !$request->fahrwerk ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->fahrwerk;
        $felgen = !$request->felgen ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->felgen;
        $bremsen = !$request->bremsen ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->bremsen;
        $innenraum = !$request->innenraum ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->innenraum;
        $anlage = !$request->anlage ? '<p>Serienmäßig keine Änderungen vorgenommen.</p>' : $request->anlage;
        $profilPath = 'images/' . $teamMitglied . '/profil';
        $profilImage = Helpers::imageUpload($request, 'profilbild', $profilPath);

        if (!$request->fahrzeug_vorhanden) {
            $title = $request->fahrzeug;
        } else {

        }

        dd($request->all(), $teamMitglied, $profilImage, $title);

    }
}
