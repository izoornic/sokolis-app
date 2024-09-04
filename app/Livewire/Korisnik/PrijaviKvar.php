<?php

namespace App\Livewire\Korisnik;

use Auth;

use App\Models\kvarTiket;
use App\Models\KvarTiketPrioritet;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Config;

use App\Http\TimeFormatHelper;

class PrijaviKvar extends Component
{
    use WithPagination;

    public function read()
    {
        return kvarTiket::select('*', 'kvar_tikets.created_at as crt')
        ->leftJoin('kvar_tiket_prioritets', 'kvar_tikets.tiket_prioritetId', '=', 'kvar_tiket_prioritets.id')
        ->leftJoin('opis_kvara_tips', 'kvar_tikets.opis_kvaraId', '=', 'opis_kvara_tips.id')
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
