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
        Schema::create('kvar_tiket_prioritets', function (Blueprint $table) {
            $table->id();
            $table->string('prioritet_naziv', 64);
            $table->string('prioritet_txt_collor', 16);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kvar_tiket_prioritets');
    }
};
