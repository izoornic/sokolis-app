<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

use App\Models\kvarTiket;
use App\Models\Stan;
use App\Models\KvarTiketImage;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Storage;

//use Auth;

class TiketPrijava extends ModalComponent
{
    use WithFileUploads;

    public $userId;
    public $ko_stanovi_zgrade;
    public $stanovi_lista;

    public $odabrani_stan;
    public $odabrana_zgrada;

    public $ima_vise_stanova;
    public $vrsta_validacije;
    public $photo_up_err;

    public $alowed_mime_type = ['image/jpeg','image/png', 'image/jpg', 'mage/gif']; 

    //#[Validate('required')]
    public $vrsta_kvara;

    //#[Validate('required', message: 'Polje "Opis kvara" je obavezno.')]
    public $kvar_opis;

    //#[Validate('required||numeric|gt:0', message: 'Izaberi prioritet kvara.')]
    public $kvar_prioritet;

    //#[Validate(['photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'])]
    public $photos;
    public $photo_p;

    public static function modalMaxWidth(): string
    {
        return '4xl'; 
    }

    public function rules()
    {
        if($this->vrsta_validacije == 'fotke'){
            return [
                'photo_p' => 'image|mimes:jpeg,png,jpg,gif|max:8192',
            ];
        }else{
            return [
                'vrsta_kvara' => 'required',
                'kvar_opis' => 'required',
                'kvar_prioritet' => 'required||numeric|gt:0',
            ];
        }
        
    }

    public function mount()
    {
        //$this->modalMaxWidth();
        $this->userId = auth()->user()->id;
        $this->kvar_prioritet = 0;
        //$this->vrsta_kvara = 1;
        $this->ko_stanovi_zgrade = session()->only(['stanovi', 'zgrade']);
        
        $this->stanovi_lista = $this->ko_stanovi_zgrade['stanovi'];
        $this->ima_vise_stanova = (count($this->stanovi_lista) > 1) ? true : false;
        $this->odabrani_stan = $this->stanovi_lista[0];
        //dd(self::$modalMaxWidth);
    }

    private function stanoviKorisnikaLista()
    {
       $st_colection = Stan::select('stans.id as sid', 'stans.stanbr', 'zgradas.id as zid', 'zgradas.naziv', 'stans.stan_namenaId')
            ->leftJoin('zgradas', 'zgradas.id', '=', 'stans.zgradaId')
            ->whereIn('stans.id', $this->ko_stanovi_zgrade['stanovi'])
            ->get();
        
        $st_colection->each(function ($item, $key){
            array_push($this->stanovi_lista, $item);
        });
    }

    private function modelData()
    {

        return [
            'userId'            => $this->userId,
            'tiket_statusId'    => 1,
            'tiket_prioritetId' => $this->kvar_prioritet,
            'opis_kvaraId'      => $this->vrsta_kvara,
            'opis'              => $this->kvar_opis,
            'zgradaId'          => Stan::find($this->odabrani_stan)->zgrada()->first()->id,
            'stanId'            => $this->odabrani_stan,
        ];
    }

    public function clearTempImages()
    {
        $this->photos = [];
    }

    public function saveTiket()
    {
        //dd($this->photos[0]);
        $this->vrsta_validacije = 'tiket';
        $this->validate();

        $newTik = kvarTiket::create($this->modelData());

        $no_of_photos = count($this->photos);
        if($no_of_photos){
            foreach($this->photos as $phooto){
                $name = $phooto->hashName();
                if ( Storage::disk('public')->putFileAs('', $phooto, $name)) KvarTiketImage::create(['userId'=>$this->userId , 'kvar_tiketId'=>$newTik->id , 'image_path'=>$name]);
            }
            kvarTiket::where('id', '=', $newTik->id)->update(['broj_slika' => $no_of_photos]);
        }
        
        session()->flash('status', 'Nova prijava kvara je uspešno sačuvana.');
 
        return $this->redirect('/prijavi-kvar');
    }

    public function getPphotos()
    {
        return $this->photos;
    }

    public function validatePhotos()
    {
        //$errorsd = [];
        $slice_keys=[];
        foreach($this->photos as $key => $photo)
        {
            $this->vrsta_validacije = 'fotke';
            if(in_array($photo->getMimeType(), $this->alowed_mime_type)){
                $this->photo_p = $photo;
                try{
                    $this->validate();
                }catch(ValidationException $error){
                    //array_push($errorsd, $error);
                    array_push($slice_keys, $key);
                }
            }else{
                array_push($slice_keys, $key);
            }
        }
        $slice_keys = array_reverse($slice_keys);
        
        foreach($slice_keys as $skey){
            array_splice($this->photos, $skey);
        }
    }

    public function isPreviwable()
    {
        foreach($this->photos as $key => $photo)
        {
            dd($photo->getMimeType(), $key);
        }
    }
   
    public function render()
    {
        
        return view('livewire.modals.tiket-prijava');
    }
}
