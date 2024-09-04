<?php

namespace App\Livewire\Korisnik\Komponente;

use Livewire\Component;

class Obavestenje extends Component
{
    public $tip;
    public $naslov;
    public $textdisp;

    public $komentari;
    public $show_koments;

    public function mount()
    {
        $this->show_koments = false;
        $frst = ['name' => 'Petar Petrovic', 'created_at'=>'21. 06. 2024. - 8:07:56', 'komentar'=>'Odlicno. Hvala za info'];
        $sec = ['name' => 'Petar Petrovic', 'created_at'=>'21. 06. 2024. - 8:07:56', 'komentar'=>'Odlicno. Hvala za info'];
        $this->komentari = [ $frst, $sec ];

       // dd($this->komentari);
    }

    public function render()
    {
        return view('livewire.korisnik.komponente.obavestenje');
    }
}
