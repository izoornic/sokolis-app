<?php

namespace App\Livewire\Korisnik;

use Livewire\Component;

use App\Models\User;
use App\Models\SzObavestenje;
use App\Models\SzObavestenjeZgradaIndex;

use Illuminate\Support\Facades\Config;

class StambenaZajednica extends Component
{
    public $ko_stanovi_zgrade = [];
    //public $ko_zgrade = [];

    /**
     * [Description for mount]
     *
     * @return [type]
     * 
     */
    public function mount()
    {
        if(!session()->exists(['stanovi', 'zgrade'])){
            User::getMyZgradeStanove();
        }
       $this->ko_stanovi_zgrade = session()->only(['stanovi', 'zgrade']);
       //dd($this->ko_stanovi_zgrade);
    }

    public function read()
    {
        $obavestenja_ids = SzObavestenjeZgradaIndex::distinct('sz_obavestenjeId')
        ->where('active', '=', 1)
        ->whereIn('zgradaId', $this->ko_stanovi_zgrade['zgrade'])
        ->pluck('sz_obavestenjeId');
        //dd($obavestenja_ids);
        return SzObavestenje::select('sz_obavestenjes.id as oid','sz_obavestenjes.*', 'sz_obavestenjes.created_at as obv_date')
        ->whereIn('sz_obavestenjes.id', $obavestenja_ids)
        ->orderBy('obv_date', 'desc')
        ->paginate(Config::get('global.obavestenja_paginate'), ['*'], 'obavest');
    }

    public function render()
    {
        return view('livewire.korisnik.stambena-zajednica', [
            'data' => $this->read(),
        ]);
    }
}
