<div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
    <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
        <h5 class="text-xl font-medium leading-normal text-surface flex">
        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/></svg>
            <span>Stan br: {{$sbr}}</span>
        </h5>
        <button type="button" class="box-content rounded-none border-none text-neutral-500 hover:text-neutral-800 hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:shadow-none focus:outline-none" wire:click="$dispatch('closeModal')">
            <span class="[&>svg]:h-6 [&>svg]:w-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5"  stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </span>
        </button>
    </div>

    <!-- MODAL BODY -->
    <div class="p-4">
        <div class="py-2 border-b-2 border-neutral-100">
            <p>Stan namena:</p>
            <div class="flex">
                <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700 w-1/2 m-2">
                
                    <input id="bordered-radio-1" wire:model="stan_namena" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white mx-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/></svg>
                    <label for="bordered-radio-1" class="w-full py-4 text-sm font-medium text-gray-900 dark:text-gray-300">Stan</label>
                </div>
                <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700  w-1/2 m-2">
                    <input id="bordered-radio-2" type="radio" wire:model="stan_namena" value="2" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white mx-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 12c.263 0 .524-.06.767-.175a2 2 0 0 0 .65-.491c.186-.21.333-.46.433-.734.1-.274.15-.568.15-.864a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 12 9.736a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 16 9.736c0 .295.052.588.152.861s.248.521.434.73a2 2 0 0 0 .649.488 1.809 1.809 0 0 0 1.53 0 2.03 2.03 0 0 0 .65-.488c.185-.209.332-.457.433-.73.1-.273.152-.566.152-.861 0-.974-1.108-3.85-1.618-5.121A.983.983 0 0 0 17.466 4H6.456a.986.986 0 0 0-.93.645C5.045 5.962 4 8.905 4 9.736c.023.59.241 1.148.611 1.567.37.418.865.667 1.389.697Zm0 0c.328 0 .651-.091.94-.266A2.1 2.1 0 0 0 7.66 11h.681a2.1 2.1 0 0 0 .718.734c.29.175.613.266.942.266.328 0 .651-.091.94-.266.29-.174.537-.427.719-.734h.681a2.1 2.1 0 0 0 .719.734c.289.175.612.266.94.266.329 0 .652-.091.942-.266.29-.174.536-.427.718-.734h.681c.183.307.43.56.719.734.29.174.613.266.941.266a1.819 1.819 0 0 0 1.06-.351M6 12a1.766 1.766 0 0 1-1.163-.476M5 12v7a1 1 0 0 0 1 1h2v-5h3v5h7a1 1 0 0 0 1-1v-7m-5 3v2h2v-2h-2Z"/></svg>
                    <label for="bordered-radio-2" class="w-full py-4 text-sm font-medium text-gray-900 dark:text-gray-300">Lokal</label>
                </div>
            </div>
        </div>

        <div class="py-2 border-b-2 border-neutral-100">
            <p>Sprat:</p>
            <input type="number" wire:model="sprat" id="sprat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/3 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            <div>
                @error('sprat') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
            </div>
        </div>

        <div class="py-2 border-b-2 border-neutral-100">
            <p class="flex">Površina (m<span class="text-xs mb-2">2</span>):</p>
            <input type="number" wire:model="povrsina" id="povrsina" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/3 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            <div>
                @error('povrsina') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
            </div>
        </div>
        <div class="py-2 border-b-2 border-neutral-100">
            <p>Garaže:</p>
            @foreach($garaze as $garaza)
                <div class="flex justify-between bg-teal-50 m-2 p-2" >
                    <div class="flex">
                        <span class="mt-2 mr-2 flex">Garaža površina (m<span class="text-xs mb-2">2</span>) : &nbsp; <span class="font-bold"> {{ $garaza->gpovrsina }}</span> </span>
                        <div class="flex items-center px-2 bg-slate-100 border border-gray-200 rounded dark:border-gray-700 m-2">
                            @if($garaza->stan_namenaId == 3) {{ __('Garaža') }} @else {{ __('Paking mesto') }} @endif
                        </div>
                    </div>
                    <div>
                        <button wire:click="delDbGaraza({{$garaza->id}})" class="p-2 bg-red-700 hover:bg-red-900 text-white rounded mt-1">
                            <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/></svg>
                        </button>
                    </div>
                </div>
            @endforeach

            @php
                $names_index = 0;
            @endphp
            @foreach($nove_garaze as $new_garaza)
                <div class="flex justify-between bg-teal-50 m-2 px-2" >
                    <div class="flex">
                        <span class="mt-2.5 mr-2 flex">Garaža površina (m<span class="text-xs">2</span>): </span>
                        <input type="number" id="" wire:model.live="nove_garaze.{{$names_index}}.povrsina" class="mt-2 border-gray-300 text-gray-900 rounded-lg w-24 h-9" />
                        <div class="flex items-center px-2 bg-slate-50 border border-gray-200 rounded-lg dark:border-gray-700 m-2">
                            <input id="grz{{$names_index}}" type="radio" wire:model.live="nove_garaze.{{$names_index}}.namena" value="3" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                            <label for="grz{{$names_index}}" class="ms-2 py-2 text-sm font-medium text-gray-900 dark:text-gray-300">Garaža</label>
                        </div>
                        <div class="flex items-center px-2 bg-slate-50 border border-gray-200 rounded-lg dark:border-gray-700 m-2">
                            <input id="grzp{{$names_index}}" type="radio" wire:model.live="nove_garaze.{{$names_index}}.namena" value="4" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                            <label for="grzp{{$names_index}}" class="ms-2 py-2 text-sm font-medium text-gray-900 dark:text-gray-300">Paking mesto</label>
                        </div>
                    </div>
                    <div>
                        <button wire:click="delNewGaraza({{$names_index}})" class="p-2 bg-red-700 hover:bg-red-900 text-white rounded mt-1">
                            <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/></svg>
                        </button>
                    </div>
                </div>
                @php
                    $names_index ++;
                @endphp
            @endforeach
            <div class="mb-2">@if($povrsina_error)<span class="text-xs text-red-500">{{$povrsina_error}}</span>@endif</div>
            <div class="my-2">
                <button
                type="button"
                wire:click="addGarazu"
                class="flex ms-1 inline-block rounded bg-teal-700 px-2 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-neutral-200 transition duration-150 ease-in-out  hover:text-white hover:bg-teal-900 hover:shadow-neutral-400 focus:bg-bg-teal-900 focus:shadow-neutral-400 focus:outline-none focus:ring-0 active:bg-teal-900 active:shadow-shadow-neutral-400"
                >
                <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                 <span class="ml-2 mt-1">Dodaj garažu</span>
                </button>
            </div>
        </div>
        
    </div>

    <!-- Modal footer -->
    <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 p-4">
        <button 
          type="button"
          class="mr-4 inline-block rounded bg-neutral-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-700 transition duration-150 ease-in-out hover:bg-neutral-400 hover:text-white focus:bg-neutral-400 focus:outline-none focus:ring-0 active:bg-neutral-400"
          wire:click="$dispatch('closeModal')"
          >
          Otkaži
        </button>
        <button
          type="button"
          wire:click="save"
          class="ms-1 inline-block rounded bg-teal-700 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-neutral-200 transition duration-150 ease-in-out  hover:text-white hover:bg-teal-900 hover:shadow-neutral-400 focus:bg-bg-teal-900 focus:shadow-neutral-400 focus:outline-none focus:ring-0 active:bg-teal-900 active:shadow-shadow-neutral-400"
          >
          Sačuvaj izmene
        </button>
    </div>
</div>
