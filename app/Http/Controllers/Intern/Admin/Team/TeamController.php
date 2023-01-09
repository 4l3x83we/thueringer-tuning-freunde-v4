<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: TeamController.php
 * User: ${USER}
 * Date: 27.${MONTH_NAME_FULL}.2022
 * Time: 11:10
 */

namespace App\Http\Controllers\Intern\Admin\Team;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Team\Team;
use App\Models\Intern\Admin\PaymentOpenPaid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yoeunes\Toastr\Facades\Toastr;

class TeamController extends Controller
{
    public function index()
    {
        $teams = DB::table('teams')->where('published', true)->get();
        $zahlung = [];
        for ($i = 0; $i < count($teams) - 1; $i++) {
            $zahlung[$i] = $teams[$i]->zahlung;
        }
        $teams->gesamt = array_sum($zahlung);
        /*$jahr = PaymentOpenPaid::select(DB::raw('jahr as GesamtJahr'))
        ->groupBy('gesamtJahr')
        ->get();
        $payments = PaymentOpenPaid::all();
        $teams->names = PaymentOpenPaid::select(DB::raw('name as Name'))->groupBy('Name')->get();
        $teams->jahr = $jahr;
        $teams->payments = $payments;*/
        $team = DB::table('teams')->find(1);
        dd($team->payment_open_paids);
        return view('intern.admin.team.team-zahlung', compact('teams'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $team = null;
        $now = Carbon::now();
        $startMonth = ltrim($now->startOfMonth()->format('m'), '0');
        $endMonth = ltrim($now->endOfYear()->format('m'), '0');
        foreach ($request->teamID as $item => $teamID) {
            $team[$item] = Team::where('id', $teamID)->first();
        }
        for ($t = 0; $t <= count($team) - 1; $t++) {
            for ($i = $startMonth; $i <= $endMonth; $i++) {
                $test[$i] = new PaymentOpenPaid();
                $test[$i]->name = $team[$t]->vorname . ' ' . $team[$t]->nachname;
                $test[$i]->zahlung = number_format($team[$t]->zahlung, 2);
                $test[$i]->monat = Carbon::parse('01.' . $i . '.' . $now->year)->isoFormat('MM');
                $test[$i]->jahr = Carbon::parse('01.' . $i . '.' . $now->year)->isoFormat('YYYY');
                $test[$i]->save();
            }
        }
        Toastr::success('Die Zeilen wurden angelegt.');
        return redirect(route('intern.admin.zahlungen.index'));
    }

    public function show(Team $team)
    {
    }

    public function edit(Team $team)
    {
    }

    public function editEuro(Team $team)
    {
    }

    public function update(Request $request, Team $team)
    {
    }

    public function updateEuro(Request $request, Team $team)
    {
    }

    public function destroy(Team $team)
    {
    }
}
