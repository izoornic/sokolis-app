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
        Schema::table('email_obavestenja_tips', function (Blueprint $table) {
            $table->integer('uvek_ukljucen')->default(0)->after('naziv');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('email_obavestenja_tips', function (Blueprint $table) {
            //
        });
    }
};
