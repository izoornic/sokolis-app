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
        Schema::create('email_obavestenja_kategorijas', function (Blueprint $table) {
            $table->id();
            $table->string('kategorija_naziv', 64);
            $table->string('kategorija_opis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_obavestenja_kategorijas');
    }
};
