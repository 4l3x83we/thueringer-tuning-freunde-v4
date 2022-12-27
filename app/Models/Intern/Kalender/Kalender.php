<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Kalender.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2022
 * Time: 8:44
 */

namespace App\Models\Intern\Kalender;

use App\Models\Frontend\Team\Team;
use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Kalender extends Model
{
    use LogsActivity;

    protected $table = 'kalenders';

    protected $guarded = [];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'kalender_team');
    }

    public function kalendertype()
    {
        return $this->belongsToMany(KalenderType::class, 'kalenders_kalendertype');
    }

    public function assumed_meeting()
    {
        return $this->hasMany(Assumed_Meeting::class);
    }

    public function showIndex()
    {
        $kalender = [];
        $kalenders = self::where('bis', '>=', now())->orderBy('published', 'ASC')->get();
        $kalenders->type = KalenderType::get();
        foreach ($kalenders as $item => $kalender) {
            $kalenders[$item]['team'] = self::find($kalender->id)->teams[0];
            $kalenders[$item]['kalendertype'] = self::find($kalender->id)->kalendertype[0];
            $kalenders[$item]['cp'] = Team::where('id', self::find($kalender->id)->kalendertype[0]->cp_user_id)->first();
            $kalenders[$item]['assumed_meeting'] = Assumed_Meeting::where('kalender_id', $kalender->id)->get();
        }
        if (!empty($kalender->assumed_meeting)) {
            $teamCount = count(Team::where('published', true)->get());
            $assumed_meeting = count($kalender->assumed_meeting);
            $summe = $teamCount - $assumed_meeting;
            $durchschnitt = $teamCount / 2;
            $kalender->true = $durchschnitt >= $summe;
        }
        return $kalenders;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('Kalender')
            ->dontSubmitEmptyLogs();
    }
}
