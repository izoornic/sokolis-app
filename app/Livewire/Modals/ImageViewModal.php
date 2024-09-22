<?php

namespace App\Livewire\Modals;
use Livewire\Attributes\On;

use LivewireUI\Modal\ModalComponent;
use App\Models\KvarTiketImage;
use App\Models\kvarTiket;

use Illuminate\Support\Facades\Storage;

class ImageViewModal extends ModalComponent
{

    public $img;
    public $image_name;
    public $tiket_id;
    public $sorce;

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function mount()
    {
        $this->sorce=env('IMAGE_MANIPILATION');
        $img_model = KvarTiketImage::where('id', '=', $this->img)->first();
        $this->image_name = $img_model->image_path;
        $this->tiket_id = $img_model->kvar_tiketId;
    }

    #[On('obrisi')] 
    public function obrisiSliku()
    {
        if(KvarTiketImage::destroy($this->img)) Storage::disk('public')->delete($this->image_name);
        kvarTiket::updateBrojSlika($this->tiket_id);
        $this->dispatch('slika_obrisana');
        $this->forceClose()->closeModal();
    }

    public function deleteImage()
    {
        $modal_labels = [
            'button_label' => 'Obriši sliku',
            'body_text' => 'Da li ste sigurni da želite da obrišete sliku?',
            'naslov' => 'Obriši sliku',
            'akcija' => 'obrisi',
        ];
        $this->dispatch('openModal', 'modals.potvrdi-akciju-modal', $modal_labels);
    }

    public function render()
    {
        return view('livewire.modals.image-view-modal');
    }
}
