<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <button wire:click="novoObavestenje()" class="mt-2 bg-teal-700 hover:bg-teal-900 text-white font-bold py-2 px-4 border border-teal-600 rounded flex">  
        <svg class="w-6 h-6 mr-2 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path fill="currentColor" d="M4 9.05H3v2h1v-2Zm16 2h1v-2h-1v2ZM10 14a1 1 0 1 0 0 2v-2Zm4 2a1 1 0 1 0 0-2v2Zm-3 1a1 1 0 1 0 2 0h-2Zm2-4a1 1 0 1 0-2 0h2Zm-2-5.95a1 1 0 1 0 2 0h-2Zm2-3a1 1 0 1 0-2 0h2Zm-7 3a1 1 0 0 0 2 0H6Zm2-3a1 1 0 1 0-2 0h2Zm8 3a1 1 0 1 0 2 0h-2Zm2-3a1 1 0 1 0-2 0h2Zm-13 3h14v-2H5v2Zm14 0v12h2v-12h-2Zm0 12H5v2h14v-2Zm-14 0v-12H3v12h2Zm0 0H3a2 2 0 0 0 2 2v-2Zm14 0v2a2 2 0 0 0 2-2h-2Zm0-12h2a2 2 0 0 0-2-2v2Zm-14-2a2 2 0 0 0-2 2h2v-2Zm-1 6h16v-2H4v2ZM10 16h4v-2h-4v2Zm3 1v-4h-2v4h2Zm0-9.95v-3h-2v3h2Zm-5 0v-3H6v3h2Zm10 0v-3h-2v3h2Z"/></svg>
            {{ __('Dodaj obaveštenje') }}
        </button>
    </div>
    <livewire:upravnik.komponente.session-flash-message />

    @foreach($data as $obavestenje)
        <livewire:korisnik.komponente.obavestenje 
                o_id="{{ $obavestenje->oid }}" 
                tip="{{ $obavestenje->ob_tip_naziv }}" 
                naslov="{{ $obavestenje->ob_naslov }}" 
                textdisp="{{ $obavestenje->ob_text }}"
                ob_datum="{{ $obavestenje->obv_date }}" 
                koments_br="{{ $obavestenje->ob_broj_komentara }}"
                koments_seen="{{ $obavestenje->broj_vidjenih }}"
                />
    @endforeach
    <div class="mt-5">
        {{ $data->links() }}
    </div>
</div>