<?php

namespace App\Livewire\Upravnik;

use Livewire\Attributes\On;

use Livewire\Component;
use App\Models\Stan;
use App\Models\Zgrada;

use App\Actions\Zgrada\IzabranaZgrada;

class Zgrade extends Component
{
    
    public function mount()
    {
        
    }

    #[On('promenjenaZgrada')]
    public function refreshMe()
    {
        $this->render();
    }

    public function viewRacune($stanid)
    {
        $this->redirect('/stanar-racun?sid='.$stanid);
    }

    //TODO  Ako je moguce dodati dugovanja preko API-ja

    public function read()
    {
        return Stan::select('stans.id', 'stans.stanbr', 'stans.stan_namenaId', 'stans.sprat', 'stans.povrsina', 'stans.garaza', 'users.name', 'users.tel', 'users.email', 'user_stan_indices.userId')
                        ->leftJoin('user_stan_indices', 'user_stan_indices.stanId', '=', 'stans.id')
                        ->leftJoin('users', 'users.id', '=', 'user_stan_indices.userId')
                        ->where('stans.zgradaId', '=', IzabranaZgrada::getIzabranaZgradaId())
                        ->orderBy('stans.sprat', 'ASC')
                        ->orderBy('stans.spb', 'ASC')
                        ->get();
    }

    public function render()
    {
        return view('livewire.upravnik.zgrade', [
            'data' => $this->read()
        ]);
    }
}
