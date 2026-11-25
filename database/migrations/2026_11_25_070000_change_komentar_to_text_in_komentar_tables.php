<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Kolona 'komentar' je bila VARCHAR(256) – duži komentari su pucali sa
 * SQLSTATE[22001] Data too long. Prebacuje se na TEXT, a dužinu ograničava
 * validacija u Livewire komponentama (max 2000).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kvar_komentaris', function (Blueprint $table) {
            $table->text('komentar')->change();
        });

        Schema::table('obavestenje_komentaris', function (Blueprint $table) {
            $table->text('komentar')->change();
        });
    }

    public function down(): void
    {
        // Napomena: down() će odseći/odbiti komentare duže od 256 karaktera.
        Schema::table('kvar_komentaris', function (Blueprint $table) {
            $table->string('komentar', 256)->change();
        });

        Schema::table('obavestenje_komentaris', function (Blueprint $table) {
            $table->string('komentar', 256)->change();
        });
    }
};
