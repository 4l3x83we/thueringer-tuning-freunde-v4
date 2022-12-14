<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_12_14_154038_add_users_last_seen_table.php
 * User: ${USER}
 * Date: 14.${MONTH_NAME_FULL}.2022
 * Time: 15:40
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('last_seen')->nullable()->after('password');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_seen');
        });
    }
};
