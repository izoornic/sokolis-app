<?php

namespace App\Livewire\Upravnik;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

use App\Models\kvarTiket;
use App\Models\KvarTiketPrioritet;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

use App\Actions\Zgrada\IzabranaZgrada;

class KvarPrijavePregled extends Component
{
    use WithPagination;

    #[On('promenjenaZgrada')]
    public function refreshMe()
    {
        $this->render();
    }

    public function read()
    {
        return kvarTiket::select('*', 'kvar_tikets.created_at as crt', 'kvar_tikets.id as ktid', 'kvar_komentar_user_views.broj_vidjenih')
        ->leftJoin('kvar_tiket_prioritets', 'kvar_tikets.tiket_prioritetId', '=', 'kvar_tiket_prioritets.id')
        ->leftJoin('kvar_opis_tips', 'kvar_tikets.opis_kvaraId', '=', 'kvar_opis_tips.id')
        ->leftJoin('kvar_komentar_user_views', function($join)
        {
            $join->on('kvar_komentar_user_views.kvar_tiketId', '=', 'kvar_tikets.id');
            $join->on('kvar_komentar_user_views.userId', '=', DB::raw(auth()->user()->id));
        })
        ->where('kvar_tikets.zgradaId', '=', IzabranaZgrada::getIzabranaZgradaId())
        
        ->where('kvar_tikets.tiket_statusId', '<', 3)
        ->orderBy('crt', 'DESC')
        ->paginate(Config::get('global.paginate'), ['*'], 'tik');

    }

    public function render()
    {
        return view('livewire.upravnik.kvar-prijave-pregled', [
            'data' => $this->read(),
        ]);
    }
}
