<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObavestenjeZgradaIndex extends Model
{
    use HasFactory;

    public static function getZgradeObavestenja($oid)
    {
        return ObavestenjeZgradaIndex::select('zgradas.naziv')
                        ->leftJoin('zgradas', 'obavestenje_zgrada_indices.zgradaId', '=', 'zgradas.id')
                        ->where('obavestenje_zgrada_indices.obavestenjeId', '=', $oid)
                        ->pluck('zgradas.naziv');
    }
}
