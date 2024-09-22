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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('user_tipId')->default(1);
            $table->string('tel', 16)->nullable();
            $table->string('adresa')->nullable();
            $table->string('sediste', 32)->nullable();
            $table->string('zip', 8)->nullable();
            $table->string('mb', 16)->nullable();
            $table->string('pib', 16)->nullable();
            $table->string('tr', 32)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
