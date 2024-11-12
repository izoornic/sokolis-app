<?php

namespace App\Livewire\Upravnik;

use Livewire\Component;
use App\Models\Obavestenja;
use App\Models\ObavestenjeZgradaIndex;

use App\Actions\Zgrada\IzabranaZgrada;

use Joelwmale\LivewireQuill\Traits\HasQuillEditor;


class ObavestenjeNovo extends Component
{
    use HasQuillEditor;

    public $oid;
    public $title;

    public $ob_naslov;
    public $content;
    public $ob_tip;
    public $files; 
    
    public $is_edit;
    public $zgrade;

    public function mount()
    {
        $this->oid = request()->query('oid');
        $this->zgrade = [IzabranaZgrada::getIzabranaZgradaId()];

        if($this->oid){
            $this->title = "Izmeni obaveštenje";
            $this->is_edit = true;
            $ob_model = Obavestenja::where('id', $this->oid)->first();
            $this->ob_naslov = $ob_model->ob_naslov;
            $this->content = $ob_model->ob_text;
            $this->content = str_replace('text-right', 'ql-align-right', $this->content);
            $this->content = str_replace('text-center','ql-align-center', $this->content);
            $this->ob_tip = $ob_model->ob_tipId;
        }else{
            $this->title = "Novo obaveštenje";
            $this->is_edit = false;
            $this->ob_tip = 1;
        }
    }

    public function contentChanged($editorId, $content)
    {
        // $editorId is the id use when you initiated the livewire component
        // $content is the raw text editor content

        // save to the local variable...
        $this->content = $content;
    }

    public function save()
    {
        $this->content = str_replace('ql-align-right', 'text-right', $this->content);
        $this->content = str_replace('ql-align-center', 'text-center', $this->content);
        $model_data = [
            'userId' => auth()->user()->id,
            'ob_tipId' => $this->ob_tip,
            'ob_naslov' => $this->ob_naslov,
            'ob_text' => $this->content
        ];

        if($this->is_edit){
            Obavestenja::where('id', $this->oid)->update($model_data);
        }else{

            $new = Obavestenja::create($model_data);
            $new_ob_id = $new->id;
            foreach($this->zgrade as $zg_id){
                ObavestenjeZgradaIndex::create([
                    'obavestenjeId' => $new_ob_id,
                    'zgradaId' => $zg_id
                ]);
            }
        }
        $this->redirect('/upravnik-obavestenja');
    }

    public function render()
    {
        return view('livewire.upravnik.obavestenje-novo');
    }
}
