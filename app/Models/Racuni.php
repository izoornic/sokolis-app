<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Racuni extends Model
{
    use HasFactory;

    public static function getApiKey($stanid, $mid=62)
    {
        $racun_row = Racuni::where('stanId', '=', $stanid)->first();
        if(!$racun_row) return false;        
        $for_hash = $racun_row->sid."-".$racun_row->zid."-".$mid."2022";
		return hash('sha512', $for_hash);
    }
}
