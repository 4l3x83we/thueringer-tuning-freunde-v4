<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: KalendersController.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2022
 * Time: 8:44
 */

namespace App\Http\Controllers\Intern\Kalender;

use App\Http\Controllers\Controller;
use App\Mail\Calendar\CalendarEintragEingegangenMail;
use App\Mail\Calendar\CalendarEintragMail;
use App\Models\Frontend\Team\Team;
use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use App\Models\Intern\Kalender\Kalender;
use App\Models\Intern\Kalender\KalenderType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\GoogleCalendar\Event;
use Yoeunes\Toastr\Facades\Toastr;

class KalendersController extends Controller
{
    public function index()
    {
        $veranstaltungens = Veranstaltungen::where('datum_bis', '>=', now())->where('anwesend', true)->get();
        $calender_workshop = Kalender::where('bis', '>=', now())->orderBy('published', 'ASC')->get();
        $calender_workshop->type = KalenderType::get();
        $calender = null;
        foreach ($calender_workshop as $item => $calender) {
            $calender_workshop[$item]['team'] = Kalender::find($calender->id)->teams[0];
            $calender_workshop[$item]['kalendertype'] = Kalender::find($calender->id)->kalendertype[0];
            $calender_workshop[$item]['cp'] = Team::where('id', Kalender::find($calender->id)->kalendertype[0]->cp_user_id)->first();
        }
        return view('intern.calendar.index', compact('veranstaltungens', 'calender_workshop'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        if ($request->type === 'Versammlung') {
            $validator = Validator::make($request->all(), [
                'von' => 'required|date',
                'bis' => 'required|date',
                'type' => 'required',
                'description' => 'required|max:255',
                'eigenesFZ' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'von' => 'required|date',
                'bis' => 'required|date',
                'type' => 'required',
                'description' => 'required|max:255',
                'eigenesFZ' => 'required',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('intern.kalender.index')->withErrors($validator)->withInput();
        }

        $user_id = Team::where('user_id', auth()->user()->id)->first();
        $type_id = KalenderType::where('id', $request->type)->first();
        $cp_user_id = Team::where('user_id', $type_id->cp_user_id)->first();

        $kalender = new Kalender();
        $kalender->von = $request->von;
        $kalender->bis = $request->bis;
        $kalender->description = $request->description;
        $kalender->eigenesFZ = $request->eigenesFZ === 'Ja';
        $kalender->save();

        $kalender->kalendertype()->attach($type_id->id);
        $kalender->teams()->attach($user_id->id);
        $kalender->user = $user_id;
        $kalender->team = $cp_user_id;
        $kalender->type = $type_id->type;
        // Mail
        Mail::to('info@thueringer-tuning-freunde.de')->send(new CalendarEintragMail($kalender));
        Toastr::success('Der Eintrag wurde in der Datenbank gespeichert und wird nun geprüft und freigegeben.', 'Erfolgreich!');
        return redirect()->route('intern.kalender.index');
    }

    public function storeEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'von' => 'required|date',
            'bis' => 'required|date',
            'type' => 'required',
            'description' => 'required|max:16777215',
            'name' => 'required',
            'straße' => 'required',
            'ort' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('intern.kalender.index')->withErrors($validator)->withInput();
        }

        $user_id = Team::where('user_id', auth()->user()->id)->first();
        $type_id = KalenderType::where('id', $request->type)->first();
        $cp_user_id = Team::where('user_id', $type_id->cp_user_id)->first();

        $verOrt = $request->name . ', ' . $request->straße . ', ' . $request->ort;

        $event = new Event;
        $event->name = "Versammlung in: " . explode(' ', $request->ort)[1] . "\nIn der Location: " . $verOrt;
        $event->startDateTime = Carbon::parse($request->von);
        $event->endDateTime = Carbon::parse($request->bis);
        $event->description = $request->description;
        $newEvent = $event->save();

        $kalender = new Kalender();
        $kalender->von = $request->von;
        $kalender->bis = $request->bis;
        $kalender->description = $request->description;
        $kalender->eigenesFZ = $verOrt;
        $kalender->google_id = $newEvent->id;
        $kalender->published = 1;
        $kalender->published_at = now();
        $kalender->save();

        $kalender->kalendertype()->attach($type_id->id);
        $kalender->teams()->attach($user_id->id);
        $kalender->user = $user_id;
        $kalender->team = $cp_user_id;
        $kalender->type = $type_id->type;

        // Mail
        Mail::to('info@thueringer-tuning-freunde.de')->send(new CalendarEintragMail($kalender));
        Toastr::success('Der Eintrag wurde in der Datenbank gespeichert und wird nun geprüft und freigegeben.', 'Erfolgreich!');
        return redirect()->route('intern.kalender.index');
    }

    public function show(Kalender $kalender)
    {
    }

    public function edit(Kalender $kalender)
    {
    }

    public function update(Request $request, Kalender $kalender)
    {
        $user_id = Team::where('user_id', auth()->user()->id)->first();
        $type_id = KalenderType::where('id', $request->type)->first();
        $cp_user_id = Team::where('user_id', $type_id->cp_user_id)->first();

        $event = new Event;
        $event->name = $type_id->type . ' Reserviert von: ' . $user_id->vorname . ' ' . $user_id->nachname[0] . '.';
        $event->startDateTime = Carbon::parse($kalender->von);
        $event->endDateTime = Carbon::parse($kalender->bis);
        $event->description = $kalender->description . "\n\nEigenes Fahrzeug: " . ($kalender->eigenesFZ === 1 ? "Ja" : "Nein");
        $newEvent = $event->save();

        $kalender->assumed = true;
        $kalender->published = true;
        $kalender->published_at = now();
        $kalender->google_id = $newEvent->id;
        $kalender->updated_at = now();
        $kalender->save();

        $kalender->user = $user_id;
        $kalender->team = $cp_user_id;
        $kalender->type = $type_id;
        // E-Mail
        if ($type_id->id === 1) {
            $kalender->subject = 'Eine neue Versammlung steht an!';
            Mail::to('club@thueringer-tuning-freunde.de')->send(new CalendarEintragEingegangenMail($kalender));
        } else {
            Mail::to($cp_user_id->email)->send(new CalendarEintragEingegangenMail($kalender));
        }
        Toastr::info('Der Kalendereintrag wurde genehmigt.', 'Update!');
        return redirect()->route('intern.kalender.index');
    }

    public function updateEvent(Request $request, Kalender $kalender)
    {
        $kalender->assumed = $request->assumed;
        $kalender->published_at = now();
        $kalender->save();

        Toastr::info('Die Versammlung wurde mehrheitlich bestätigt.', 'Update!');
        return redirect()->route('intern.kalender.index');
    }

    public function destroy(Request $request, Kalender $kalender)
    {
        $event = Event::find($kalender->google_id);
        $user_id = Team::where('user_id', $request->user_id)->first();
        $type_id = KalenderType::where('id', $request->type)->first();
        $kalender->kalendertype()->detach($type_id->id);
        $kalender->teams()->detach($user_id->id);
        $event->delete();
        $kalender->delete();

        Toastr::error('Der Kalendereintrag wurde gelöscht.', 'Gelöscht!');
        return redirect(route('intern.kalender.index'));
    }

    public function assumed_meeting(Request $request, Kalender $kalender)
    {
        dd($request->all(), $kalender);
    }
}
