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
        Schema::create('stans', function (Blueprint $table) {
            $table->id();
            $table->integer('zgradaId');
            $table->integer('spb');
            $table->string('stanbr', 16);
            $table->integer('vlasnistvo')->default(100);
            $table->integer('sprat');
            $table->decimal('povrsina', 7, 2);
            $table->integer('garaza')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stans');
    }
};
