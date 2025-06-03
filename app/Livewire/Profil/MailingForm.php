<?php

namespace App\Livewire\Profil;

use Livewire\Component;
use App\Models\EmailObavestenjaTip;
use App\Models\EmailObavestenjaKategorija;
use App\Models\EmailObavestenjaUser;
use App\Models\User;

class MailingForm extends Component
{
    public $korisnik_obavestenja = [];
    public $confirmingMailObavestenja;
    
    public function mount()
    {
        $this->korisnik_obavestenja = EmailObavestenjaUser::where('user_id',auth()->user()->id)->pluck('email_obavestenja_tip_id')->toArray();
        $this->confirmingMailObavestenja = false;
    }

    public function read()
    {
        
       $kat_all = EmailObavestenjaKategorija::all()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'naziv' => $item->kategorija_naziv,
                    'opis' => $item->kategorija_opis,
                    'tipovi' => $item->tipovi->map(function ($tip) {
                        return [
                            'id' => $tip->id,
                            'naziv' => $tip->naziv,
                            'opis' => $tip->opis,
                            'uvek_ukljucen' => $tip->uvek_ukljucen,
                        ];
                    })
                ];
            });
        
        $retval = [];
        $i = 0;
        $n = 0;
        foreach ($kat_all as $kategorija) {
            $retval[$i] = ['id' => $kategorija['id'], 'naziv' => $kategorija['naziv'], 'opis' => $kategorija['opis'], 'tipovi' => []];
            $n = 0;
            foreach ($kategorija['tipovi'] as $tip) {
                $retval[$i]['tipovi'][$n] = ['id' => $tip['id'], 'naziv' => $tip['naziv'], 'uvek_ukljucen' => $tip['uvek_ukljucen'], 'opis' => $tip['opis'], 'checked' => in_array($tip['id'], $this->korisnik_obavestenja)];
                $n++;
            }
            $i++;
        }
       
        return $retval;
    }
 
    public function save()
    {
        $korisnik = User::find(auth()->user()->id);
        $korisnik->emailObavestenja()->sync($this->korisnik_obavestenja);
        $this->confirmingMailObavestenja = true;
    }

    public function render()
    {
       //dd($this->read());
        return view('livewire.profil.mailing-form', [
            'data' => $this->read(),
        ]);
    }
}
