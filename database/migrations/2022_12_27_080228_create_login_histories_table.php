<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_12_27_080228_create_login_histories_table.php
 * User: ${USER}
 * Date: 27.${MONTH_NAME_FULL}.2022
 * Time: 8:2
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('login_histories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->string('ip_address')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('login_histories');
    }
};
