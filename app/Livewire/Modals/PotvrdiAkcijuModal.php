<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

class PotvrdiAkcijuModal extends ModalComponent
{
    public $akcija;
    public $komponenta;
    public $button_label;
    public $body_text;
    public $naslov; 

    public static function modalMaxWidth(): string
    {
        return 'lg'; 
    }

    public function mount()
    {
        
    }

    public function confirmAction()
    {
        $this->dispatch($this->akcija);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.potvrdi-akciju-modal');
    }
}
