<?php

namespace App\Livewire\Upravnik\Komponente;

use Livewire\Component;
use App\Models\User;
use App\Models\Zgrada;


class IzborZgrade extends Component
{
    public $izabrana_zgradaId;
    public $zgrada_name;
    public function mount()
    {
        if(!session()->exists('upravnik_izabrana_zgrada_id') && !session()->exists('upravnik_izabrana_zgrada_name')){
            $zgrd = User::find(auth()->user()->id)->zgrade->first();
            session(['upravnik_izabrana_zgrada_id' => $zgrd->id]);
            session(['upravnik_izabrana_zgrada_name' => $zgrd->naziv]);
        }
        $this->izabrana_zgradaId = session('upravnik_izabrana_zgrada_id');
        $this->zgrada_name = session('upravnik_izabrana_zgrada_name');
    }
    public function updated()
    {
        if($this->izabrana_zgradaId != session()->only(['upravnik_izabrana_zgrada_id'])){
            $zgrd = Zgrada::where('id', '=', $this->izabrana_zgradaId)->first();
            //dd($zgrd);
            session(['upravnik_izabrana_zgrada_id' => $zgrd->id]);
            session(['upravnik_izabrana_zgrada_name' => $zgrd->naziv]);
            $this->dispatch('promenjenaZgrada');
        }
        $this->izabrana_zgradaId = session('upravnik_izabrana_zgrada_id');
        $this->zgrada_name = session('upravnik_izabrana_zgrada_name');
    }

    public function render()
    {
        return view('livewire.upravnik.komponente.izbor-zgrade');
    }
}
