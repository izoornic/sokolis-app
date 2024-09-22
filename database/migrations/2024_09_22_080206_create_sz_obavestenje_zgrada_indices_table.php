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
        Schema::create('sz_obavestenje_zgrada_indices', function (Blueprint $table) {
            $table->id();
            $table->integer('sz_obavestenjeId');
            $table->integer('zgradaId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sz_obavestenje_zgrada_indices');
    }
};
