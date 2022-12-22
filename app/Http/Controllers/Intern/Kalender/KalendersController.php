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
use App\Mail\Calendar\CalendarUpdatedMail;
use App\Mail\Calendar\TeilnahmeMail;
use App\Mail\Calendar\TeilnahmeMailAdminMail;
use App\Models\Frontend\Team\Team;
use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use App\Models\Intern\Kalender\Assumed_Meeting;
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
            $calender_workshop[$item]['assumed_meeting'] = Assumed_Meeting::where('kalender_id', $calender->id)->get();
        }
        $teamCount = count(Team::where('published', true)->get());
        $assumed_meeting = count($calender->assumed_meeting);
        $summe = $teamCount - $assumed_meeting;
        $durchschnitt = $teamCount / 2;
        $calender->true = $durchschnitt >= $summe;
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
        return $this->extracted($kalender, $type_id, $user_id, $cp_user_id);
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
        return $this->extracted($kalender, $type_id, $user_id, $cp_user_id);
    }

    public function show(Kalender $kalender)
    {
    }

    public function edit(Kalender $kalender)
    {
        $kalender->types = KalenderType::get();
        $kalender->type = $kalender->kalendertype;
        return view('intern.calendar.edit', compact('kalender'));
    }

    public function updateTermin(Request $request, Kalender $kalender)
    {
        foreach ($kalender->teams as $teams) {
            $team = $teams;
        }
        foreach ($kalender->kalendertype as $kalendertype) {
            $type = $kalendertype;
        }
        $cp_user_id = Team::where('user_id', $type->cp_user_id)->first();

        $kalender->von = $request->von;
        $kalender->bis = $request->bis;
        $kalender->description = $request->description;
        $kalender->eigenesFZ = $request->eigenesFZ === 'Ja' ? 1 : 0;
        $kalender->save();
        $kalender->kalendertype()->sync($request->type);

        $kalender->user = $team;
        $kalender->team = $cp_user_id;
        $kalender->type = $type;
        $kalender->originals = $kalender->getOriginal();
        $kalender->attributes = $kalender->getAttributes();
        $kalender->changes = $kalender->getChanges();

        $event = Event::find($kalender->google_id);
        $newEvent = $this->getEvent($type, $team, $event, $kalender);

        Mail::to([$cp_user_id->email, $team->email])->send(new CalendarUpdatedMail($kalender));
        Toastr::info('Der Kalendereintrag wurde geändert.', 'Geändert!');
        return redirect(route('intern.kalender.index'));
    }

    public function update(Request $request, Kalender $kalender)
    {
        $user_id = Team::where('user_id', auth()->user()->id)->first();
        $type_id = KalenderType::where('id', $request->type)->first();
        $cp_user_id = Team::where('user_id', $type_id->cp_user_id)->first();

        $event = new Event;
        $newEvent = $this->getEvent($type_id, $user_id, $event, $kalender);

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
        $assumedTrue = Assumed_Meeting::where('team_id', $request->team_id)->first();
        $von = \Carbon\Carbon::parse($kalender->von)->format('d.m.Y');
        $cancel = $request->cancellation_reason;
        $assumed = new Assumed_Meeting();
        $assumed->kalender_id = $kalender->id;
        $assumed->team_id = $request->team_id;
        $assumed->present = $request->present;
        $assumed->memory = $request->memory;
        $assumed->email = $request->email;
        $assumed->cancellation_reason = $cancel;
        if (empty($cancel)) {
            $assumed->save();
            Toastr::success("Deine Bestätigung zu Teilnahme an der Veranstaltung am {$von} wurde gespeichert.", 'Erfolgreich');
            Mail::to($assumed->email)->send(new TeilnahmeMail($kalender, $assumed));
            Mail::to('admin@thueringer-tuning-freunde.de')->send(new TeilnahmeMailAdminMail($kalender, $assumed));
        } else {
            Toastr::info("Deine Absage zur Teilnahme an der Veranstaltung am {$von} wurde gespeichert.", 'Erfolgreich');
            Mail::to($assumed->email)->send(new TeilnahmeMail($kalender, $assumed));
            Mail::to('admin@thueringer-tuning-freunde.de')->send( new TeilnahmeMailAdminMail($kalender, $assumed));
        }
        return redirect(route('intern.dashboard.index'));
    }

    /**
     * @param Kalender $kalender
     * @param $type_id
     * @param $user_id
     * @param $cp_user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function extracted(Kalender $kalender, $type_id, $user_id, $cp_user_id): \Illuminate\Http\RedirectResponse
    {
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

    /**
     * @param mixed $type
     * @param mixed $team
     * @param Event $event
     * @param Kalender $kalender
     * @return Event
     */
    public function getEvent(mixed $type, mixed $team, Event $event, Kalender $kalender): Event
    {
        $event->name = $type->type . ' Reserviert von: ' . $team->vorname . ' ' . $team->nachname[0] . '.';
        $event->startDateTime = Carbon::parse($kalender->von);
        $event->endDateTime = Carbon::parse($kalender->bis);
        $event->description = $kalender->description . "\n\nEigenes Fahrzeug: " . ($kalender->eigenesFZ === 1 ? "Ja" : "Nein");
        $newEvent = $event->save();
        return $newEvent;
    }
}
