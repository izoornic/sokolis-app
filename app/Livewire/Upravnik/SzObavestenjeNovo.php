<?php

namespace App\Livewire\Upravnik;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

use App\Models\SzObavestenje;
use App\Models\SzObavestenjaFiles;
use App\Models\UpravnikZgradaIndex;
use App\Models\SzObavestenjeZgradaIndex;

use Illuminate\Support\Facades\Storage;

use App\Actions\Zgrada\IzabranaZgrada;
use Joelwmale\LivewireQuill\Traits\HasQuillEditor;

use App\Actions\Zgrada\EmailStanarimaSender;

class SzObavestenjeNovo extends Component
{
    use HasQuillEditor;
    use WithFileUploads;

    public $oid;
    public $title;

    public $ob_naslov;
    public $content;
    
    public $db_files;   //ranije sacuvani fajlovi koji se ucitaju samo kad je edit iz databaze
    public $files;      // fajlovi ucitani uploadom
    public $upload_files_display_text;
    public $cur_file;

    public $is_edit;
    public $zgrade;
    public $zgrade_error;

    public $ob_tip_email; // tip obaveštenja za email

    public function mount()
    {
        $this->oid = request()->query('oid');
        $this->files = [];
        $this->db_files = [];
        $this->upload_files_display_text = [];

       //dd(auth()->user()->zgrade()->get());
        if($this->oid){
            $this->title = "Izmeni obaveštenje";
            $this->is_edit = true;
            $ob_model = SzObavestenje::where('id', $this->oid)->first();
            $this->ob_naslov = $ob_model->sz_ob_naslov;
            $this->content = $ob_model->sz_ob_text;
            $this->content = str_replace('text-right', 'ql-align-right', $this->content);
            $this->content = str_replace('text-center','ql-align-center', $this->content);

            $this->db_files = SzObavestenjaFiles::where('sz_obavestenjeId', $this->oid)->get();
            $this->zgrade = SzObavestenjeZgradaIndex::select('zgradaId')->where('sz_obavestenjeId', $this->oid)->pluck('zgradaId');
        }else{
            $this->zgrade = [IzabranaZgrada::getIzabranaZgradaId()];
            $this->title = "Novo obaveštenje";
            $this->is_edit = false;
            $this->ob_tip_email = 7;
        }
    }

    public function rules()
    {
        return [
            'ob_naslov' => 'required|string|max:255',
        ]; 
    }

    public function zgradeList()
    {
        return auth()->user()->zgrade()->get();
    }

    public function contentChanged($editorId, $content)
    {
        // $editorId is the id use when you initiated the livewire component
        // $content is the raw text editor content

        // save to the local variable...
        $this->content = $content;
    }

    public function updated($key, $value)
    {
        if($this->cur_file){
            $currr = $this->cur_file;
            $this->cur_file = null;
            array_push( $this->files, [
                'origin' => 'upload',
                'original_name' => $currr->getClientOriginalName(),
                'hashName' => $currr->hashName(),
                'link_txt' => '',
                'file_to_up' => $currr
            ]);
        }
    }

    public function delUpload($ind)
    {
        array_splice($this->files, $ind, 1);
    }

    public function delDbUpload($id)
    {
        $db_row = SzObavestenjaFiles::where('id', $id)->first();
        Storage::delete($db_row->sz_file_name);
        SzObavestenjaFiles::where('id', $id)->delete();
        $this->db_files = SzObavestenjaFiles::where('sz_obavestenjeId', $this->oid)->get();
    }

    public function save()
    {
        $this->validate();

        if(!count($this->zgrade)){
            $this->zgrade_error = 'Barem jedna zgrada mora biti izabrana!';
            return;
        }
        $this->content = str_replace('ql-align-right', 'text-right', $this->content);
        $this->content = str_replace('ql-align-center', 'text-center', $this->content);
        $model_data = [
            'userId' => auth()->user()->id,
            'sz_ob_naslov' => $this->ob_naslov,
            'sz_ob_text' => $this->content
        ];

        if($this->is_edit){
            SzObavestenje::where('id', $this->oid)->update($model_data);
            //obrisi sve redove sa ovim idjem
            SzObavestenjeZgradaIndex::where('sz_obavestenjeId', $this->oid)->delete();
            $new_ob_id = $this->oid;
        }else{
            $new = SzObavestenje::create($model_data);
            $new_ob_id = $new->id; 
        }

        //dodja zakacene fajlove ako ih ima
        if(count($this->files)){
            foreach($this->files as $file){
                $file['link_txt'] = $file['link_txt'] ?: $file['original_name'];
                if ( Storage::disk('public')->putFileAs('', $file['file_to_up'], $file['hashName'])) SzObavestenjaFiles::create(['sz_obavestenjeId'=>$new_ob_id, 'sz_link_text'=>$file['link_txt'] , 'sz_file_name'=>$file['hashName'], 'userId'=>auth()->user()->id]);
            }
        }

        if(!$this->is_edit){
            $message_eml = '<p> Na portalu je objavljeno novo obaveštenja na stranici: "Stambena zajednica". </p>
                            <p> Obaveštenje: <strong>' . $this->ob_naslov . '</strong></p>';

            //posalji email
            EmailStanarimaSender::send('Novo obaveštenje - stanari-sokolis.rs', $message_eml, [], $this->zgrade, $this->ob_tip_email, 'stambena-zajednica');
        }

        foreach($this->zgrade as $zg_id){
            SzObavestenjeZgradaIndex::create([
                'sz_obavestenjeId' => $new_ob_id,
                'zgradaId' => $zg_id
            ]);
        }
        $flash_msg = ($this->is_edit) ? 'Obaveštenje je uspešno izmenjeno.' : 'Novo obaveštenje uspešno dodato.';
        session()->flash('status', $flash_msg);
        $this->redirect('/sz-upravnik-obavestenja');
    }


    public function render()
    {
        return view('livewire.upravnik.sz-obavestenje-novo', [
            'zgrade_upravnika' => $this->zgradeList()
        ]);
    }
}
