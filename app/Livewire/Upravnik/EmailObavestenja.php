<?php

namespace App\Livewire\Upravnik;

use Livewire\Component;
use App\Models\EmailObavestenjaLog;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

use App\Models\Zgrada;

use Livewire\Attributes\On;

class EmailObavestenja extends Component

{
    /**
     * @var mixed
     * 
     * 
     */
    public function read()
    {

        return EmailObavestenjaLog::select('email_obavestenja_logs.id', 'subject', 'email_obavestenja_logs.created_at', 'email_obavestenja_tips.naziv as tip')
            ->leftJoin('email_obavestenja_tips', 'email_obavestenja_tips.id', '=', 'email_obavestenja_logs.email_obavestenja_tip_id')
            ->withCount('zgrade')
            ->withCount('stanari')
            ->orderBy('created_at', 'DESC')
            ->paginate(Config::get('global.paginate'));
    }

    public function NovoObavestenje()
    {
        $this->redirect('/email-obavestenje-novo');
    }

    public function NoviRacun()
    {
        $this->redirect('/racun-obavestenje');
    }

    public function render()
    {
        return view('livewire.upravnik.email-obavestenja', [
            'data' => $this->read(),
        ]);
    }
}
