<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_12_16_091257_create_assumed_meeting_table.php
 * User: ${USER}
 * Date: 16.${MONTH_NAME_FULL}.2022
 * Time: 9:12
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('assumed_meeting', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('kalender_id');
            $table->unsignedBigInteger('team_id');
            $table->tinyInteger('present');
            $table->string('cancellation_reason')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('memory')->nullable();

            $table->foreign('kalender_id')->references('id')->on('kalenders')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assumed_meeting');
    }
};
