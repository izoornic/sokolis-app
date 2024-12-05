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
        Schema::create('garazas', function (Blueprint $table) {
            $table->id();
            $table->integer('stanId');
            $table->integer('zgradaId');
            $table->integer('stan_namenaId');
            $table->decimal('gpovrsina', 7, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garazas');
    }
};
