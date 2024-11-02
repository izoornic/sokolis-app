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
        Schema::create('obavestenja_links', function (Blueprint $table) {
            $table->id();
            $table->integer('obavestenjeId');
            $table->string('ob_link_tekst', 256);
            $table->string('ob_link_adress', 256);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obavestenja_links');
    }
};
