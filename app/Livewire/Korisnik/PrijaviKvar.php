<?php

namespace App\Livewire\Korisnik;

use Auth;

use App\Models\kvarTiket;
use App\Models\KvarTiketPrioritet;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

use App\Http\TimeFormatHelper;
use App\Models\Stan;
use App\Models\User;
use App\Models\Zgrada;

class PrijaviKvar extends Component
{
    use WithPagination;

    public $user_zids;

    public function mount()
    {
        if(!session()->exists(['stanovi', 'zgrade'])){
            User::getMyZgradeStanove();
        }
        $this->user_zids = session()->only(['stanovi', 'zgrade']);
    }

    public function closeAlert()
    {
        if(session()->has('status')) session()->flash('status');
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
        ->whereIn('kvar_tikets.zgradaId', $this->user_zids['zgrade'])
        ->where(function ($query) {
            $query->where('kvar_tikets.userId', '=', auth()->user()->id)
                  ->orWhere('kvar_tikets.vidljiv_zgradi', '=', 1);
        })
        ->where('kvar_tikets.tiket_statusId', '<', 3)
        ->orderBy('crt', 'DESC')
        ->paginate(Config::get('global.paginate'), ['*'], 'tik');

    }

    public function render()
    {
        return view('livewire.korisnik.prijavi-kvar', [
            'data' => $this->read(),
        ]);
    }
}
