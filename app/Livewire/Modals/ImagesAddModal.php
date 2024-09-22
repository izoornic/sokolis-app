<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\KvarTiketImage;
use App\Models\kvarTiket;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;

use Illuminate\Validation\ValidationException;

class ImagesAddModal extends ModalComponent
{
    use WithFileUploads;

    public $tkid;
    public $photos;
    public $photo_p;
    public $alowed_mime_type = ['image/jpeg','image/png', 'image/jpg', 'mage/gif']; 

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function rules()
    {
        return [
            'photo_p' => 'image|mimes:jpeg,png,jpg,gif|max:8192',
        ]; 
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

    public function clearTempImages()
    {
        $this->photos = [];
    }

    public function savePhotos()
    {
        if(!$this->photos) return;
        $no_of_photos = count($this->photos);
        if($no_of_photos){
            foreach($this->photos as $phooto){
                $name = $phooto->hashName();
                if ( Storage::disk('public')->putFileAs('', $phooto, $name)) KvarTiketImage::create(['userId'=>auth()->user()->id, 'kvar_tiketId'=>$this->tkid , 'image_path'=>$name]);
            }
            kvarTiket::updateBrojSlika($this->tkid);
        }
        $this->dispatch('slikeDodate');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.images-add-modal');
    }
}
