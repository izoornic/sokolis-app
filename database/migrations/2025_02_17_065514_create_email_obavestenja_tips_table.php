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
        Schema::create('email_obavestenja_tips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_obavestenja_kategorija_id')->constrained();
            $table->string('naziv', 64);
            $table->string('opis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_obavestenja_tips');
    }
};
