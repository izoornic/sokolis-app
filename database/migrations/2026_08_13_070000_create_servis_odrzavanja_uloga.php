<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Uloga "servis održavanja" (user_tipId = 4):
 *  - svoja tabela dodeljenih zgrada
 *  - svoje stranice i prava pristupa (samo tiketi)
 *  - svoja kategorija email obaveštenja (nova prijava + novi komentar)
 */
return new class extends Migration
{
    private const USER_TIP_ID = 4;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servis_zgrada_indices', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->integer('zgradaId');
            $table->timestamps();

            $table->unique(['userId', 'zgradaId']);
        });

        // naziv uloge ne staje u zatecenih varchar(8)
        Schema::table('user_tips', function (Blueprint $table) {
            $table->string('tip_naziv', 64)->change();
        });

        $now = now();

        // 1. Nova uloga
        if (!DB::table('user_tips')->where('id', self::USER_TIP_ID)->exists()) {
            DB::table('user_tips')->insert([
                'id'         => self::USER_TIP_ID,
                'tip_naziv'  => 'servis održavanja',
                'tip_opis'   => 'Servis koji održava zgrade i radi po prijavama kvarova',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 2. Stranice servisa + prava pristupa (uz vec postojece zajednicke rute)
        $stranice = [
            ['stranica_naziv' => 'Početna',         'route_name' => 'servis-pocetna', 'menu_order' => 1, 'show_in_menu' => 1],
            ['stranica_naziv' => 'Prijave kvarova', 'route_name' => 'servis-kvarovi', 'menu_order' => 2, 'show_in_menu' => 1],
        ];

        foreach ($stranice as $stranica) {
            if (!DB::table('stranicas')->where('route_name', $stranica['route_name'])->exists()) {
                DB::table('stranicas')->insert($stranica + ['created_at' => $now, 'updated_at' => $now]);
            }
        }

        $rute_servisa = ['servis-pocetna', 'servis-kvarovi', 'kvar-pregled', 'dashboard'];

        foreach ($rute_servisa as $route_name) {
            $stranica_id = DB::table('stranicas')->where('route_name', $route_name)->value('id');
            if (!$stranica_id) continue;

            $vec_postoji = DB::table('user_stranica_prikazs')
                ->where('user_tip_Id', self::USER_TIP_ID)
                ->where('stranica_Id', $stranica_id)
                ->exists();

            if (!$vec_postoji) {
                DB::table('user_stranica_prikazs')->insert([
                    'user_tip_Id' => self::USER_TIP_ID,
                    'stranica_Id' => $stranica_id,
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ]);
            }
        }

        // 3. Email obaveštenja za servis (vidljiva u profilu, ukljucena po defaultu)
        $kategorija_id = DB::table('email_obavestenja_kategorijas')
            ->where('for_user_tip', self::USER_TIP_ID)
            ->value('id');

        if (!$kategorija_id) {
            $kategorija_id = DB::table('email_obavestenja_kategorijas')->insertGetId([
                'kategorija_naziv' => 'Kvarovi',
                'kategorija_opis'  => 'Obaveštenja o prijavama kvarova u zgradama koje održavam',
                'for_user_tip'     => self::USER_TIP_ID,
                'created_at'       => $now,
                'updated_at'       => $now,
            ]);
        }

        $tipovi = [
            ['naziv' => 'Nova prijava kvara', 'opis' => 'Dobijam email kada stanar prijavi novi kvar'],
            ['naziv' => 'Novi komentar',      'opis' => 'Dobijam email za svaki novi komentar na prijavi kvara'],
        ];

        foreach ($tipovi as $tip) {
            $vec_postoji = DB::table('email_obavestenja_tips')
                ->where('email_obavestenja_kategorija_id', $kategorija_id)
                ->where('naziv', $tip['naziv'])
                ->exists();

            if (!$vec_postoji) {
                DB::table('email_obavestenja_tips')->insert($tip + [
                    'email_obavestenja_kategorija_id' => $kategorija_id,
                    'uvek_ukljucen'                   => 0,
                    'created_at'                      => $now,
                    'updated_at'                      => $now,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $kategorija_id = DB::table('email_obavestenja_kategorijas')
            ->where('for_user_tip', self::USER_TIP_ID)
            ->value('id');

        if ($kategorija_id) {
            $tip_ids = DB::table('email_obavestenja_tips')
                ->where('email_obavestenja_kategorija_id', $kategorija_id)
                ->pluck('id');

            DB::table('email_obavestenja_users')->whereIn('email_obavestenja_tip_id', $tip_ids)->delete();
            DB::table('email_obavestenja_tips')->whereIn('id', $tip_ids)->delete();
            DB::table('email_obavestenja_kategorijas')->where('id', $kategorija_id)->delete();
        }

        $stranica_ids = DB::table('stranicas')
            ->whereIn('route_name', ['servis-pocetna', 'servis-kvarovi'])
            ->pluck('id');

        DB::table('user_stranica_prikazs')->where('user_tip_Id', self::USER_TIP_ID)->delete();
        DB::table('stranicas')->whereIn('id', $stranica_ids)->delete();
        DB::table('user_tips')->where('id', self::USER_TIP_ID)->delete();

        Schema::dropIfExists('servis_zgrada_indices');
    }
};
