<?php

namespace App\Livewire\Servis;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

use App\Models\kvarTiket;
use App\Models\ServisZgradaIndex;

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
        $userId = auth()->user()->id;

        // izabrana zgrada mora da bude jedna od zgrada koje servis održava
        $zgradaIds = ServisZgradaIndex::where('userId', $userId)->pluck('zgradaId');

        return kvarTiket::select('*', 'kvar_tikets.created_at as crt', 'kvar_tikets.id as ktid', 'kvar_komentar_user_views.broj_vidjenih',
            'kvar_tiket_upravnik_views.prvi_pregled', 'kvar_tiket_upravnik_views.poslednji_pregled', 'kvar_tiket_upravnik_views.broj_pregleda')
        ->leftJoin('kvar_tiket_prioritets', 'kvar_tikets.tiket_prioritetId', '=', 'kvar_tiket_prioritets.id')
        ->leftJoin('kvar_opis_tips', 'kvar_tikets.opis_kvaraId', '=', 'kvar_opis_tips.id')
        ->leftJoin('kvar_komentar_user_views', function($join) use ($userId)
        {
            $join->on('kvar_komentar_user_views.kvar_tiketId', '=', 'kvar_tikets.id');
            $join->on('kvar_komentar_user_views.userId', '=', DB::raw($userId));
        })
        ->leftJoin('kvar_tiket_upravnik_views', function($join) use ($userId)
        {
            $join->on('kvar_tiket_upravnik_views.kvar_tiketId', '=', 'kvar_tikets.id');
            $join->on('kvar_tiket_upravnik_views.userId', '=', DB::raw($userId));
        })
        ->where('kvar_tikets.zgradaId', '=', IzabranaZgrada::getIzabranaZgradaId())
        ->whereIn('kvar_tikets.zgradaId', $zgradaIds)
        ->where('kvar_tikets.tiket_statusId', '<', 3)
        ->orderBy('crt', 'DESC')
        ->paginate(Config::get('global.paginate'), ['*'], 'tik');
    }

    public function render()
    {
        return view('livewire.servis.kvar-prijave-pregled', [
            'data' => $this->read(),
        ]);
    }
}
