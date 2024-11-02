<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class NoviStanar extends ModalComponent
{
    public $user_id;
    public $name;
    public $email;
    public $tel;
    public $pass;

    public $pravno_lice;

    public $adresa;
    public $sediste;
    public $postanskibr;
    public $mb;
    public $pib;
    public $tr;

    public $title;
    public $email_state; //init, exist, new

    public function mount()
    {
        $this->title = 'Izmeni podatke';
        if(!$this->email_state) {
            $this->email_state = 'init';
            $this->title = 'Novi stanar';
        }elseif($this->email_state == 'exist'){
            $this->loadModel();
        }
        //$this->email = "mirkec.cemes@dp.dd";
    }

    public function rules()
    {
        if($this->email_state == 'init'){
            return [
                'email' => 'required|string|email|max:255|unique:users',
            ];
        }elseif($this->email_state == 'new' || 'exist'){
            $retval = [
                'name' => 'required|string|max:255',
                'tel' => 'digits_between:8,11|nullable'
            ];

            if($this->email_state == 'new') $retval['pass'] = ['required', Password::min(8)->letters()->numbers()->symbols()];

            if($this->pravno_lice){
                $retval['adresa'] = 'required|string|max:255';
                $retval['sediste'] = 'required|string|max:255';
                $retval['postanskibr'] = 'required|digits_between:5,8';
                $retval['mb'] = 'required|digits_between:8,10';
                $retval['pib'] = 'required|digits_between:8,11';
            }
            return $retval;
        }
    }
    private function loadModel()
    {
        $user = User::where('id', '=', $this->user_id)->first();

       $this->name = $user->name;
       $this->email = $user->email;
       $this->tel = $user->tel;

       $this->pravno_lice = ($user->pib) ? true : false;
       if($this->pravno_lice){
        $this->adresa = $user->adresa;
        $this->sediste = $user->sediste;
        $this->postanskibr = $user->zip;
        $this->mb = $user->mb;
        $this->pib = $user->pib;
        $this->tr = $user->tr;
       }
    }

    public function searchEmail()
    {
        $this->validate();
        $this->email_state = 'new';
        //dd($this->email);
    }

    private function modelData()
    {
        $retval = [
            "name"      =>$this->name,
            "email"     =>$this->email,
            "tel"       =>$this->tel,
        ];

        if($this->email_state == 'new') $retval['password'] = Hash::make($this->pass);

        if($this->pravno_lice){
            $retval['adresa'] = $this->adresa;
            $retval['sediste'] = $this->sediste;
            $retval['zip'] = $this->postanskibr;
            $retval['mb'] = $this->mb;
            $retval['pib'] = $this->pib;
            $retval['tr'] = $this->tr;
        }
        return $retval;
    }

    public function newUser()
    {
        $this->tel = preg_replace('/\s+/', '', $this->tel);
        $this->validate();
        User::create($this->modelData());
        session()->flash('status', 'Nova stanar je uspešno dodat.');
        return $this->redirect('/upravnik-stanari');
    }

    public function editUser()
    {
        $this->tel = preg_replace('/\s+/', '', $this->tel);
        $this->validate();
        User::where('id', '=', $this->user_id)->update($this->modelData());
        session()->flash('status', 'Podaci o stanau uspešno promenjeni.');
        return $this->redirect('/upravnik-stanari');
    }

    public function render()
    {
        return view('livewire.modals.novi-stanar');
    }
}
