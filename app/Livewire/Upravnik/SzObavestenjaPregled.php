<?php

namespace App\Livewire\Upravnik;

use Livewire\Component;
use Livewire\Attributes\On;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

use App\Models\SzObavestenje;
use App\Models\SzObavestenjeZgradaIndex;

use App\Actions\Zgrada\IzabranaZgrada;

class SzObavestenjaPregled extends Component
{
    public $del_ob_id;
    
    #[On('promenjenaZgrada')]
    public function refreshMe()
    {
        return to_route('sz-upravnik-obavestenja');
    }

    public function novoObavestenje()
    {
        $this->redirect('/sz-upravnik-obavestenje-novo');
    }

     /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return SzObavestenjeZgradaIndex::select('sz_obavestenjes.*','sz_obavestenjes.id as oid', 'sz_obavestenjes.created_at as obv_date')
                ->leftJoin('sz_obavestenjes', 'sz_obavestenjes.id', '=', 'sz_obavestenje_zgrada_indices.sz_obavestenjeId')
                ->where('sz_obavestenje_zgrada_indices.zgradaId', '=', IzabranaZgrada::getIzabranaZgradaId())
                ->where('sz_obavestenje_zgrada_indices.active', '=', 1)
                ->orderBy('obv_date', 'desc')
                ->paginate(Config::get('global.obavestenja_paginate'), ['*'], 'obavest');
    }

    public function render()
    {
        return view('livewire.upravnik.sz-obavestenja-pregled', [
            'data' => $this->read(),
        ]);
    }
}
