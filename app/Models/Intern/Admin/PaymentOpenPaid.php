<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: PaymentOpenPaid.php
 * User: ${USER}
 * Date: 1.${MONTH_NAME_FULL}.2023
 * Time: 9:27
 */

namespace App\Models\Intern\Admin;

use App\Models\Frontend\Team\Team;
use Illuminate\Database\Eloquent\Model;

class PaymentOpenPaid extends Model
{
    protected $table = 'payment_open_paids';

    public function teams()
    {
        $this->belongsTo(Team::class);
    }
}
