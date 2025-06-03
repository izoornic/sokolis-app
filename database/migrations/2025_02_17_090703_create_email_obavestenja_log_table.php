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
        Schema::create('email_obavestenja_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_obavestenja_tip_id')->constrained();
            $table->string('subject', 128);
            $table->text('message');
            $table->text('attachments')->nullable();
            $table->string('status', 128)->default('sent');
            $table->string('error', 128)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_obavestenja_logs');
    }
};
