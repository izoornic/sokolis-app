<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpisKvaraTip extends Model
{
    use HasFactory;

    public static function tipoviKvara()
    {
        foreach(OpisKvaraTip::all() as $tipKvara){
            $kvarovi_list[$tipKvara->id] = $tipKvara->kvar_tip_naziv;
        }
        return  $kvarovi_list;
    }

}
