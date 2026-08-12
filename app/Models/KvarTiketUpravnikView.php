<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KvarTiketUpravnikView extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'kvar_tiketId',
        'userId',
        'prvi_pregled',
        'poslednji_pregled',
        'broj_pregleda',
    ];

    protected $casts = [
        'prvi_pregled' => 'datetime',
        'poslednji_pregled' => 'datetime',
    ];

    /**
     * Zabelezi da je upravnik otvorio tiket.
     * Prvi pregled se upisuje samo jednom, poslednji pregled i brojac se azuriraju svaki put.
     */
    public static function zabeleziPregled($tiketId, $userId)
    {
        $pregled = KvarTiketUpravnikView::firstOrNew(['kvar_tiketId' => $tiketId, 'userId' => $userId]);

        if (!$pregled->prvi_pregled) $pregled->prvi_pregled = now();

        $pregled->poslednji_pregled = now();
        $pregled->broj_pregleda = ($pregled->broj_pregleda ?? 0) + 1;
        $pregled->save();
    }
}
