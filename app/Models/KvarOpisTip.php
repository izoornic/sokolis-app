<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KvarOpisTip extends Model
{
    use HasFactory;

    public static function tipoviKvara()
    {
        foreach(KvarOpisTip::orderBy('rbr')->get() as $tipKvara){
            $kvarovi_list[$tipKvara->id] = $tipKvara->kvar_tip_naziv;
        }
        return  $kvarovi_list;
    }

}
