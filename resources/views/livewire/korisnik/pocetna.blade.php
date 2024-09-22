<div class="p-6">
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
