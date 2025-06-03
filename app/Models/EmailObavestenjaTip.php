<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class EmailObavestenjaTip extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_obavestenja_kategorija_id',
        'naziv',
        'opis'
    ];

    /**
     * Get the kategorije za odabrani tip.
     */
    public function kategorije(): BelongsTo
    {
        return $this->belongsTo(EmailObavestenjaKategorija::class, 'email_obavestenja_kategorija_id');
    }
}
