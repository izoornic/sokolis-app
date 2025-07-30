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
        Schema::table('sz_obavestenje_zgrada_indices', function (Blueprint $table) {
            //
            $table->boolean('email_sent')->default(false)->after('zgradaId'); // Adjust 'some_existing_column' as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sz_obavestenje_zgrada_indices', function (Blueprint $table) {
            //
        });
    }
};
