<?php

namespace App\Livewire\Korisnik\Komponente;

use Livewire\Component;

class SzObavestenje extends Component
{
    public $o_id;
    public $tip;
    public $naslov;
    public $textdisp;
    public $ob_datum;

    
    public function render()
    {
        return view('livewire.korisnik.komponente.sz-obavestenje');
    }
}
