<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_03_11_060304_add_ip_adresse_to_kontakts_table.php
 * User: ${USER}
 * Date: 11.${MONTH_NAME_FULL}.2023
 * Time: 6:3
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kontakts', function (Blueprint $table) {
            $table->string('ip_adresse', 45)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('kontakts', function (Blueprint $table) {
            $table->dropColumn('ip_adresse');
        });
    }
};
