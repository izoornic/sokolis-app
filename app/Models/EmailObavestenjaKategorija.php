<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailObavestenjaKategorija extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategorija_naziv',
        'kategorija_opis'
    ];

    public function tipovi()
    {
        return $this->hasMany(EmailObavestenjaTip::class, 'email_obavestenja_kategorija_id');
    }
}
