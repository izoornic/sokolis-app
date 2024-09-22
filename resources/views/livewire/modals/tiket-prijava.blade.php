<div>
    <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
      <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
        <h5 class="text-xl font-medium leading-normal text-surface">
         Prijava kvara
        </h5>
        <button type="button"
          class="box-content rounded-none border-none text-neutral-500 hover:text-neutral-800 hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:shadow-none focus:outline-none"
          wire:click="$dispatch('closeModal')"
          >
          <span class="[&>svg]:h-6 [&>svg]:w-6">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12" />
            </svg>
          </span>
        </button>
      </div>

      <!-- Modal body --> 
      <div class="relative flex-auto p-4">
        <!-- ODABIR STANA -->
        <div class="p-2 pb-4 mb-2 border-b border-slate-300"> 
          <div class="w-96">
          @if($ima_vise_stanova)
            <p class="text-slate-600 text-lg">Odaberi stan:</p>
            <select wire:model="odabrani_stan" id="" class="block appearance-none bg-white w-full border border-1 text-gray-700 py-3 px-4 pr-8 round leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              @foreach (App\Models\Stan::stanoviKorisnika($stanovi_lista) as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
              @endforeach
            </select> 
          @else
            <p class="text-slate-600 text-lg">Prijava za stan:</p>
            <p class="text-slate-800 text-lg">
              @foreach (App\Models\Stan::stanoviKorisnika($stanovi_lista) as $key => $value)
                {{ $value }}
              @endforeach   
           </p>
          @endif
          </div>
        </div>

        <!-- VRSTA KVARA -->
        <div class="p-2 pb-4 mb-2 border-b border-slate-300">
         <div class="w-96">
            <p class="text-slate-600 text-lg">Odaberi vrstu kvara:</p>
            <select wire:model="vrsta_kvara" id="" class="block appearance-none bg-white w-full border border-1 text-gray-700 py-3 px-4 pr-8 round leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                  <option value="">---</option>     
            @foreach (App\Models\KvarOpisTip::tipoviKvara() as $key => $value)    
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select> 
            <div>
                @error('vrsta_kvara') <span class="text-xs text-red-500">Vrsta kvara je obavezna!</span> @enderror 
            </div>
          </div> 
        </div>

        <!-- OPIS KVARA -->
        <div class="p-2 pb-4 mb-2 border-b border-slate-300">
          <p class="text-slate-600 text-lg">Opis kvara:</p>
          <textarea wire:model="kvar_opis" class="border border-slate-400 rounded-lg w-full" id="novi_komentar" type="textarea" class="mt-1 block w-full disabled:opacity-50"></textarea>
          <div>
              @error('kvar_opis') <span class="text-xs text-red-500">Opis kvara je obavezan!</span> @enderror 
          </div>  
        </div>
        
        <!-- SLIKE -->
        @if (!$photos)
        <div class="p-2 pb-4 mb-2 border-b border-slate-300">
          <div class="flex pb-4">
          <label for="browse_btn" style="cursor:pointer" class="ms-1 inline-block rounded bg-slate-500 px-6 pb-2 pt-2.5 text-base font-medium uppercase leading-normal text-white shadow-neutral-200 hover:text-neutral-700 hover:bg-slate-100 hover:shadow-neutral-400">Dodja slike: </label>
          <input id="browse_btn" type="file" wire:model="photos" multiple style="visibility: hidden; height: 2px; width: 150px">
        </div>
        @endif
         
          
        <!-- SLIKE PREWIEW-->
        @if ($photos) 
          @php
            $this->validatePhotos();
          @endphp
          @error('photo_p') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
          @if(count($this->getPphotos()))
          <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @php
              $prewpotos = $this->getPphotos();
            @endphp
            @foreach($prewpotos as $photo)
            <div>
                <img class="h-auto max-w-full rounded-lg" src="{{ $photo->temporaryUrl() }}" alt="">
            </div>
            @endforeach
          </div>
          @endif
          <div class="p-2 flex flex-shrink-0 justify-end">
              <button 
              type="button"
              class="flex inline-block rounded bg-neutral-100 text-neutral-700 px-2 pb-2 pt-2.5 text-base font-medium uppercase leading-normal hover:bg-neutral-400 hover:text-white"
              wire:click="clearTempImages"
              >
              <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> <path
                stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
              Poništi izbor
            </button>
          </div>
        @endif
        </div>

        <!-- PRIORITET -->
        <div class="p-2 pb-4 mb-2">
            <p class="text-slate-600 text-lg">Odredi prioritet:</p>
            <div class="flex mt-4 mb-2">
                @foreach (App\Models\KvarTiketPrioritet::prList() as $value)
                    @if($kvar_prioritet == $value->id)
                        <span class="flex-none py-2 px-4 mx-2 font-bold rounded bg-{{$value->prioritet_txt_collor}} text-white">{{ $value->prioritet_naziv }}</span>
                    @else
                        <button wire:click="$set('kvar_prioritet', {{ $value->id }})" class="flex-none bg-{{ $value->prioritet_bg_collor }} hover:bg-{{$value->prioritet_bg_hower_collor}} text-{{$value->prioritet_txt_collor}} font-bold py-2 px-4 rounded mx-2">
                            {{ $value->prioritet_naziv }}
                        </button>
                    @endif
                @endforeach
            </div>
            <div>
                @error('kvar_prioritet') <span class="text-xs text-red-500">Odaberi prioritet</span> @enderror 
            </div>
            <div class="flex mt-4" style="display:none">
                    <button class="flex-none bg-red-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded mx-2">
                        <span class="bg-red-800 border-red-500 fill-red-500 text-red-800">TEST</span>
                    </button>
                    <button class="flex-none bg-orange-500 hover:bg-orange-200 text-white font-bold py-2 px-4 rounded mx-2">
                        <span class="bg-yellow-600 border-orange-500 fill-orange-500 text-yellow-600">TEST</span>
                    </button>
                    <button class="flex-none bg-yellow-500 hover:bg-yellow-200 text-white font-bold py-2 px-4 rounded mx-2">
                        <span class="bg-teal-600 border-yellow-500 fill-yellow-500 text-teal-600">TEST</span>
                    </button>
                    <button class="flex-none bg-red-50 hover:bg-red-200 text-white font-bold py-2 px-4 rounded mx-2">
                        <span class="bg-teal-50 border-green-500 fill-green-500 text-green-500">TEST</span>
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
          wire:click="saveTiket"
          class="ms-1 inline-block rounded bg-teal-500 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-neutral-200 transition duration-150 ease-in-out  hover:text-neutral-700 hover:bg-teal-200 hover:shadow-neutral-400 focus:bg-bg-teal-200 focus:shadow-neutral-400 focus:outline-none focus:ring-0 active:bg-teal-200 active:shadow-shadow-neutral-400"
          >
          Prijavi kvar
        </button>
      </div>
    </div>
</div>