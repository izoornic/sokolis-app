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
        Schema::table('obavestenje_zgrada_indices', function (Blueprint $table) {
            //
            $table->boolean('email_sent')->default(0)->after('zgradaId')->comment('Da li je email poslat za ovo obaveštenje');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('obavestenje_zgrada_indices', function (Blueprint $table) {
            //
        });
    }
};
