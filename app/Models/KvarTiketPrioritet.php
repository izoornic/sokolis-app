<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KvarTiketPrioritet extends Model
{
    use HasFactory;

    public static function prList()
    {
        return  KvarTiketPrioritet::all();
    }

}
