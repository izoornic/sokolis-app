<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\On;

use Illuminate\Support\Facades\DB;
use App\Actions\Zgrada\IzabranaZgrada;

use App\Models\Stan;
use App\Models\UserStanIndex;

class StanNoviStanaru extends ModalComponent
{
    public $user_id;
    public $stan_id;

    public $uss_name;
    public $zgrada_name;

    public function mount()
    {
        //dd($this->read());
    }

    #[On('link-stan')] 
    public function linkujStan()
    {
        //dd($this->user_id, $this->stan_id);
        UserStanIndex::create(['userId' => $this->user_id, 'stanId' => $this->stan_id]);
        $this->user_id = 0;
        $this->stan_id = 0;
        
        $this->dispatch('stan-dodat');
        $this->forceClose()->closeModal();
    }

    public function linkStan($sid)
    {

        $this->stan_id = $sid;
        //$this->user_id = $uid;
        
        $stan_info = Stan::where('id', '=', $this->stan_id)->first();

        $modal_labels = [
            'button_label' => 'Dodaj stan',
            'body_text' => 'Da li ste sigurni korisniku: '.$this->uss_name.' želite da dodate stan:',
            'body_text2ndrow' => $this->zgrada_name.' - stan br: '.$stan_info->stanbr.' ?',
            'naslov' => 'Dodaj stan',
            'akcija' => 'link-stan',
        ];
        $this->dispatch('openModal', 'modals.potvrdi-akciju-modal', $modal_labels);
    }

    public function read()
    {
        $this->zgrada_name = IzabranaZgrada::getIzabranaZgradaName();
        return Stan::select('stans.*')
                        ->where('stans.zgradaId', '=', IzabranaZgrada::getIzabranaZgradaId())
                        ->whereNotIn('id', 
                            DB::table('user_stan_indices')->select('stanId')->pluck('stanId') 
                        )
                        ->orderBy('stans.sprat', 'ASC')
                        ->orderBy('stans.spb', 'ASC')
                        ->get();
    }

    public function render()
    {
        return view('livewire.modals.stan-novi-stanaru', [
            'data' => $this->read()
        ]);
    }
}
