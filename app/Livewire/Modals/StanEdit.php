<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Stan;
use App\Models\Garaza;

use Illuminate\Support\Facades\DB;

class StanEdit extends ModalComponent
{
    public $sid;
    public $zid;
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
        //dd($this->stan_row->zgrada()->get());
        $this->zid = $this->stan_row->zgradaId;
        $this->stan_namena = $this->stan_row->stan_namenaId;
        $this->sprat = $this->stan_row->sprat;
        $this->povrsina = $this->stan_row->povrsina;
        $this->garaza_sum  = $this->stan_row->garaza;
        if($this->garaza_sum){
            $this->garaze = $this->stan_row->garaze()->get();
        }
    }

    public function rules()
    {
        return [
            'sprat' => 'required|numeric',
            'povrsina' => 'required|numeric|min:1',
        ];  
    }
    
    public function delDbGaraza($gid)
    {
        Garaza::where('id', $gid)->delete();
        $garaz_sum = Garaza::where('stanId', $this->sid)->count();
        Stan::where('id', $this->sid)->update(['garaza' => $garaz_sum]);
        $this->mount();
    }

    public function save()
    {
        $this->validate();
        //validacija unete povrsine za garaze
        if(count($this->nove_garaze)){
            foreach($this->nove_garaze as $nova_garaza){
                if($nova_garaza['povrsina'] <= 0 || !is_numeric($nova_garaza['povrsina'])){
                    $this->povrsina_error = 'Sve garaže moraju da imaju unetu površinu!';
                    return;
                }
            }
            $this->povrsina_error = '';
        }
        //UPDATE
        DB::transaction(function () {
            foreach($this->nove_garaze as $nova_garaza){
                Garaza::create([
                    'stanId' => $this->sid,
                    'zgradaId' => $this->zid,
                    'stan_namenaId' => $nova_garaza['namena'],
                    'gpovrsina' => $nova_garaza['povrsina'],
                ]);
                $this->garaza_sum ++;
            }
            Stan::where('id', $this->sid)->update([
                'stan_namenaId' => $this->stan_namena,
                'sprat' => $this->sprat,
                'povrsina' => $this->povrsina,
                'garaza' => $this->garaza_sum
            ]);
            session()->flash('status', 'Podaci o stanu su uspešno promenjeni.');
            $this->closeModal();
            $this->redirect('/upravnik-zgrade');
        });
        
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
