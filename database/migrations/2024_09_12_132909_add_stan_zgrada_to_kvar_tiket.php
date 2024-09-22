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
        Schema::table('kvar_tikets', function (Blueprint $table) {
            //
            $table->integer('zgradaId');
            $table->integer('stanId');
            $table->integer('vidljiv_zgradi')->default(0);
            $table->integer('tiket_br_komentara')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kvar_tikets', function (Blueprint $table) {
            //
        });
    }
};
