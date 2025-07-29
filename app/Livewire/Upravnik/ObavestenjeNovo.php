<?php

namespace App\Livewire\Upravnik;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

use App\Models\Obavestenja;
use App\Models\ObavestenjaLink;
use App\Models\UpravnikZgradaIndex;
use App\Models\ObavestenjeZgradaIndex;

use Illuminate\Support\Facades\Storage;

use App\Actions\Zgrada\IzabranaZgrada;
use Joelwmale\LivewireQuill\Traits\HasQuillEditor;

use App\Actions\Zgrada\EmailStanarimaSender;

class ObavestenjeNovo extends Component
{
    use HasQuillEditor;
    use WithFileUploads;

    public $oid;
    public $title;

    public $ob_naslov;
    public $content;
    public $ob_tip;
    public $ob_tip_labels;
    
    public $db_files;   //ranije sacuvani fajlovi koji se ucitaju samo kad je edit iz databaze
    public $files;      // fajlovi ucitani uploadom
    public $upload_files_display_text;
    public $cur_file;

    
    public $is_edit;
    public $zgrade;
    public $zgrade_error;

    public function mount()
    {
        $this->oid = request()->query('oid');
        $this->files = [];
        $this->db_files = [];
        $this->upload_files_display_text = [];
        $this->ob_tip_labels = ['', 'važno', 'obaveštenje', 'informacija'];

       //dd(auth()->user()->zgrade()->get());
        if($this->oid){
            $this->title = "Izmeni obaveštenje";
            $this->is_edit = true;
            $ob_model = Obavestenja::where('id', $this->oid)->first();
            $this->ob_naslov = $ob_model->ob_naslov;
            $this->content = $ob_model->ob_text;
            $this->content = str_replace('text-right', 'ql-align-right', $this->content);
            $this->content = str_replace('text-center','ql-align-center', $this->content);
            $this->ob_tip = $ob_model->ob_tipId;

            $this->db_files = ObavestenjaLink::where('obavestenjeId', $this->oid)->get();
            $this->zgrade = ObavestenjeZgradaIndex::select('zgradaId')->where('obavestenjeId', $this->oid)->where('active', 1)->pluck('zgradaId');
        }else{
            $this->zgrade = [IzabranaZgrada::getIzabranaZgradaId()];
            $this->title = "Novo obaveštenje";
            $this->is_edit = false;
            $this->ob_tip = 1;
        }
    }

    public function rules()
    {
        return [
            'ob_naslov' => 'required|string|max:255',
        ]; 
    }

    #[On('promenjenaZgrada')]
    public function refreshMe()
    {
        if($this->is_edit) return;
        //$this->render();
        return to_route('upravnik-obavestenje-novo');
    }

    public function zgradeList()
    {
        return auth()->user()->zgrade()->get();
    }

    /*
    * Set tip obavestenja u blade fajlu
    * @param int $tid
    * @return void
    */
    public function setTipId($tid):void
    {
        $this->ob_tip = $tid;
    }

    /* 
    [
        [
            'header' => [1, 2, 3, 4, 5, 6, false],
        ],
    ], 
    [
        [
            'list' => 'ordered',
        ],
        [
            'list' => 'bullet',
        ],
    ],

    */

    public function contentChanged($editorId, $content)
    {
        // $editorId is the id use when you initiated the livewire component
        // $content is the raw text editor content

        // save to the local variable...
        $this->content = $content;
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
            'ob_tipId' => $this->ob_tip,
            'ob_naslov' => $this->ob_naslov,
            'ob_text' => $this->content
        ];

        if($this->is_edit){
            Obavestenja::where('id', $this->oid)->update($model_data);
            //obrisi sve redove sa ovim idjem
            //ObavestenjeZgradaIndex::where('obavestenjeId', $this->oid)->delete();
            $new_ob_id = $this->oid;
        }else{
            $new = Obavestenja::create($model_data);
            $new_ob_id = $new->id; 
        }

        //dodja zakacene fajlove ako ih ima
        if(count($this->files)){
            foreach($this->files as $file){
                $file['link_txt'] = $file['link_txt'] ?: $file['original_name'];
                if ( Storage::disk('public')->putFileAs('', $file['file_to_up'], $file['hashName'])) ObavestenjaLink::create(['obavestenjeId'=>$new_ob_id, 'ob_link_tekst'=>$file['link_txt'] , 'ob_link_adress'=>$file['hashName']]);
            }
        }

        if($this->is_edit){
            // proveri da li je aktivno
            ObavestenjeZgradaIndex::where('obavestenjeId', $new_ob_id)->whereNotIn('zgradaId', $this->zgrade)->update(['active' => 0]);
            
            foreach($this->zgrade as $zg_id){
                ObavestenjeZgradaIndex::where('obavestenjeId', $new_ob_id)->updateOrCreate(
                    ['obavestenjeId' => $new_ob_id, 'zgradaId' => $zg_id],
                    ['active' => 1]
                );
            }
            //ako je edituj obavestenje, posalji email samo zgradama kojima nije poslat
            $zgrade_za_email = ObavestenjeZgradaIndex::where(['obavestenjeId' => $new_ob_id, 'email_sent' => 0])->pluck('zgradaId');
            if(count($zgrade_za_email)){
                $this->PosaljiEmail($new_ob_id, $zgrade_za_email);
            }

            //$zgrade_za_email = ObavestenjeZgradaIndex::where(['obavestenjeId' => $new_ob_id, 'email_sent' => 0])->pluck('zgradaId');

        }else{
            //NOVO OBAVEŠTENJE 
            foreach($this->zgrade as $zg_id){
                 ObavestenjeZgradaIndex::create(['obavestenjeId' => $new_ob_id, 'zgradaId' => $zg_id]);       
            };
            // POŠALJI EMAIL

            $this->PosaljiEmail($new_ob_id, $this->zgrade);      
        }

        $flash_msg = ($this->is_edit) ? 'Obaveštenje je uspešno izmenjeno.' : 'Novo obaveštenje uspešno dodato.';
        session()->flash('status', $flash_msg);
        $this->redirect('/upravnik-obavestenja');
    }

    private function PosaljiEmail($ob_id, $zgrade)
    {
        $ob_model = Obavestenja::where('id', $ob_id)->first();
        $ob_tip_id = $ob_model->ob_tipId;
        $subject = "Novo obaveštenje: " . $ob_model->ob_naslov;
        $message_p = "Poštovani, <br> Na portal je objavljeno novo obaveštenje: <strong>" . $ob_model->ob_naslov . "</strong>.<br> Molimo Vas da ga pogledate na portalu.";
        
        EmailStanarimaSender::send('Novo obaveštenje - stanari-sokolis.rs',  $message_p, false, [], $zgrade, $ob_tip_id, 'pocetna');
        
        //update email_sent
        ObavestenjeZgradaIndex::where('obavestenjeId', $ob_id)->whereIn('zgradaId', $zgrade)->update(['email_sent' => 1]);
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
        $db_row = ObavestenjaLink::where('id', $id)->first();
        Storage::delete($db_row->ob_link_adress);
        ObavestenjaLink::where('id', $id)->delete();
        $this->db_files = ObavestenjaLink::where('obavestenjeId', $this->oid)->get();
    }

    public function render()
    {
        return view('livewire.upravnik.obavestenje-novo', [
            'zgrade_upravnika' => $this->zgradeList()
        ]);
    }
}
