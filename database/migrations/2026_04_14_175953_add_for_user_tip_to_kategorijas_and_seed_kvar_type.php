<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('email_obavestenja_kategorijas', function (Blueprint $table) {
            // 1 = stanari, 2 = upravnici
            $table->integer('for_user_tip')->default(1)->after('kategorija_opis');
        });

        $katId = DB::table('email_obavestenja_kategorijas')->insertGetId([
            'kategorija_naziv' => 'Kvarovi',
            'kategorija_opis'  => 'Obaveštenja vezana za prijave kvarova',
            'for_user_tip'     => 2,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        DB::table('email_obavestenja_tips')->insert([
            'email_obavestenja_kategorija_id' => $katId,
            'naziv'         => 'Nova prijava kvara',
            'uvek_ukljucen' => 0,
            'opis'          => 'Dobijam email kada stanar prijavi novi kvar',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
    }

    public function down(): void
    {
        $kat = DB::table('email_obavestenja_kategorijas')
            ->where('kategorija_naziv', 'Kvarovi')
            ->where('for_user_tip', 2)
            ->first();

        if ($kat) {
            $tip = DB::table('email_obavestenja_tips')
                ->where('email_obavestenja_kategorija_id', $kat->id)
                ->where('naziv', 'Nova prijava kvara')
                ->first();

            if ($tip) {
                DB::table('email_obavestenja_users')
                    ->where('email_obavestenja_tip_id', $tip->id)
                    ->delete();

                DB::table('email_obavestenja_tips')->where('id', $tip->id)->delete();
            }

            DB::table('email_obavestenja_kategorijas')->where('id', $kat->id)->delete();
        }

        Schema::table('email_obavestenja_kategorijas', function (Blueprint $table) {
            $table->dropColumn('for_user_tip');
        });
    }
};
