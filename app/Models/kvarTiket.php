<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\KvarTiketImage;

class kvarTiket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'userId',
        'tiket_statusId',
        'tiket_prioritetId',
        'opis_kvaraId',
        'opis',
        'zgradaId',
        'stanId',
        'vidljiv_zgradi',
        'tiket_br_komentara'
    ];

    /**
     * Get the user 
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    /**
     * Get the coments.
     */
    public function komentari(): HasMany
    {
        return $this->HasMany(KvarKomentari::class, 'kvar_tiketId');
    }

    /**
     * Get the images.
     */
    public function images(): HasMany
    {
        return $this->HasMany(KvarTiketImage::class, 'kvar_tiketId');
    }

    public static function updateBrojSlika($tid)
    {
        $imgs_no = KvarTiketImage::where('kvar_tiketId', '=', $tid)->count();
        kvarTiket::where('id', '=', $tid)->update(['broj_slika' => $imgs_no]);
    }
}
