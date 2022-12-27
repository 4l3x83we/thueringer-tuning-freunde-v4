<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_12_27_075408_add_users_table.php
 * User: ${USER}
 * Date: 27.${MONTH_NAME_FULL}.2022
 * Time: 7:54
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('last_login_at')->after('remember_token')->nullable();
            $table->string('last_login_ip')->after('last_login_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_login_at');
            $table->dropColumn('last_login_ip');
        });
    }
};
