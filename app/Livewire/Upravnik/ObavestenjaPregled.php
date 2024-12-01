<?php

namespace App\Livewire\Upravnik;

use Livewire\Component;
use Livewire\Attributes\On;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

use App\Models\Obavestenja;
use App\Models\ObavestenjeZgradaIndex;

use App\Actions\Zgrada\IzabranaZgrada;

class ObavestenjaPregled extends Component
{
    public $del_ob_id;

    #[On('promenjenaZgrada')]
    public function refreshMe()
    {
        return to_route('upravnik-obavestenja');
    }

    public function novoObavestenje()
    {
        $this->redirect('/upravnik-obavestenje-novo');
    }

     /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        return ObavestenjeZgradaIndex::select('obavestenjas.*','obavestenjas.id as oid', 'obavestenjas.created_at as obv_date', 'obavestenje_tips.ob_tip_naziv', 'obavestenja_komentar_user_viewds.broj_vidjenih')
                ->leftJoin('obavestenjas', 'obavestenjas.id', '=', 'obavestenje_zgrada_indices.obavestenjeId')
                ->leftJoin('obavestenje_tips', 'obavestenje_tips.id', '=', 'obavestenjas.ob_tipId')
                ->leftJoin('obavestenja_komentar_user_viewds', function($join)
                {
                    $join->on('obavestenjas.id', '=', 'obavestenja_komentar_user_viewds.obavestenjeId');
                    $join->on('obavestenja_komentar_user_viewds.userId', '=', DB::raw(auth()->user()->id));
                })
                ->where('obavestenje_zgrada_indices.zgradaId', '=', IzabranaZgrada::getIzabranaZgradaId())
                ->where('obavestenje_zgrada_indices.active', '=', 1)
                ->orderBy('obv_date', 'desc')
                ->paginate(Config::get('global.obavestenja_paginate'), ['*'], 'obavest');
    }

   public function render()
    {
        return view('livewire.upravnik.obavestenja-pregled', [
            'data' => $this->read(),
        ]);
    }
}
