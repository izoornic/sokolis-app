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
        Schema::create('kvar_tiket_images', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->integer('kvar_tiketId');
            $table->string('image_path', 256);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kvar_tiket_images');
    }
};
