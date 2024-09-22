<?php

namespace App\Livewire\Korisnik;

use Livewire\Component;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

use App\Models\User;
use App\Models\Obavestenja;
use App\Models\ObavestenjeZgradaIndex;


class Pocetna extends Component
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

     /**
     * The read function.
     *
     * @return void
     */
    public function read()
    {
        $obavestenja_ids = ObavestenjeZgradaIndex::distinct('obavestenjeId')
                            ->whereIn('zgradaId', $this->ko_stanovi_zgrade['zgrade'])
                            ->pluck('obavestenjeId');

        return Obavestenja::select('*','obavestenjas.id as oid', 'obavestenjas.created_at as obv_date')
                ->leftJoin('obavestenje_tips', 'obavestenje_tips.id', '=', 'obavestenjas.ob_tipId')
                ->leftJoin('obavestenja_komentar_user_viewds', function($join)
                {
                    $join->on('obavestenjas.id', '=', 'obavestenja_komentar_user_viewds.obavestenjeId');
                    $join->on('obavestenja_komentar_user_viewds.userId', '=', DB::raw(auth()->user()->id));
                })
                ->whereIn('obavestenjas.id', $obavestenja_ids)
                ->orderBy('obv_date', 'desc')
                ->paginate(Config::get('global.obavestenja_paginate'), ['*'], 'obavest');
    }



    public function render()
    {
        return view('livewire.korisnik.pocetna', [
            'data' => $this->read(),
        ]);
    }
}
