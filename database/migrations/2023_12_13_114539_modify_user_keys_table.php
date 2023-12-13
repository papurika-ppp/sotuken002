<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('mysql_second')->table('user_keys', function (Blueprint $table) {
            $table->string('privatekey', 2000)->change();
            $table->string('hashpublickey', 2000)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql_second')->table('user_keys', function (Blueprint $table) {
            $table->string('privatekey', 1500)->change();
            $table->string('hashpublickey', 1000)->change();
        });
    }
};
