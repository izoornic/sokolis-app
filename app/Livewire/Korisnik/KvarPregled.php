<?php

namespace App\Livewire\Korisnik;
use Livewire\Attributes\On;

use Livewire\Component;
use App\Models\User;
use App\Models\Stan;
use App\Models\kvarTiket;
use App\Models\KvarKomentari;
use App\Models\KvarKomentarUserView;
use App\Models\KvarTiketImage;


use Illuminate\Support\Facades\Storage;

class KvarPregled extends Component
{

    public $tkid;
    public $can_view;
    public $user_zids;

    public $tiket_status;

    public $tiket_init;
    public $tiket_creator;
    //public $komentari;
    public $new_coment;

    public $tiket_stan;
    public $tiket_zgrada;

    public $vlasnik_tiketa;
    public $upravnik;

    public $tiket_vidljivost;

    public $sorce; //za prikaz slika na lokalu i online

    public function mount()
    {
        $this->sorce=env('IMAGE_MANIPILATION');
        $this->upravnik = (auth()->user()->user_tipId == 1) ? false : true;
        if(!$this->upravnik){
            if(!session()->exists(['stanovi', 'zgrade'])){
                User::getMyZgradeStanove();
            }
            $this->user_zids = session()->only(['stanovi', 'zgrade']);
        }

        $this->can_view = false;
        $this->vlasnik_tiketa = false;
        $this->tkid = request()->query('tid');

        $this->setInitVals();
    }

    private function setInitVals()
    {
        $this->tiket_init = kvarTiket::where('kvar_tikets.id', '=' ,$this->tkid)->first();

        $this->tiket_creator = kvarTiket::find($this->tkid)->user()->first()->name;

        $this->tiket_status = $this->tiket_init->tiket_statusId;
        $this->tiket_vidljivost =  $this->tiket_init->vidljiv_zgradi;

        if($this->tiket_init){
            if($this->upravnik){
                $this->can_view = true;
                $this->vlasnik_tiketa = true;
            }else{
                // ako je vlasnik tiketa ili je tiket u njegovoj zgradi i vidljiv je svima
                if($this->tiket_init->userId == auth()->user()->id || ( in_array($this->tiket_init->zgradaId, $this->user_zids['zgrade']->toArray()) && $this->tiket_init->vidljiv_zgradi == 1)){
                    $this->can_view = true;
                    $this->vlasnik_tiketa = ($this->tiket_init->userId == auth()->user()->id);
                }
            }
            //set broj vidjenih komentara
            KvarKomentarUserView::updateOrCreate( ['kvar_tiketId'=>$this->tkid, 'userId'=>auth()->user()->id], ['broj_vidjenih'=>$this->tiket_init->tiket_br_komentara] );
        }
    }

    #[On('slikeDodate')]
    public function refreshMeSlike()
    {
        $this->render();
    }

    #[On('slika_obrisana')]
    public function refreshMe()
    {
        $this->render();
    }

    #[On('zakljucaj')] 
    public function zakljucajTiket()
    {
        kvarTiket::where('id',$this->tkid)->update(['tiket_statusId'=> 2]);
        session()->flash('status', 'Status tiketa #'.$this->tkid.' promenjen u ZAKLJUČAN');
        return $this->redirect('/prijavi-kvar');
    }

    #[On('otkljucaj')] 
    public function otkljucajTiket()
    {
        kvarTiket::where('id',$this->tkid)->update(['tiket_statusId'=> 1]);
        $this->setInitVals();
    }

    #[On('brisanje')] 
    public function obrisiTiket()
    {
        kvarTiket::where('id',$this->tkid)->update(['tiket_statusId'=> 3]);
        session()->flash('status', 'Tiket #'.$this->tkid.' je obrisan.');
        return $this->redirect('/prijavi-kvar');
    }

    #[On('promena-vidljivosti')]
    public function promeniVidljivostTiketa()
    {
        kvarTiket::where('id',$this->tkid)->update(['vidljiv_zgradi'=> ($this->tiket_vidljivost) ? 0 : 1]);
        $this->setInitVals();
    }

    public function dodajSlike()
    {
        $this->dispatch('openModal', 'modals.images-add-modal', ['tkid' => $this->tkid]);
    }

    public function showComfirmModal($action)
    {
        if($action == 'zatvori'){
            $modal_labels = [
                'button_label' => 'Zatvori tiket',
                'body_text' => 'Da li ste sigurni da želite da zatvorite tiket?',
                'naslov' => 'Zatvori tiket',
                'akcija' => 'zakljucaj',
            ];
        }elseif($action == 'otvori'){
            $modal_labels = [
                'button_label' => 'Otvori tiket',
                'body_text' => 'Da li ste sigurni da želite da ponovo otvorite tiket?',
                'naslov' => 'Otvori tiket',
                'akcija' => 'otkljucaj',
            ];
        }elseif($action == 'obrisi'){
            $modal_labels = [
                'button_label' => 'Obriši tiket',
                'body_text' => 'Da li ste sigurni da želite da obrišete tiket?',
                'naslov' => 'Obriši tiket',
                'akcija' => 'brisanje',
            ];
        }elseif($action == 'promeniVidljivost'){
            $promena_txt = ($this->tiket_vidljivost) ? 'samo vlasniku' : 'celoj zgradi';
            $modal_labels = [
                'button_label' => 'Promeni vidljiivost',
                'body_text' => 'Da li ste sigurni da želite da tiket bude vidljiv '.$promena_txt.'?',
                'naslov' => 'Promena vidljivosti',
                'akcija' => 'promena-vidljivosti',
            ];
        }
        
        $this->dispatch('openModal', 'modals.potvrdi-akciju-modal', $modal_labels);
    }

    public function addComment()
    {
        if(trim($this->new_coment) == '') return;

        KvarKomentari::create([
                'kvar_tiketId'=>$this->tkid,
                'userId'=>auth()->user()->id,
                'komentar'=>$this->new_coment
            ]);
        kvarTiket::where('id',$this->tkid)
            ->increment('tiket_br_komentara', 1);

        $new_bro = kvarTiket::select('tiket_br_komentara')->where('id',$this->tkid)->first();
        //$new_bro->ob_broj_komentara);

        KvarKomentarUserView::updateOrCreate( ['kvar_tiketId'=>$this->tkid, 'userId'=>auth()->user()->id], ['broj_vidjenih'=>$new_bro->tiket_br_komentara] );
        $this->new_coment = '';
    }

    public function back()
    {
        return redirect()->route('prijavi-kvar');
    }

    public function kvarPrioritet($prioritet_id)
    {
        kvarTiket::where('id',$this->tkid)->update(['tiket_prioritetId'=> $prioritet_id]);
    }

    public function getTiket()
    {
        return kvarTiket::where('kvar_tikets.id', '=' ,$this->tkid)
        ->leftJoin('kvar_tiket_prioritets', 'kvar_tiket_prioritets.id', '=', 'kvar_tikets.tiket_prioritetId')
        ->leftJoin('kvar_opis_tips', 'kvar_opis_tips.id', '=', 'kvar_tikets.opis_kvaraId')
        ->first();
    }

    public function getKomentari()
    {
        return KvarKomentari::select('kvar_komentaris.*', 'users.name')
        ->leftJoin('users', 'kvar_komentaris.userId', '=', 'users.id')
        ->where('kvar_komentaris.kvar_tiketId', '=',$this->tkid)
        ->get();
    }

    private function getTiketStanZgrada()
    {
        $tiket_stanid = kvarTiket::where('kvar_tikets.id', '=' ,$this->tkid)
                                ->first()
                                ->stanId;

        return Stan::select('stans.stanbr', 'stans.stan_namenaId', 'zgradas.naziv')
                    ->leftJoin('zgradas', 'zgradas.id', '=', 'stans.zgradaId' )
                    ->where('stans.id', '=', $tiket_stanid)
                    ->first();
    }

    private function getSlikeTiketa()
    {
        return KvarTiketImage::where('kvar_tiketId', '=', $this->tkid)->get();
    }

    public function viewImage($imgid)
    {
        $this->dispatch('openModal', 'modals.image-view-modal', ['img' => $imgid]);
    }

    public function render()
    {
        if($this->can_view)
        {
            return view('livewire.korisnik.kvar-pregled', [
                'tiket' => $this->getTiket(),
                'komentari' =>  $this->getKomentari(),
                'zgrada' => $this->getTiketStanZgrada(),
                'slike' => $this->getSlikeTiketa(),
            ]);
        }else{
             return view('livewire.korisnik.neautorizovana-akcija');
        }
        
    }
}
