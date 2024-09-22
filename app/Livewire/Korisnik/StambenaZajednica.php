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
    }

    public function read()
    {
        $obavestenja_ids = SzObavestenjeZgradaIndex::distinct('sz_obavestenjeId')
        ->whereIn('zgradaId', $this->ko_stanovi_zgrade['zgrade'])
        ->pluck('sz_obavestenjeId');

        return SzObavestenje::select('*','sz_obavestenjes.id as oid', 'sz_obavestenjes.created_at as obv_date')
        //->leftJoin('obavestenje_tips', 'obavestenje_tips.id', '=', 'obavestenjas.ob_tipId')
        //->leftJoin('obavestenja_komentar_user_viewds', function($join)
        //{
        //$join->on('obavestenjas.id', '=', 'obavestenja_komentar_user_viewds.obavestenjeId');
        //$join->on('obavestenja_komentar_user_viewds.userId', '=', DB::raw(auth()->user()->id));
        //})
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
