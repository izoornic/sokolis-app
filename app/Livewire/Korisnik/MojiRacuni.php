<?php

namespace App\Livewire\Korisnik;

use App\Models\User;
use App\Models\Racuni;
use App\Http\TimeFormatHelper;
use Illuminate\Support\Facades\Http;


use Livewire\Component;

class MojiRacuni extends Component
{
    public $izabrani_stan;
    public $appkey;

    public $stanovi_lista;

    public $pdf_link = 'https://upravnikzgrade.rs/racun/?rkv=';
    //https://upravnikzgrade.rs/stan-stanje/?rkv=
    public function mount()
    {
        if(!session()->exists(['stanovi', 'zgrade'])){
            User::getMyZgradeStanove();
        }
        $this->user_zids = session()->only(['stanovi', 'zgrade']);
        $this->stanovi_lista = $this->user_zids['stanovi'];
        $this->izabrani_stan = $this->user_zids['stanovi'][0];
        $this->appkey = hash('xxh3', 'lkdjkritg765jn4$$lkdfj###ldvmklfvm_-??jfopdtr***');
    }

    public function read()
    {
        $retval = [];
        $stan_key = Racuni::getApiKey($this->izabrani_stan);
        if($stan_key){
            $response = Http::withHeaders([
                                'app' => 'Sokolis',
                                'key' => $this->appkey,
                            ])
                            ->post('https://upravnikzgrade.rs/api/sokolis/', [
                                'rkv' => $stan_key
                        ]);
            
            $racuni = json_decode($response->body(), true);
            //dd($racuni, $stan_key);
            
            foreach($racuni as $item){
            if((int)$item['stari_dug'] < 1) {
                    $item['rkv'] = Racuni::getApiKey($this->izabrani_stan, (int)$item['mid']);
                    $item['datum'] = TimeFormatHelper::datumFormatDanFullYear($item['datum']);
                    $item['r_date'] = TimeFormatHelper::datumFormatDanFullYear($item['r_date']);
            }else{
                    $item['rkv'] = '';
            } 
            $item['zaduzeno'] = number_format($item['zaduzeno'], 2, ',', ' ');
            $item['razduzeno'] = number_format($item['razduzeno'], 2, ',', ' ');
            // saldo_sign 0 = 0, 1 = manje od nula, minus, 2 vise od nuka, plus
            $item['saldo_sign']  = ($item['saldo'] != 0) ? ($item['saldo'] < 0) ? 1 : 2 : 0;
            $item['saldo'] = number_format(abs($item['saldo']), 2, ',', ' ');
            
                array_push($retval, $item);
            }
        }
        //dd($retval);
        return $retval;
    }

    public function render()
    {
        return view('livewire.korisnik.moji-racuni',[
            'data' => $this->read(),
        ]);
    }
}
