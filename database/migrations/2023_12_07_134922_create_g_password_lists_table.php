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
        Schema::create('g_password_lists', function (Blueprint $table) {
            $table->id('management_number');
            $table->string('user_id');
            $table->string('site_name');
            $table->string('url');
            $table->string('management_account');
            $table->string('management_account_password');
            $table->string('comment')->nullable();
            $table->foreignId('group_id');
            $table->foreign('group_id')->references('group_id')->on('teams');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g_password_lists');
    }
};
