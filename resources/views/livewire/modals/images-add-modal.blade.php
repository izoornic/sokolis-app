<div class="p-4">
    <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white text-current shadow-4 outline-none">

        <!-- SLIKE PREWIEW-->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @if ($photos) 
                @php
                    $this->validatePhotos();
                @endphp
                @error('photo_p') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                @if(count($this->getPphotos()))
                
                    @php
                    $prewpotos = $this->getPphotos();
                    @endphp
                    @foreach($prewpotos as $photo)
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="{{ $photo->temporaryUrl() }}" alt="">
                    </div>
                    @endforeach
            
                @endif
            @else
            <div class="min-h-60"></div>
            @endif
        </div>

        <div class="p-2 flex justify-between">
            <div class="flex p-2 pb-4 mb-2">
                <div class="flex pb-4">
                    

                    <label for="browse_btn" style="cursor:pointer" class="flex ms-1 inline-block rounded bg-slate-500 px-3 pb-2 pt-2.5 text-base font-medium uppercase leading-normal text-white shadow-neutral-200 hover:text-neutral-700 hover:bg-slate-100 hover:shadow-neutral-400">
                    
                    <svg class="w-6 h-6 text-current dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 19V6a1 1 0 0 1 1-1h4.032a1 1 0 0 1 .768.36l1.9 2.28a1 1 0 0 0 .768.36H16a1 1 0 0 1 1 1v1M3 19l3-8h15l-3 8H3Z"/></svg>    
                    
                    <span>Odaberi slike</span></label>
                    <input id="browse_btn" type="file" wire:model="photos" multiple style="visibility: hidden; height: 2px; width: 150px">
                </div>
            </div>
            <div class="flex p-2 pb-4">
                <button 
                type="button"
                class="flex max-h-11 inline-block rounded bg-neutral-100 text-neutral-700 px-2 pb-2 pt-2.5 text-base font-medium uppercase leading-normal hover:bg-neutral-400 hover:text-white"
                wire:click="clearTempImages"
                >
                <svg class="fill-current w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> <path
                stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                <span>Poništi izbor</span>
                </button>
            </div>
        </div>

              <!-- Modal footer -->
      <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 p-4">
            <button 
            type="button"
            class="inline-block rounded bg-neutral-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-700 transition duration-150 ease-in-out hover:bg-neutral-400 hover:text-white focus:bg-neutral-400 focus:outline-none focus:ring-0 active:bg-neutral-400"
            wire:click="$dispatch('closeModal')"
            >
            Otkaži
            </button>
            <button
            type="button"
            wire:click="savePhotos()"
            class="ms-1 inline-block rounded bg-teal-500 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-neutral-200 transition duration-150 ease-in-out  hover:text-neutral-700 hover:bg-teal-200 hover:shadow-neutral-400 focus:bg-bg-teal-200 focus:shadow-neutral-400 focus:outline-none focus:ring-0 active:bg-teal-200 active:shadow-shadow-neutral-400"
            >
            DODAJ SLIKE
            </button>
      </div>
    </div>
</div>
