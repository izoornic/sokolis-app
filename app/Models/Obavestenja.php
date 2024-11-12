<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obavestenja extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'userId',
        'ob_tipId',
        'ob_broj_komentara',
        'ob_naslov',
        'ob_text',
    ];
}
