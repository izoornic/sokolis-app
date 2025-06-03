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
        Schema::table('zgradas', function (Blueprint $table) {
            //
            $table->integer('zid')->nullable()->after('id')->comment('ZID - ID zgrade u aplikaciji Upravnik Zgrade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zgradas', function (Blueprint $table) {
            //
        });
    }
};
