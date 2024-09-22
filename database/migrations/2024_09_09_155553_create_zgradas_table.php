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
        Schema::create('zgradas', function (Blueprint $table) {
            $table->id();
            $table->integer('upravnikId');
            $table->string('naziv', 128);
            $table->string('adresa', 128);
            $table->string('zip', 8);
            $table->string('sediste', 32);
            $table->string('mb', 16);
            $table->string('pib', 16);
            $table->string('tr', 32);
            $table->string('banka', 128);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zgradas');
    }
};
