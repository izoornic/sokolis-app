<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\EmailObavestenjaLog;
use App\Models\Zgrada;
use App\Models\User;
use Livewire\WithPagination;

class EmailPregled extends ModalComponent
{
    use withPagination;
    public $email_id;
    public $email;
    public $tip;
    public $stanari_visible = false;
    public $zgrade_visible = false;

    public $attacments = [];
    

    public static function modalMaxWidth(): string
    {
        return '3xl';
    }

    public function mount()
    {
        $this->email = EmailObavestenjaLog::find($this->email_id);
        $this->attacments = $this->email->attachments ? json_decode($this->email->attachments) : [];
    }

    public function toogleStanari()
    {
        $this->stanari_visible = !$this->stanari_visible;
    }

    public function toogleZgrade()
    {
        $this->zgrade_visible = !$this->zgrade_visible;
    }

    public function zgrade()
    {
        return Zgrada::whereIn('id',  $this->email->zgrade()->pluck('zgrada_id'))->get();
    }

    public function stanari()
    {
        return User::whereIn('id',  $this->email->stanari()->pluck('user_id'))->paginate(20);
    }

    public function render()
    {
        return view('livewire.modals.email-pregled', [
            'eml_zgrade' => $this->zgrade(),
            'eml_stanari' => $this->stanari(),
        ]);
    }
}
