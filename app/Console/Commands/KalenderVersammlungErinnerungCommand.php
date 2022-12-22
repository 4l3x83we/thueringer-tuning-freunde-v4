<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: KalenderVersammlungErinnerungCommand.php
 * User: ${USER}
 * Date: 17.${MONTH_NAME_FULL}.2022
 * Time: 7:5
 */

namespace App\Console\Commands;

use App\Models\Frontend\Team\Team;
use App\Models\Intern\Kalender\Assumed_Meeting;
use App\Models\Intern\Kalender\Kalender;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mail;

class KalenderVersammlungErinnerungCommand extends Command
{
    protected $signature = 'kalender:versammlung-erinnerung';

    protected $description = 'Erinnerung an Versammlung versenden nach Bestätigung durch Team Mitglied.';

    public function handle()
    {
        $kalender = Kalender::where('von', '>', now())->get();
        foreach ($kalender as $kalenderID) {
            $assumed = Assumed_Meeting::where('kalender_id', '=', $kalenderID->id)
                ->join('kalenders', 'kalenders.id', '=', 'assumed_meeting.kalender_id')
                ->select('kalenders.*', 'assumed_meeting.team_id', 'assumed_meeting.*', 'kalenders.created_at', 'kalenders.updated_at')
                ->where('present', '=', 1)
                ->get();
        }
        foreach ($assumed as $value) {
            $teams = Team::where('id', $value->team_id)->first();
            $dateVon = Carbon::parse($value->von)->format('Y-m-d');
            $dateBis = Carbon::parse($value->bis)->format('Y-m-d');
            $limit = Carbon::parse($dateVon)->subDay($value->memory);
            $delete = Carbon::parse($dateBis)->subDay($value->memory - 1);
            $dateTrue = Carbon::parse($limit) == Carbon::parse(today());
            $deleteTrue = Carbon::parse($delete) == Carbon::parse(today());
            $kalenders = $value;
            $kalenders->teams = $teams;
            $kalenders->vorname = $teams->vorname;
            $kalenders->adresse = explode(', ', $kalenders->eigenesFZ)[1] . ' ' . explode(',', $kalenders->eigenesFZ)[2];
            if ($dateTrue) {
                Mail::to($kalenders->email)->send(new \App\Mail\Kalender\VersammlungsErinnerungsMail($kalenders));
            }
            if ($deleteTrue) {
                $value->delete();
            }
        }
    }
}
