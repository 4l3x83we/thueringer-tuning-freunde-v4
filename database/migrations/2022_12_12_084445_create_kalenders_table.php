<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2022_12_12_084445_create_kalenders_table.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2022
 * Time: 8:44
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kalenders', function (Blueprint $table) {
            $table->id();

            $table->timestamp('von')->nullable();
            $table->timestamp('bis')->nullable();
            $table->mediumText('description');
            $table->string('eigenesFZ')->nullable();
            $table->tinyInteger('assumed')->default(false)->nullable();
            $table->tinyInteger('published')->default(false)->nullable();
            $table->timestamp('published_at')->nullable();
            $table->string('google_id')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kalenders');
    }
};
