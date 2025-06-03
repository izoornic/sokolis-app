<?php

namespace App\Livewire\Upravnik;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Actions\Zgrada\IzabranaZgrada;
use Joelwmale\LivewireQuill\Traits\HasQuillEditor;

use App\Models\User;
use App\Models\Zgrada;

use App\Actions\Zgrada\EmailStanarimaSender; 


class EmailObavestenjeNovo extends Component
{
    use HasQuillEditor;
    use WithFileUploads;

    public $subject;
    public $message;

    public $files;      // fajlovi ucitani uploadom
    public $upload_files_display_text;
    public $cur_file;

    public $zgrade_error;
    public $zgrade;

    public function mount()
    {
        $this->files = [];
        $this->message = '';
        $this->upload_files_display_text = [];
        $this->zgrade = [IzabranaZgrada::getIzabranaZgradaId()];
    }

    public function rules()
    {
        return [
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]; 
    }

    public function posaljiObavestenje()
    {
        //dd($this->message);
        $this->validate();

        if(!count($this->zgrade)){
            $this->zgrade_error = 'Barem jedna zgrada mora biti izabrana!';
            return;
        }

        $email_adrese = Zgrada::emailAdreseStanara($this->zgrade);
        

        if(!count($email_adrese['bcc_adrese'])){
            $this->zgrade_error = 'Za izabrane zgrade ne postoji stanar koji će dobiti e-mail poruku!';
            return;
        }

        //send and log email
        EmailStanarimaSender::send($this->subject, $this->message, $this->files, $this->zgrade, 8);

        $this->files = [];
        $this->message = '';
        $this->subject = '';
        
        session()->flash('status', 'E-mail obaveštenje je uspešno poslato!');
        return $this->redirect('/email-obavestenja');
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
        $this->message = $content;
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

    public function render()
    {
        return view('livewire.upravnik.email-obavestenje-novo', [
            'zgrade_upravnika' => $this->zgradeList()
        ]);
    }
}
