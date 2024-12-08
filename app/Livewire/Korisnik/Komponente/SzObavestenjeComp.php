<?php

namespace App\Livewire\Korisnik\Komponente;

use Livewire\Component;

use Livewire\Attributes\On;
use App\Models\SzObavestenje;
use App\Models\SzObavestenjeZgradaIndex;
use App\Models\SzObavestenjaFiles;

use Illuminate\Support\Facades\Storage;

class SzObavestenjeComp extends Component
{
    public $o_id;
    public $tip;
    public $naslov;
    public $textdisp;
    public $ob_datum;

    public $upravnik; // = true;

    public $ob_links;
    
    public function mount()
    {
        $this->ob_links = $this->getMyLinks();
    }

    private function getMyLinks()
    {
        $oblinks = SzObavestenjaFiles::select('id', 'sz_link_text', 'sz_file_name')
                                ->where('sz_obavestenjeId', '=', $this->o_id)
                                ->get();
        
        $oblinks->each(function ($item, $key) {
            $item->url = Storage::url($item->sz_file_name);
        });
        return $oblinks;
    }

    #[On('obrisi-obavestenje')] 
    public function obrisiObavestenje()
    {
        if(session('sz_obavestenje_del_id')) {
            $del_id = session('sz_obavestenje_del_id');
            //dd(session('obavestenje_del_id'));
            SzObavestenjeZgradaIndex::where('sz_obavestenjeId', $del_id)->update(['active' => 0]);
            /* if($this->ob_links){
                foreach($this->ob_links as $olink){
                    Storage::delete($olink->ob_link_adress);
                    ObavestenjaLink::where('id', $olink->id)->delete();
                }
            } */
            session()->flash('status', 'Obaveštenje je uspešno obrisano.');
        }else{
            session()->flash('status', 'GREŠKA 216');
        }

        $this->redirect('/sz-upravnik-obavestenja');
        
    }

    public function deleteSzObavestenje($oid)
    {
        session(['sz_obavestenje_del_id' => $oid]);
        $ob_data = SzObavestenje::where('id', '=', $oid)->first();
        $modal_labels = [
            'naslov' => 'Brisanje obaveštenja',
            'body_text' => 'Da li ste sigurni da želite da obrišete obaveštenje: ',
            'body_text2ndrow' => $ob_data->sz_ob_naslov.' ?',
            'button_label' => 'Obriši obaveštenje',
            'akcija' => 'obrisi-obavestenje',
        ];
        $this->dispatch('openModal', 'modals.potvrdi-akciju-modal', $modal_labels);
    }

    public function editSzObavestenje($oid=0)
    {
        $this->redirect('/sz-upravnik-obavestenje-novo?oid='.$oid);
    }


    public function render()
    {
        return view('livewire.korisnik.komponente.sz-obavestenje-comp');
    }
}
