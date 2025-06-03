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
        Schema::create('email_zgrada_send_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_obavestenja_tip_id')->constrained();
            $table->foreignId('zgrada_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_zgrada_send_logs');
    }
};
