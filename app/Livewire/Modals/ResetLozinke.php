<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ResetLozinke extends ModalComponent
{
    public $pass;
    public $pass_confirmation;

    public $name;
    public $user_id;

    public function mount()
    {

    }
    public function rules()
    {
        $retval['pass'] = ['required','confirmed', Password::min(8)->letters()->numbers()->symbols()];
        return $retval;
    }

    public function saveNewPass()
    {
        $this->validate();

        User::where('id', '=', $this->user_id)->update(['password' => Hash::make($this->pass)]);
        session()->flash('status', 'Lozinka uspešno promenjena.');
        $this->forceClose()->closeModal();
        return $this->redirect('/upravnik-stanari');
    }

    public function close()
    {
        $this->forceClose()->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.reset-lozinke');
    }
}
