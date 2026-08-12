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
        Schema::create('kvar_tiket_upravnik_views', function (Blueprint $table) {
            $table->id();
            $table->integer('kvar_tiketId');
            $table->integer('userId');
            $table->timestamp('prvi_pregled')->nullable();
            $table->timestamp('poslednji_pregled')->nullable();
            $table->integer('broj_pregleda')->default(0);
            $table->timestamps();

            $table->unique(['kvar_tiketId', 'userId']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kvar_tiket_upravnik_views');
    }
};
