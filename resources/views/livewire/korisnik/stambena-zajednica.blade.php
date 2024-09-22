<div class="p-6">
    @foreach($data as $obavestenje)
        <livewire:korisnik.komponente.sz-obavestenje 
                o_id="{{ $obavestenje->oid }}" 
                tip="{{ $obavestenje->ob_tip_naziv }}" 
                naslov="{{ $obavestenje->sz_ob_naslov }}" 
                textdisp="{{ $obavestenje->sz_ob_text }}"
                ob_datum="{{ $obavestenje->obv_date }}" 
                />
    @endforeach
    <div class="mt-5">
        {{ $data->links() }}
    </div>
</div>
