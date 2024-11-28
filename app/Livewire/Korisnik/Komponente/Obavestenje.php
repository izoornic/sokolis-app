<?php

namespace App\Livewire\Korisnik\Komponente;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ObavestenjeKomentari;
use App\Models\Obavestenja;
use App\Models\ObavestenjaKomentarUserViewd;
use App\Models\ObavestenjaLink;
use App\Models\ObavestenjeZgradaIndex;

use App\Livewire\Upravnik\ObavestenjaPregled;
use Illuminate\Support\Facades\Storage;

class Obavestenje extends Component
{

    public $o_id;
    public $del_ob_id;

    public $tip;
    public $naslov;
    public $textdisp;
    public $ob_datum;
    public $koments_br;
    public $koments_seen;

    public $ob_links;

    public $komentari;
    public $show_koments;

    public $new_coment;

    public $upravnik;

    public function mount()
    {
        //dd($this->getMyLinks());
        $this->ob_links = $this->getMyLinks();
        //$this->show_koments = false;
        $this->komentari = [];
        $this->new_coment = '';

        $this->upravnik = (auth()->user()->user_tipId == 2) ? true : false;
       // dd($this->komentari);
    }

    private function getMyLinks()
    {
        $oblinks = ObavestenjaLink::select('id', 'ob_link_tekst', 'ob_link_adress')
                                ->where('obavestenjeId', '=', $this->o_id)
                                ->get();
        
        $oblinks->each(function ($item, $key) {
            $item->url = Storage::url($item->ob_link_adress);
        });
        return $oblinks;
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

    
    #[On('obrisi-obavestenje')] 
    public function obrisiObavestenje()
    {
        if(session('obavestenje_del_id')) {
            $del_id = session('obavestenje_del_id');
            //dd(session('obavestenje_del_id'));
            ObavestenjeZgradaIndex::where('obavestenjeId', $del_id)->update(['active' => 0]);
            if($this->ob_links){
                foreach($this->ob_links as $olink){
                    Storage::delete($olink->ob_link_adress);
                    ObavestenjaLink::where('id', $olink->id)->delete();
                }
            }
            session()->flash('status', 'Obaveštenje je uspešno obrisano.');
        }else{
            session()->flash('status', 'GREŠKA 216');
        }

        $this->redirect('/upravnik-obavestenja');
        
    }

    public function deleteObavestenje($oid)
    {
        session(['obavestenje_del_id' => $oid]);
        $ob_data = Obavestenja::where('id', '=', $oid)->first();
        $modal_labels = [
            'naslov' => 'Brisanje obaveštenja',
            'body_text' => 'Da li ste sigurni da želite da obrišete obaveštenje: ',
            'body_text2ndrow' => $ob_data->ob_naslov.' ?',
            'button_label' => 'Obriši obaveštenje',
            'akcija' => 'obrisi-obavestenje',
        ];
        $this->dispatch('openModal', 'modals.potvrdi-akciju-modal', $modal_labels);
    }

    public function editObavestenje($oid=0)
    {
        $this->redirect('/upravnik-obavestenje-novo?oid='.$oid);
    }

    public function render()
    {
        return view('livewire.korisnik.komponente.obavestenje');
    }
}
