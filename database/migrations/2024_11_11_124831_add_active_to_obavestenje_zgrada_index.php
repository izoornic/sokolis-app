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
            $table->integer('active')->after('zgradaId')->default(1);
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
