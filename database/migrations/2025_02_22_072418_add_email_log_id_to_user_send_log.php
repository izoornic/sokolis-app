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
        Schema::table('email_user_send_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('email_log_id')->nullable()->after('id');
            $table->foreign('email_log_id')->references('id')->on('email_obavestenja_logs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('email_user_send_logs', function (Blueprint $table) {
            //
        });
    }
};
