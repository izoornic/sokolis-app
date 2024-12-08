<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'stan_namenaId',
        'sprat',
        'povrsina',
        'garaza'
    ];

    /**
     * Get the zgradu za odabrani stan.
     */
    public function zgrada(): BelongsTo
    {
        return $this->belongsTo(Zgrada::class, 'zgradaId');
    }

    /**
     * Get garaze ya odabrani stan.
     */
    public function garaze(): HasMany
    {
        return $this->hasMany(Garaza::class, 'stanId');
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
