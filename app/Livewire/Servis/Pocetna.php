<?php

namespace App\Livewire\Servis;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Zgrada;
use App\Models\KvarTiketPrioritet;
use App\Models\kvarTiket;
use App\Models\ServisZgradaIndex;
use Illuminate\Support\Facades\DB;

class Pocetna extends Component
{
    public function goToPage(int $zgradaId)
    {
        $zgrada = Zgrada::findOrFail($zgradaId);
        session(['upravnik_izabrana_zgrada_id' => $zgrada->id]);
        session(['upravnik_izabrana_zgrada_name' => $zgrada->naziv]);
        $this->dispatch('promenjenaZgrada');
        return $this->redirect('/servis-kvarovi', navigate: true);
    }

    #[On('promenjenaZgrada')]
    public function refreshMe()
    {
        $this->render();
    }

    public function render()
    {
        $userId = auth()->user()->id;

        $zgradaIds = ServisZgradaIndex::where('userId', $userId)->pluck('zgradaId');

        $zgrade = Zgrada::whereIn('id', $zgradaIds)
            ->orderBy('naziv')
            ->get();

        $kvaroviRaw = kvarTiket::select('zgradaId', 'tiket_prioritetId', DB::raw('COUNT(*) as broj'))
            ->whereIn('zgradaId', $zgradaIds)
            ->where('tiket_statusId', '<', 3)
            ->groupBy('zgradaId', 'tiket_prioritetId')
            ->get();

        $kvarovi = [];
        foreach ($kvaroviRaw as $k) {
            $kvarovi[$k->zgradaId][$k->tiket_prioritetId] = $k->broj;
        }

        $prioriteti = KvarTiketPrioritet::all();

        // Prijave koje servis jos nije otvorio, po zgradi
        $nepregledaniKvaroviRaw = DB::table('kvar_tikets as kt')
            ->selectRaw('kt.zgradaId, COUNT(*) as nepregledani')
            ->leftJoin('kvar_tiket_upravnik_views as ktv', function ($join) use ($userId) {
                $join->on('ktv.kvar_tiketId', '=', 'kt.id')
                     ->where('ktv.userId', '=', $userId);
            })
            ->whereIn('kt.zgradaId', $zgradaIds)
            ->where('kt.tiket_statusId', '<', 3)
            ->whereNull('ktv.prvi_pregled')
            ->groupBy('kt.zgradaId')
            ->pluck('nepregledani', 'zgradaId');

        // Nevidjeni komentari na otvorenim prijavama, po zgradi
        $nevidjeniKvaroviRaw = DB::table('kvar_tikets as kt')
            ->selectRaw('kt.zgradaId, SUM(kt.tiket_br_komentara - COALESCE(kv.broj_vidjenih, 0)) as nevidjeni')
            ->leftJoin('kvar_komentar_user_views as kv', function ($join) use ($userId) {
                $join->on('kv.kvar_tiketId', '=', 'kt.id')
                     ->where('kv.userId', '=', $userId);
            })
            ->whereIn('kt.zgradaId', $zgradaIds)
            ->where('kt.tiket_statusId', '<', 3)
            ->groupBy('kt.zgradaId')
            ->pluck('nevidjeni', 'zgradaId');

        return view('livewire.servis.pocetna', [
            'zgrade'              => $zgrade,
            'kvarovi'             => $kvarovi,
            'prioriteti'          => $prioriteti,
            'nepregledaniKvarovi' => $nepregledaniKvaroviRaw,
            'nevidjeniKvarovi'    => $nevidjeniKvaroviRaw,
        ]);
    }
}
