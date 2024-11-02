<?php

namespace App\Livewire\Upravnik;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Zgrada;

class Pocetna extends Component
{
    
    public function mount()
    {
        //dd(Zgrada::zgradeUpravnika());
    }

    #[On('promenjenaZgrada')]
    public function refreshMe()
    {
        //dd("YO man");
        $this->render();
    }
    public function render()
    {
        return view('livewire.upravnik.pocetna');
    }
}
