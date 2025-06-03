<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Racuni extends Model
{
    use HasFactory;

    public static function getApiKey($stanid, $mid=0)
    {
        $racun_row = Racuni::where('stanId', '=', $stanid)->first();
        if(!$racun_row) return false;  
        if($mid < 1){
            $mid_obj = self::getPoslednjiMesecZgrade($racun_row->zid);
            if(!$mid_obj) return false;
            $for_hash = $racun_row->sid."-".$racun_row->zid."-".$mid_obj[0]['mid']."2022";
            return hash('sha512', $for_hash);
        }
        $for_hash = $racun_row->sid."-".$racun_row->zid."-".$mid."2022";
		return hash('sha512', $for_hash);
    }

    public static function getPoslednjiMesecZgrade($zid)
    {
        $appkey = hash('xxh3', 'lkdjkritg765jn4$$lkdfj###ldvmklfvm_-??jfopdtr***');
        $response = Http::withHeaders([
                                'app' => 'Sokolis',
                                'key' => $appkey,
                            ])
                            ->post('https://upravnikzgrade.rs/api/sokolis/zid_last_month.php', [
                                'rkv' => $zid,
                        ]);
        return json_decode($response->body(), true);
    }
}
