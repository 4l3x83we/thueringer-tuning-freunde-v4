<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_12_12_085117_create_kalenders_users_table.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2022
 * Time: 8:51
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kalender_team', function (Blueprint $table) {
            $table->foreignId('kalender_id')->constrained('kalenders');
            $table->foreignId('team_id')->constrained('teams');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kalenders_teams');
    }
};
