<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stan extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the phone.
     */
    public function zgrada(): BelongsTo
    {
        return $this->belongsTo(Zgrada::class, 'zgradaId');
    }


    /**
     * Puni listu na modalu PRIJAVI KVAR.
     */
    public static function stanoviKorisnika($sids)
    {
        $stanovi = Stan::select('stans.id as sid', 'stans.stanbr', 'zgradas.id as zid', 'zgradas.naziv', 'stans.stan_namenaId')
            ->leftJoin('zgradas', 'zgradas.id', '=', 'stans.zgradaId')
            ->whereIn('stans.id', $sids)
            ->get();
       
        $GLOBALS['retval'] = [];
        $stanovi->each(function ($item, $key){
            $label = ($item->stan_namenaId == 1) ? 'Stan ' : 'Lokal ';
            $GLOBALS['retval'][$item->sid] =  $label.$item->stanbr." - ".$item->naziv;
        });
        return $GLOBALS['retval'];
    }
}
