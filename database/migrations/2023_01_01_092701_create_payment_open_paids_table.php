<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_01_01_092701_create_payment_open_paids_table.php
 * User: ${USER}
 * Date: 1.${MONTH_NAME_FULL}.2023
 * Time: 9:27
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payment_open_paids', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('team_id');
            $table->tinyInteger('bezahlt')->default(0)->nullable();
            $table->timestamp('payment_for_month')->nullable();
            $table->timestamp('date_of_payment')->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_open_paids');
    }
};
