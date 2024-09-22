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
        Schema::create('sz_obavestenja_files', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->integer('sz_obavestenjeId');
            $table->string('sz_file_path', 256);
            $table->integer('sz_file_typeId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sz_obavestenja_files');
    }
};
