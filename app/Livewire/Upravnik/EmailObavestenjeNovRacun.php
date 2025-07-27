<?php

namespace App\Livewire\Upravnik;

use Livewire\Component;

use App\Actions\Zgrada\IzabranaZgrada;
use App\Actions\Zgrada\EmailStanarimaSender;
use App\Models\Zgrada;
use App\Models\Racuni;

use Illuminate\Support\Facades\Http;
use App\Http\TimeFormatHelper;

class EmailObavestenjeNovRacun extends Component
{
    public $zgrade_error;
    public $zgrade;
    public $email_zgrade_send_logs;

    public $zgrade_upravnika;
    public $zgrade_upr_original;

    public $appkey;

    public $email_addres_error;

    public $pdf_link = 'https://upravnikzgrade.rs/racun/?rkv=';

    public function mount()
    {
        $this->zgrade = [IzabranaZgrada::getIzabranaZgradaId()];
        

        $this->appkey = hash('xxh3', 'lkdjkritg765jn4$$lkdfj###ldvmklfvm_-??jfopdtr***');
        $this->zgrade_upr_original = auth()->user()->zgrade()->get();
        $this->zgrade_upravnika = $this->getZadnjiRacun($this->zgrade_upr_original);
       
        
        
        $this->email_addres_error = '';
        
    }

    /**
     * Get the last invoice for each building managed by the user
     * 
     * @param \Illuminate\Support\Collection $zgrade_upravnika
     * @return \Illuminate\Support\Collection
     */
    private function getZadnjiRacunBaza($zgrade_upravnika){
        $email_zgrade_send_log = Zgrada::emailZgradeSendLogs($zgrade_upravnika->pluck('id')->toArray(), 6);

        $zgrade_upravnika = $zgrade_upravnika->map(function($item) use ($email_zgrade_send_log) {
            $item->db_coment = $email_zgrade_send_log->where('zgrada_id', '=', $item->id)->first()->comment ?? '';
            $item->last_send = $email_zgrade_send_log->where('zgrada_id', '=', $item->id)->first()->created_at ?? null;
            $item->last_send = ($item->last_send) ? date('d.m.Y H:i', strtotime($item->last_send)) : 'NIKADA';
            return $item;
        });

        return $zgrade_upravnika;
    }

    private function getZadnjiRacun($zgrade_upravnika)
    {
        $zgrade_ids = $zgrade_upravnika->pluck('zid')->toArray();    
        $zgrade_param = implode('-', $zgrade_ids);

       
        $response = Http::withHeaders([
                                'app' => 'Sokolis',
                                'key' => $this->appkey,
                            ])
                            ->post('https://upravnikzgrade.rs/api/sokolis/zid_last_month.php', [
                                'rkv' => $zgrade_param,
                        ]);
        $racuni = json_decode($response->body(), true);
        $racuniCollection = collect($racuni);
        
         if($racuni && is_array($racuni)){
            $zgrade_upravnika = $zgrade_upravnika->map(function($item) use ($racuniCollection) {
                $item->mid = $racuniCollection->where('zid', '=', $item->zid)->first()['mid'] ?? 0;
                $item->last_month = $racuniCollection->where('zid', '=', $item->zid)->first()['datum'] ?? null;
                $item->last_month_name = ($item->last_month)?TimeFormatHelper::nameOfTheMounth($item->last_month). ' ' . TimeFormatHelper::yearOfTheDate($item->last_month) : "NEMA RAČUNA";
                return $item;
            });
        } else {
            $zgrade_upravnika = [];
        }
        return $this->getZadnjiRacunBaza($zgrade_upravnika);
    }

    public function posaljiObavestenje()
    {
        
        if(!count($this->zgrade)){
            $this->zgrade_error = 'Barem jedna zgrada mora biti izabrana!';
            return;
        }

        $this->zgrade_upravnika = $this->getZadnjiRacun($this->zgrade_upr_original);
        //dd($this->zgrade_upravnika);
        
        foreach($this->zgrade as $zgrada){

            $zgrada_info = $this->zgrade_upravnika->where('id', '=', $zgrada)->first();
            $subject = "Račun za ". $zgrada_info->last_month_name . ' - ' . $zgrada_info->naziv ;
            $message_p = "Poštovani, <br> Na portal je dodat novi račun za održavanje zgrade " . $zgrada_info->naziv . ' za mesec ' . $zgrada_info->last_month_name.' . <br> PDF verziju možete preuzeti na sledećem linku: ';
            $stanari = Zgrada::emailAdreseStanara([$zgrada], 6);
            $log_comment = "Račun za mesec " . $zgrada_info->last_month_name;
            $nova_zgrada = true;
            
            foreach($stanari['stanari'] as $user_id){
                $rkv = Racuni::getApiKey($user_id, $zgrada_info->mid);
                $message_r = "<a href='" . $this->pdf_link . $rkv . "'> račun / uplatnica </a>";
                EmailStanarimaSender::sendToSingleUser($subject, $message_p.$message_r, $user_id, 6, "moji-racuni", $log_comment, $nova_zgrada);
                $nova_zgrada = false; // After the first user, we assume the building is not new anymore
            }
        }
        
        session()->flash('status', 'E-mail obaveštenje je uspešno poslato!');
        return $this->redirect('/email-obavestenja');
    }

    

    public function render()
    {
        return view('livewire.upravnik.email-obavestenje-nov-racun', [
            'zgrade_upravnika' => $this->zgrade_upravnika,
        ]);
    }
}
