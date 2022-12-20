<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: KalenderErinnerungAnsprechpartnerCommand.php
 * User: ${USER}
 * Date: 20.${MONTH_NAME_FULL}.2022
 * Time: 8:21
 */

namespace App\Console\Commands;

use App\Models\Intern\Kalender\Kalender;
use App\Models\Intern\Kalender\KalenderType;
use Illuminate\Console\Command;
use Mail;

class KalenderErinnerungAnsprechpartnerCommand extends Command
{
    protected $signature = 'kalender:erinnerung-ansprechpartner';

    protected $description = 'Terminerinnerung für unsere Ansprechpartner';

    public function handle()
    {
        $kalenderTypes = KalenderType::join('kalenders_kalendertype', 'kalendertype.id', '=', 'kalenders_kalendertype.kalender_type_id')
            ->get();
        foreach ($kalenderTypes as $item => $kalenderType) {
            $cpUserID[$item] = $kalenderType->cp_user_id;
        }
        foreach (array_unique($cpUserID) as $item => $id) {
            $kalenderEntry[$item] = Kalender::select('kalenders.*', 'kalenders.id as kalender_id', 'kalendertype.*', 'CpUserID.vorname', 'CpUserID.nachname', 'CpUserID.email', 'teams.vorname as team_vorname', 'teams.nachname as team_nachname', 'teams.email as team_email', 'teams.title as team_title')
                ->join('kalenders_kalendertype', 'kalenders_kalendertype.kalender_id', '=', 'kalenders.id')
                ->join('kalender_team', 'kalender_team.kalender_id', '=', 'kalenders.id')
                ->join('teams', 'kalender_team.team_id', '=', 'teams.id')
                ->join('kalendertype', 'kalendertype.id', '=', 'kalenders_kalendertype.kalender_type_id')
                ->join('teams as CpUserID', 'kalendertype.cp_user_id', '=', 'CpUserID.id')
                ->where('kalendertype.cp_user_id', '=', $id)
                ->where('kalendertype.typeColor', '!=', 'ver')
                ->where('kalenders.von', '>=', today())
                ->orderBy('von', 'ASC')
                ->get();
        }
        foreach ($kalenderEntry as $item => $kalender) {
            $kalenders = $kalender;
            foreach ($kalenders as $kalender) {
                $email[$item] = $kalender->email;
                $kalenders->vorname = $kalender->vorname;
            }
            foreach (array_unique($email) as $mail) {
                if($kalender->email === $mail) {
                    Mail::to($mail)->send(new \App\Mail\Kalender\ErinnerungTerminKontaktpersonMail($kalenders));
                }
            }
        }
    }
}
