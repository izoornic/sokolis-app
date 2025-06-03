<?php

namespace App\Livewire\Upravnik;

use Livewire\Component;

use App\Actions\Zgrada\IzabranaZgrada;
use App\Actions\Zgrada\EmailStanarimaSender;
use App\Models\Zgrada;

use Illuminate\Support\Facades\Http;
use App\Http\TimeFormatHelper;

class EmailObavestenjeNovRacun extends Component
{
    public $zgrade_error;
    public $zgrade;

    public $zgrade_upravnika;

    public $appkey;

    public function mount()
    {
        $this->zgrade = [IzabranaZgrada::getIzabranaZgradaId()];
        $this->zgrade_upravnika = auth()->user()->zgrade()->get();
        $zgrade_ids = $this->zgrade_upravnika->pluck('zid')->toArray();
        $zgrade_param = implode('-', $zgrade_ids);
        
        $this->appkey = hash('xxh3', 'lkdjkritg765jn4$$lkdfj###ldvmklfvm_-??jfopdtr***');

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
            $this->zgrade_upravnika = $this->zgrade_upravnika->map(function($item) use ($racuniCollection) {
                $item->last_month = $racuniCollection->where('zid', '=', $item->zid)->first()['datum'] ?? null;
                $item->last_month_name = ($item->last_month)?TimeFormatHelper::nameOfTheMounth($item->last_month). ' ' . TimeFormatHelper::yearOfTheDate($item->last_month) : "NEMA RAČUNA";
                return $item;
            });
        } else {
            $this->zgrade_upravnika = [];
        }
        
    }

    public function posaljiObavestenje()
    {
        
        if(!count($this->zgrade)){
            $this->zgrade_error = 'Barem jedna zgrada mora biti izabrana!';
            return;
        }

        $email_adrese = Zgrada::emailAdreseStanara($this->zgrade);
        

        if(!count($email_adrese['bcc_adrese'])){
            $this->zgrade_error = 'Za izabrane zgrade ne postoji stanar koji će dobiti e-mail poruku!';
            return;
        }

        //send and log email
        //EmailStanarimaSender::send($this->subject, $this->message, $this->files, $this->zgrade, 8);
        
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
