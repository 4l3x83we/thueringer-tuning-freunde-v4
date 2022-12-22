<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Assumed_Meeting.php
 * User: ${USER}
 * Date: 16.${MONTH_NAME_FULL}.2022
 * Time: 9:26
 */

namespace App\Models\Intern\Kalender;

use Illuminate\Database\Eloquent\Model;

class Assumed_Meeting extends Model
{
    protected $table = 'assumed_meeting';

    protected $fillable = [
        'kalender_id',
        'team_id',
        'present',
        'cancellation_reason',
        'email',
        'memory',
    ];

    public function kalender()
    {
        return $this->belongsTo(Kalender::class);
    }
}
