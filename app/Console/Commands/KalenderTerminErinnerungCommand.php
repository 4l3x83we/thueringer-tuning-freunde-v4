<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: KalenderTerminErinnerungCommand.php
 * User: ${USER}
 * Date: 20.${MONTH_NAME_FULL}.2022
 * Time: 9:46
 */

namespace App\Console\Commands;

use App\Models\Frontend\Team\Team;
use App\Models\Intern\Kalender\Kalender;
use App\Models\Intern\Kalender\KalenderType;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mail;

class KalenderTerminErinnerungCommand extends Command
{
    protected $signature = 'kalender:termin-erinnerung';

    protected $description = 'Terminerinnerung';

    public function handle()
    {
        $kalenderDelete = \App\Models\Intern\Kalender\Kalender::where('bis', '<', Carbon::parse(today())->subDay(1))
            ->join('kalenders_kalendertype', 'kalenders_kalendertype.kalender_id', '=', 'kalenders.id')
            ->join('kalender_team', 'kalender_team.kalender_id', '=', 'kalenders.id')
            ->get();
        foreach ($kalenderDelete as $delete) {
            $user_id = Team::where('user_id', $delete->team_id)->first();
            $type_id = KalenderType::where('id', $delete->kalender_type_id)->first();
            $delete->kalendertype()->detach($type_id->id);
            $delete->teams()->detach($user_id->id);
            $delete->delete();
        }
        $kalenderEntry = Kalender::select('kalenders.*', 'kalenders.id as kalender_id', 'kalendertype.*', 'CpUserID.vorname as team_vorname', 'CpUserID.nachname as team_nachname', 'CpUserID.email as team_email', 'CpUserID.mobil as team_mobil', 'teams.vorname', 'teams.nachname', 'teams.email', 'CpUserID.title as team_title')
            ->join('kalenders_kalendertype', 'kalenders_kalendertype.kalender_id', '=', 'kalenders.id')
            ->join('kalender_team', 'kalender_team.kalender_id', '=', 'kalenders.id')
            ->join('teams', 'kalender_team.team_id', '=', 'teams.id')
            ->join('kalendertype', 'kalendertype.id', '=', 'kalenders_kalendertype.kalender_type_id')
            ->join('teams as CpUserID', 'kalendertype.cp_user_id', '=', 'CpUserID.id')
            ->where('kalendertype.typeColor', '!=', 'ver')
            ->where('kalenders.von', '>=', Carbon::parse(today())->addDay(1))
            ->where('kalenders.von', '<=', Carbon::parse(today())->addDay(2))
            ->where('kalenders.published', '=', true)
            ->get();
        foreach ($kalenderEntry as $item => $kalender) {
            $kalenders = $kalender;
            Mail::to($kalender->email)->send(new \App\Mail\Kalender\ErinnerungTerminMail($kalenders));
        }
    }
}
