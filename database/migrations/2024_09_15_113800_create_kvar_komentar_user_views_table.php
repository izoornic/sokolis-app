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
        Schema::create('kvar_komentar_user_views', function (Blueprint $table) {
            $table->id();
            $table->integer('kvar_tiketId');
            $table->integer('userId');
            $table->integer('broj_vidjenih')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kvar_komentar_user_views');
    }
};
