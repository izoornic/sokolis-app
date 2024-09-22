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
        Schema::create('sz_obavestenjes', function (Blueprint $table) {
            $table->id();
            $table->integer('sz_ob_tipId')->default(1);
            $table->integer('sz_ob_broj_komentara')->default(0);
            $table->integer('sz_ob_broj_fajlova')->default(0);
            $table->string('sz_ob_naslov', 128);
            $table->text('sz_ob_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sz_obavestenjes');
    }
};
