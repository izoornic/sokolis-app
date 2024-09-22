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
        Schema::create('obavestenje_komentaris', function (Blueprint $table) {
            $table->id();
            $table->integer('obavestenjeId');
            $table->integer('userId');
            $table->string('komentar', 256);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obavestenje_komentaris');
    }
};
