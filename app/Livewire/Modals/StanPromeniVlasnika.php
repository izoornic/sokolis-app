<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

use App\Models\User;
use App\Models\UserStanIndex;

use Illuminate\Support\Facades\Config;

class StanPromeniVlasnika extends ModalComponent
{
    public $sid;
    public $sbr;

    public $ima_vlasnika;

    public $search_name;
    public $search_email;

    public $userId;
    public $user_row;
    public $zgradaId;

    public $racunSid;
    public $racunZid;

    public function mount()
    {
        $this->ima_vlasnika = ($this->userId) ? true : false;
        if($this->ima_vlasnika){
            $this->user_row = User::where('id', $this->userId)->first();
        }
    }

    public function read()
    {
        return User::select('*')
            ->where('users.user_tipId', '=', 1)
            ->where('users.id', '<>', $this->userId)
            ->when($this->search_name, function ($rtval){
                return $rtval->where('users.name', 'like', '%'.$this->search_name.'%');
            } )
            ->when($this->search_email, function ($rtval){
                return $rtval->where('users.email', 'like', '%'.$this->search_email.'%');
            } )
            ->paginate(Config::get('global.paginate'), ['*'], 'tik');
    }

    public function ukloniVlasnika()
    {
        UserStanIndex::where('stanId', $this->sid)->delete();
        $this->closeMod();
    }

    public function promeniVlasnika($uid)
    {
        UserStanIndex::updateOrCreate(['stanId'=>$this->sid],['userId'=>$uid, 'stanId'=>$this->sid]);
        $this->closeMod();
    }

    private function closeMod()
    {
        session()->flash('status', 'Podaci o vlasniku su uspešno promenjeni.');
        $this->closeModal();
        $this->redirect('/upravnik-zgrade');
    }

    public function render()
    {
        return view('livewire.modals.stan-promeni-vlasnika', [
            'data' => $this->read()
        ]);
    }
}
