<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

use Auth;

class TiketPrijava extends ModalComponent
{

    public $userId;

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function mount()
    {
        $this->userId = auth()->user()->id;
    }

    public function saveTiket()
    {
        session()->flash('status', 'Nova prijava kvara je uspešno sačuvana.');
 
        return $this->redirect('/prijavi-kvar');
    }

    public function render()
    {
        
        return view('livewire.modals.tiket-prijava');
    }
}
