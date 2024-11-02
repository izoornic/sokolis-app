<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\On;

use App\Models\UserStanIndex;

class StanoviStanara extends ModalComponent
{
    public $user_id;
    public $uss_name;

    public $delsid;
    public $deluid;

    public function mount()
    {
        //dd($this->read());
    }

    #[On('unlink-stan')] 
    public function odlinkujStan()
    {

        UserStanIndex::where([  'userId' => $this->deluid,
                                'stanId' => $this->delsid])
                        ->delete();
        $this->delsid = 0;
        $this->deluid = 0;
        
        $this->dispatch('stan-uklonjen');
        $this->forceClose()->closeModal();
    }

    public function unlinkStan($sid, $uid)
    {
        $this->delsid = $sid;
        $this->deluid = $uid;
        
        $modal_labels = [
            'button_label' => 'Ukloni stan',
            'body_text' => 'Da li ste sigurni da želite da uklonite stan izabranom korisniku?',
            'naslov' => 'Ukloni stan',
            'akcija' => 'unlink-stan',
        ];
        $this->dispatch('openModal', 'modals.potvrdi-akciju-modal', $modal_labels);
    }

    public function read()
    {
        return UserStanIndex::select('stans.*', 'zgradas.*', 'stans.id as sid', 'user_stan_indices.userId')
                    ->leftJoin('stans', 'stans.id', '=', 'user_stan_indices.stanId')
                    ->leftJoin('zgradas', 'zgradas.id', '=', 'stans.zgradaId')
                    ->where('user_stan_indices.userId', '=', $this->user_id)
                    ->get();
    }

    public function render()
    {
        return view('livewire.modals.stanovi-stanara', [
            'data' => $this->read()
        ]);
    }
}
