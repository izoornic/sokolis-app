<div class="my-2">
    <div class="mx-2 my-2">
        <div class="bg-slate-50 border-t-4 border-gray-500 rounded-b text-neutral-600 shadow-md mb-6 pb-2"> 
            <div class="bg-gray-200 text-lg font-bold px-4 py-3 flex justify-between">
                <div class="flex">
                    <span>
                        <svg class="fill-current w-4 h-4 mr-2 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z"/></svg>
                    </span>
                    <span class="text-base mr-2 mt-0.5">{{App\Http\TimeFormatHelper::datumFormat($ob_datum)}} </span>
                    <span class="ml-4 uppercase">  {{ $naslov }}</span>
                </div>
            </div>
            <div class="bg-slate-100 px-4 text-right">
                @foreach(App\Models\SzObavestenjeZgradaIndex::getZgradeObavestenja($o_id) as $zgrada)
                    {{ $zgrada }} &nbsp; &nbsp;
                @endforeach
            </div>
            <div class="">  
                <div class="p-4 text-base text-xl leading-7 text-gray-700">
                    <p> {!! html_entity_decode($textdisp) !!}</p>
                </div>
            </div>
                @if(count($ob_links))
                        <div class="flex mt-2">
                            @foreach($ob_links as $oblink)
                                <a id="{{$oblink->id}}" class="my-1 mx-2 bg-neutral-400 hover:bg-neutral-600 text-white text-sm py-2 px-2 rounded flex" href="{{$oblink->url}}" target="_blanck">
                                    {{ $oblink->sz_link_text }}
                                </a>
                            @endforeach
                        </div>
                        @endif
                @if($upravnik)
                <div class="px-4 flex">
                    <button wire:click="editSzObavestenje({{$o_id}})" class="bg-teal-700 hover:bg-teal-900 text-white font-bold px-2 rounded flex">
                        <svg class="w-4 h-4 mt-1 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/></svg>    
                        Izmeni
                    </button>
                    <button wire:click="deleteSzObavestenje({{$o_id}})" class="bg-red-400 hover:bg-red-700 text-white font-bold px-2 rounded flex ml-4">
                        <svg class="w-4 h-4 mt-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>

                        Obriši
                    </button>
                </div>
            @endif

            
        </div>
    </div>
</div>
