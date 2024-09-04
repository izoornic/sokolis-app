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
        Schema::create('kvar_tikets', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->integer('tiket_statusId');
            $table->integer('tiket_prioritetId');
            $table->integer('opis_kvaraId')->nullable();
            $table->text('opis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kvar_tikets');
    }
};
