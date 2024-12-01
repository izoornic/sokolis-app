<?php

namespace App\Livewire\Upravnik\Komponente;

use Livewire\Component;

class SessionFlashMessage extends Component
{
    public function closeAlert()
    {
        if(session()->has('status')) session()->flash('status');
    }

    public function render()
    {
        return view('livewire.upravnik.komponente.session-flash-message');
    }
}
