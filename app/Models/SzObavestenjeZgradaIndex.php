<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SzObavestenjeZgradaIndex extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sz_obavestenjeId',
        'zgradaId',
        'email_sent',
        'active'
    ];

    public static function getZgradeObavestenja($oid)
    {
        return SzObavestenjeZgradaIndex::select('zgradas.naziv_sz')
                        ->leftJoin('zgradas', 'sz_obavestenje_zgrada_indices.zgradaId', '=', 'zgradas.id')
                        ->where('sz_obavestenje_zgrada_indices.sz_obavestenjeId', '=', $oid)
                        ->pluck('zgradas.naziv_sz');
    }
}
