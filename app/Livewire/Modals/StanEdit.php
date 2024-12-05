<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Stan;
use App\Models\Garaza;

class StanEdit extends ModalComponent
{
    public $sid;
    public $sbr;
    public $stan_namena;
    public $sprat;
    public $povrsina;
    public $garaza_sum;
    public $povrsina_error;

    public $garaze;
    public $stan_row;

    public $nove_garaze;

    public function mount()
    {
        $this->garaze = [];
        $this->nove_garaze = [];
        $this->stan_row = Stan::where('id', $this->sid)->first();
        $this->stan_namena = $this->stan_row->stan_namenaId;
        $this->sprat = $this->stan_row->sprat;
        $this->povrsina = $this->stan_row->povrsina;
        $this->garaza_sum  = $this->stan_row->garaza;
        if($this->garaza_sum){
            $this->garaze = $this->stan_row->garaze();
        }
    }

    //TODO save function
    public function save()
    {
        //validacija unete povr[ine za garaze
        if(count($this->nove_garaze)){
            foreach($this->nove_garaze as $nova_garaza){
                if($nova_garaza['povrsina'] <= 0 || !is_numeric($nova_garaza['povrsina'])){
                    $this->povrsina_error = 'Sve garaže moraju da imaju unetu površinu!';
                    return;
                }
            }
            $this->povrsina_error = '';
        }
        
    }

    public function addGarazu()
    {
        array_push( $this->nove_garaze, [
            'povrsina' => 0,
            'namena' => 3
        ]);
        
    }

    public function delNewGaraza($ind)
    {
        array_splice($this->nove_garaze, $ind, 1);
    }

    public function render()
    {
        return view('livewire.modals.stan-edit');
    }
}
