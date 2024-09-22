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
        Schema::create('stranicas', function (Blueprint $table) {
            $table->id();
            $table->string('stranica_naziv', 126);
            $table->string('route_name', 126);
            $table->integer('menu_order');
            $table->integer('show_in_menu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stranicas');
    }
};
