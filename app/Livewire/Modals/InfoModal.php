<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

class InfoModal extends ModalComponent
{

    /* public static function closeModalOnEscapeIsForceful(): bool
    {
        return false;
    }
    
    public static function closeModalOnClickAway(): bool
    {
        return false;
    } */
    /**
     * Supported:  'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     * (default value '2xl') 
     */
    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
    
    public function update()
    {
        $this->forceClose()->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.info-modal');
    }
}
