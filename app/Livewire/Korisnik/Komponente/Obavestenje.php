<?php

namespace App\Livewire\Korisnik\Komponente;

use Livewire\Component;
use App\Models\ObavestenjeKomentari;
use App\Models\Obavestenja;
use App\Models\ObavestenjaKomentarUserViewd;

class Obavestenje extends Component
{

    public $o_id;
    public $tip;
    public $naslov;
    public $textdisp;
    public $ob_datum;
    public $koments_br;
    public $koments_seen;

    public $komentari;
    public $show_koments;

    public $new_coment;

    public function mount()
    {
        //$this->show_koments = false;
        $this->komentari = [];
        $this->new_coment = '';

       // dd($this->komentari);
    }

    public function ShowComments($o_id)
    {
        if(!$this->show_koments){
            $this->komentari = [];
            //prikayuje komentare...
            $this->komentari = ObavestenjeKomentari::select('obavestenje_komentaris.komentar', 'obavestenje_komentaris.created_at', 'users.name')
                ->leftJoin('users', 'obavestenje_komentaris.userId', '=', 'users.id')
                ->where('obavestenje_komentaris.obavestenjeId', '=', $o_id)
                ->orderBy('obavestenje_komentaris.created_at')
                ->get();
            
            ObavestenjaKomentarUserViewd::updateOrCreate( ['obavestenjeId'=>$o_id, 'userId'=>auth()->user()->id], ['broj_vidjenih'=>$this->koments_br] );
        }

        $this->koments_seen = $this->koments_br;
        $this->show_koments = !$this->show_koments;
        //dd($this->komentari);
    }

    public function addComment()
    {
        if(trim($this->new_coment) == ''){
            $this->show_koments = false;
            $this->ShowComments($this->o_id);
            return;
        } 
        
        ObavestenjeKomentari::create([
                'obavestenjeId'=>$this->o_id,
                'userId'=>auth()->user()->id,
                'komentar'=>$this->new_coment
            ]);
        Obavestenja::where('id',$this->o_id)
            ->increment('ob_broj_komentara', 1);

        $new_bro = Obavestenja::select('ob_broj_komentara')->where('id',$this->o_id)->first();
        //$new_bro->ob_broj_komentara);

        ObavestenjaKomentarUserViewd::updateOrCreate( ['obavestenjeId'=>$this->o_id, 'userId'=>auth()->user()->id], ['broj_vidjenih'=>$new_bro->ob_broj_komentara] );
        $this->koments_br ++;
        $this->new_coment = '';
        $this->show_koments = false;
        $this->ShowComments($this->o_id);
    }

    public function render()
    {
        return view('livewire.korisnik.komponente.obavestenje');
    }
}
