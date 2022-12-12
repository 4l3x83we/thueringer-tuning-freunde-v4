<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_12_12_065051_add_teams_table.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2022
 * Time: 6:50
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('zahlungsArt')->after('ip_adresse')->nullable();
            $table->string('zahlung')->after('zahlungsArt')->nullable();
        });
    }

    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('zahlungsArt');
            $table->dropColumn('zahlung');
        });
    }
};
