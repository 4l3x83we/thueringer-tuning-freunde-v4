<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: VeranstaltungensController.php
 * User: ${USER}
 * Date: 9.${MONTH_NAME_FULL}.2022
 * Time: 9:28
 */

namespace App\Http\Controllers\Frontend\Veranstaltungen;

use App\Http\Controllers\Controller;
use App\Mail\Veranstaltungen\VeranstaltungenEditMail;
use App\Mail\Veranstaltungen\VeranstaltungenMail;
use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use Yoeunes\Toastr\Facades\Toastr;

class VeranstaltungensController extends Controller
{
    public function index()
    {
        $veranstaltungens = Veranstaltungen::where('datum_bis', '>=', now())->select('datum_von', 'datum_bis', 'veranstaltung', 'veranstalter', 'eintritt', 'slug', 'veranstaltungsort', 'quelle')->orderBy('datum_von', 'ASC')->paginate(10);

        return view('frontend.veranstaltungen', compact('veranstaltungens'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'von' => 'required|max:16',
            'bis' => 'required|max:16',
            'veranstaltung' => 'required|max:255',
            'veranstaltungsort' => 'max:255',
            'veranstalter' => 'max:255',
            'beschreibung' => 'required|min:25|max:100000',
            'quelle' => 'required|max:255',
            'eintritt' => 'max:255',
        ], [
            'von.required' => 'Datum von muss ausgefüllt werden.',
            'bis.required' => 'Datum bis muss ausgefüllt werden.',
        ]);

        if ($validator->fails()) {
            return redirect(route('frontend.veranstaltungen.index'))->withErrors($validator)->withInput();
        }

        $slug = SlugService::createSlug(Veranstaltungen::class, 'slug', $request->veranstaltung);
        $admin = auth()->user()->hasAnyRole('super_admin', 'admin');

        $veranstaltungen = new Veranstaltungen();
        $this->extracted($request, $veranstaltungen, $slug, $admin);

        if ($admin) {
            Toastr::success('Deine Veranstaltung wurde freigegeben.', 'Erfolgreich!');
            return redirect(route('frontend.veranstaltungen.show', $veranstaltungen->slug));
        } else {
            Mail::to(env('TTF_EMAIL'))->send(new VeranstaltungenMail($veranstaltungen));
            Toastr::info('Deine Veranstaltung wurde gespeichert und wird nun von einem Admin geprüft und freigeschaltet.', 'In Prüfung!');
        }
        return redirect(route('frontend.veranstaltungen.index'));
    }

    public function show(Veranstaltungen $veranstaltungen)
    {
        return view('frontend.component.events.show', compact('veranstaltungen'));
    }

    public function edit(Veranstaltungen $veranstaltungen)
    {
    }

    public function update(Request $request, Veranstaltungen $veranstaltungen)
    {
        $validator = Validator::make($request->all(), [
            'von' => 'required|max:16',
            'bis' => 'required|max:16',
            'veranstaltung' => 'required|max:255',
            'veranstaltungsort' => 'max:255',
            'veranstalter' => 'max:255',
            'beschreibung' => 'required|min:25|max:100000',
            'quelle' => 'required|max:255',
            'eintritt' => 'max:255',
        ], [
            'von.required' => 'Datum von muss ausgefüllt werden.',
            'bis.required' => 'Datum bis muss ausgefüllt werden.',
        ]);

        if ($validator->fails()) {
            return redirect(route('frontend.veranstaltungen.index'))->withErrors($validator)->withInput();
        }

        $slug = $request->veranstaltung === $veranstaltungen->veranstaltung ? $veranstaltungen->slug : SlugService::createSlug(Veranstaltungen::class, 'slug', $request->veranstaltung);
        $admin = auth()->user()->hasAnyRole('super_admin', 'admin');

        $this->extracted($request, $veranstaltungen, $slug, $admin);

        if ($admin) {
            Toastr::info('Deine Veranstaltung wurde geändert!', 'Erfolgreich!');
        } else {
            Mail::to(env('TTF_EMAIL'))->send(new VeranstaltungenEditMail($veranstaltungen));
            Toastr::info('Deine Veranstaltung wurde geändert und durch eine Admin erneut geprüft!', 'In Prüfung!');
        }
        return redirect(route('frontend.veranstaltungen.index'));
    }

    public function published(Request $request, Veranstaltungen $veranstaltungen)
    {
        if ($request->published) {
            Toastr::success('Veranstaltung wurde freigegeben!', 'Freigegeben!');
        } else {
            Toastr::error('Veranstaltung wurde verborgen!', 'Verborgen!');
        }

        Veranstaltungen::where('id', $veranstaltungen->id)->update([
            'published' => $request->published,
            'published_at' => $request->published ? now() : null,
            'updated_at' => now(),
        ]);
        return redirect(route('frontend.veranstaltungen.show', $veranstaltungen->slug));
    }

    public function destroy(Veranstaltungen $veranstaltungen)
    {
        $veranstaltungen->delete();
        Toastr::error('Veranstaltung wurde gelöscht!', 'Gelöscht!');
        return redirect(route('frontend.veranstaltungen.index'));
    }

    /**
     * @param Request $request
     * @param Veranstaltungen $veranstaltungen
     * @param mixed $slug
     * @param $admin
     * @return void
     */
    public function extracted(Request $request, Veranstaltungen $veranstaltungen, mixed $slug, $admin): void
    {
        $veranstaltungen->datum_von = Carbon::parse($request->von)->toDateTimeLocalString();
        $veranstaltungen->datum_bis = Carbon::parse($request->bis)->toDateTimeLocalString();
        $veranstaltungen->veranstaltung = $request->veranstaltung;
        $veranstaltungen->veranstaltungsort = $request->veranstaltungsort;
        $veranstaltungen->veranstalter = $request->veranstalter;
        $veranstaltungen->quelle = $request->quelle;
        $veranstaltungen->eintritt = $request->eintritt;
        $veranstaltungen->slug = $slug;
        $veranstaltungen->description = $request->beschreibung;
        $veranstaltungen->published = $admin ? true : false;
        $veranstaltungen->published_at = $admin ? now() : null;
        $veranstaltungen->save();
    }
}
