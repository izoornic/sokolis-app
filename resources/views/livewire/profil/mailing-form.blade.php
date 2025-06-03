<x-action-section>
    <x-slot name="title">
        {{ __('Podašavanja za e-mail obaveštenja') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Odredite kategorije za koje želite da dobijate e-mail obaveštenja kada na portalu dođe do promene.') }}
    </x-slot>

    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4 mb-5">
            <h3 class="text-lg font-medium text-gray-900 ">
                {{ __('Kategorije za koje želim da dobijam e-mail obaveštenja') }}
            </h3>
        </div>
        @foreach ($data as $kategorija)
            <div class="col-span-6 sm:col-span-4 px-4 mb-4">
                <p class="text-base mb-3"><strong>{{ $kategorija['naziv'] }}</strong> ( {{ $kategorija['opis'] }} )</p>
                @foreach ($kategorija['tipovi'] as $podkategorija)
                    @if($podkategorija['uvek_ukljucen']) 
                        <label class="ms-2 inline-flex items-center me-5 cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer"  checked disabled >
                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-teal-300 dark:peer-focus:ring-teal-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-500 dark:peer-checked:bg-teal-200"></div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $podkategorija['naziv'] }} ( {{$podkategorija['opis']}} )</span>
                    @else
                        <label class="ms-2 inline-flex items-center me-5 cursor-pointer">
                            <input type="checkbox" value="{{$podkategorija['id']}}" class="sr-only peer" wire:model="korisnik_obavestenja"  >
                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-teal-300 dark:peer-focus:ring-teal-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-teal-600 dark:peer-checked:bg-teal-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $podkategorija['naziv'] }} ( {{$podkategorija['opis']}} )</span>
                        </label><br />
                    @endif 
                @endforeach
                
            </div>
        @endforeach

        <x-button wire:loading.attr="disabled" wire:click="save()">
            {{ __('Sačuvaj') }}
        </x-button>

        <!-- Uspesno ste promenili podesavanja] -->
        <x-dialog-modal wire:model.live="confirmingMailObavestenja">
            <x-slot name="title">
                {{ __('Podešavanja sačuvana') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Uspešno ste sačuvali podešavanja vezana za e-mail obaveštenja.') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingMailObavestenja')" wire:loading.attr="disabled">
                    {{ __('Nazad') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>

    
</x-action-section>

