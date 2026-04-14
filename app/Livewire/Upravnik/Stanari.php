<?php

namespace App\Livewire\Upravnik;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

use App\Models\User;
use App\Models\EmailObavestenjaUser;
use App\Models\UserStanIndex;
use App\Models\Stan;
use App\Models\UpravnikZgradaIndex;
use Illuminate\Support\Facades\Config;

class Stanari extends Component
{
    use WithPagination;

    public $del_id;

    //search
    public $search_name;
    public $search_email;

    public function mount()
    {
       //dd(User::find(1)->stanoviDetalji()->get());
    }

    #[On('stan-dodat')]
    public function stanDodatInfo()
    {
        session()->flash('status', 'Stan je uspešno dodat.');
        $this->redirect('/upravnik-stanari');
        //$this->render();
    }


    #[On('stan-uklonjen')]
    public function stanUkljonjenInfo()
    {
        session()->flash('status', 'Stan je uspešno uklonjen.');
        $this->redirect('/upravnik-stanari');
    }
    
    #[On('obrisi-stanara')] 
    public function obrisiStanara()
    {
        EmailObavestenjaUser::where('user_id', '=', $this->del_id)->delete();
        User::destroy($this->del_id);
        session()->flash('status', 'Stanar je uspešno obrisan.');
        $this->render();
    }

    public function deleteUser($id)
    {
        $this->del_id = $id;
        $uss_data = User::where('id', '=', $id)->first();
        $modal_labels = [
            'button_label' => 'Obriši stanara',
            'body_text' => 'Da li ste sigurni da želite da obrišete stanara: ',
            'body_text2ndrow' => $uss_data->name.' ?',
            'naslov' => 'Obriši stanara',
            'akcija' => 'obrisi-stanara',
        ];
        $this->dispatch('openModal', 'modals.potvrdi-akciju-modal', $modal_labels);
    }

 /*    addStan

    viewStanovi */

    public function read()
    {
        $zgradaIds = UpravnikZgradaIndex::where('userId', auth()->user()->id)->pluck('zgradaId');
        $stanIds   = Stan::whereIn('zgradaId', $zgradaIds)->pluck('id');
        $userIds   = UserStanIndex::whereIn('stanId', $stanIds)->pluck('userId')->unique();

        return User::select('*')
            ->withCount(['stanovi'])
            ->where('users.user_tipId', '=', 1)
            ->where(function ($q) use ($userIds) {
                $q->whereIn('users.id', $userIds)
                  ->orWhereDoesntHave('stanovi');
            })
            ->when($this->search_name, function ($q) {
                return $q->where('users.name', 'like', '%'.$this->search_name.'%');
            })
            ->when($this->search_email, function ($q) {
                return $q->where('users.email', 'like', '%'.$this->search_email.'%');
            })
            ->paginate(Config::get('global.paginate'), ['*'], 'tik');
    }


    public function render()
    {
        return view('livewire.upravnik.stanari', [
            'data' => $this->read()
        ]);
    }
}
