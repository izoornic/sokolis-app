<?php

namespace App\Livewire\Upravnik;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Zgrada;
use App\Models\KvarTiketPrioritet;
use App\Models\kvarTiket;
use App\Models\UpravnikZgradaIndex;
use Illuminate\Support\Facades\DB;

class Pocetna extends Component
{
    public function mount()
    {
        //
    }

    public function goToPage(int $zgradaId, string $page)
    {
        $zgrada = Zgrada::findOrFail($zgradaId);
        session(['upravnik_izabrana_zgrada_id' => $zgrada->id]);
        session(['upravnik_izabrana_zgrada_name' => $zgrada->naziv]);
        $this->dispatch('promenjenaZgrada');
        return $this->redirect($page, navigate: true);
    }

    #[On('promenjenaZgrada')]
    public function refreshMe()
    {
        $this->render();
    }

    public function render()
    {
        $zgradaIds = UpravnikZgradaIndex::where('userId', auth()->user()->id)->pluck('zgradaId');

        $zgrade = Zgrada::whereIn('id', $zgradaIds)
            ->withCount('stanovi')
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

        $userId = auth()->user()->id;

        // Unseen kvar comments per building (open tickets only)
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

        // Unseen obavestenje comments per building
        $nevidjeniObavestenjaRaw = DB::table('obavestenjas as o')
            ->selectRaw('ozi.zgradaId, SUM(o.ob_broj_komentara - COALESCE(okv.broj_vidjenih, 0)) as nevidjeni')
            ->join('obavestenje_zgrada_indices as ozi', 'ozi.obavestenjeId', '=', 'o.id')
            ->leftJoin('obavestenja_komentar_user_viewds as okv', function ($join) use ($userId) {
                $join->on('okv.obavestenjeId', '=', 'o.id')
                     ->where('okv.userId', '=', $userId);
            })
            ->whereIn('ozi.zgradaId', $zgradaIds)
            ->groupBy('ozi.zgradaId')
            ->pluck('nevidjeni', 'zgradaId');

        return view('livewire.upravnik.pocetna', [
            'zgrade'               => $zgrade,
            'kvarovi'              => $kvarovi,
            'prioriteti'           => $prioriteti,
            'nevidjeniKvarovi'     => $nevidjeniKvaroviRaw,
            'nevidjeniObavestenja' => $nevidjeniObavestenjaRaw,
        ]);
    }
}
