<div class="my-2">
    <div class="mx-2 my-2">
        @if($tip == 'vazno')
            <div class="bg-slate-50 border-t-4 border-red-400 rounded-b text-neutral-600 shadow-md mb-6 pb-2">   
        @elseif($tip == 'obavestenje')
            <div class="bg-slate-50 border-t-4 border-green-500 rounded-b text-neutral-600 shadow-md mb-6 pb-2">  
        @else
            <div class="bg-slate-50 border-t-4 border-yellow-500 rounded-b text-neutral-600 shadow-md mb-6 pb-2">  
        @endif 

        @if($tip == 'vazno')
            <div class="bg-red-100 text-lg font-bold px-4 py-3 flex justify-between">
        @elseif($tip == 'obavestenje')
            <div class="bg-green-100 text-lg font-bold px-4 py-3 flex justify-between">
        @else
            <div class="bg-yellow-100 text-lg font-bold px-4 py-3 flex justify-between">
        @endif

                <div class="flex">
                    <span>
                        <svg class="fill-current w-4 h-4 mr-2 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z"/></svg>
                    </span>
                    <span class="text-base mr-2 mt-0.5">{{App\Http\TimeFormatHelper::datumFormat($ob_datum)}} </span>
                    <span class="ml-4 uppercase">  {{ $naslov }}</span>
                </div>

                <div class="flex">
                        @if($tip == 'vazno')
                            <span class="text-base text-red-500 mr-2">važno</span>
                            <svg class="fill-red-500 w-4 h-4 mt-1 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/></svg>
                        @elseif($tip == 'obavestenje')
                            <span class="text-base text-green-900 mr-2">obaveštenje</span>
                            <svg class="fill-green-900 w-4 h-4 mt-1 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M480 32c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9L381.7 53c-48 48-113.1 75-181 75l-8.7 0-32 0-96 0c-35.3 0-64 28.7-64 64l0 96c0 35.3 28.7 64 64 64l0 128c0 17.7 14.3 32 32 32l64 0c17.7 0 32-14.3 32-32l0-128 8.7 0c67.9 0 133 27 181 75l43.6 43.6c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6l0-147.6c18.6-8.8 32-32.5 32-60.4s-13.4-51.6-32-60.4L480 32zm-64 76.7L416 240l0 131.3C357.2 317.8 280.5 288 200.7 288l-8.7 0 0-96 8.7 0c79.8 0 156.5-29.8 215.3-83.3z"/></svg>
                        @else
                            <span class="text-base text-yellow-500 mr-2">informacija</span>
                            <svg class="fill-yellow-500 w-4 h-4 mt-1 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24l0 112c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-112c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>
                        @endif
                    </div>
                </div>
                <div class="bg-slate-100 px-4 text-right">
                    @foreach(App\Models\ObavestenjeZgradaIndex::getZgradeObavestenja($o_id) as $zgrada)
                        {{ $zgrada }} &nbsp; &nbsp;
                    @endforeach
                </div>  
                <div class="">
                    
                    <div class="p-4 text-base text-xl leading-7 text-gray-700">

                        <p> {!! html_entity_decode($textdisp) !!}</p>

                        @if(count($ob_links))
                        <div class="flex mt-2">
                            @foreach($ob_links as $oblink)
                                <button id="{{$oblink->id}}" class="my-1 mx-2 bg-neutral-400 hover:bg-neutral-600 text-white text-sm py-2 px-2 rounded flex" wire:click="getAttDocument({{$oblink->id}})">
                                    {{ $oblink->ob_link_tekst }}
                                </button>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @if($upravnik)
                    <div class="px-4 flex">
                        <button wire:click="editObavestenje({{$o_id}})" class="bg-teal-700 hover:bg-teal-900 text-white font-bold px-2 rounded flex">
                            <svg class="w-4 h-4 mt-1 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/></svg>    
                            Izmeni
                        </button>
                        <button wire:click="deleteObavestenje({{$o_id}})" class="bg-red-400 hover:bg-red-700 text-white font-bold px-2 rounded flex ml-4">
                            <svg class="w-4 h-4 mt-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>

                            Obriši
                        </button>
                    </div>
                    @endif
                    @php
                        if($koments_seen == '') $koments_seen=0;
                    @endphp
                    <div class="p-2 text-right">
                        <a class="cursor-pointer" wire:click="ShowComments({{$o_id}})">Komentari ( {{$koments_br}} ) @if( $koments_br > 0 &&  $koments_br > $koments_seen ) <span class="p-1 text-xs text-white bg-teal-600 rounded-xl">+{{$koments_br - $koments_seen}}</span>@endif</a>
                    </div>
                </div>
                @if($show_koments)
                <div class="relative w-full">
                    <div class="bg-white border-t-4 border-slate-500 rounded-b text-slate-900 px-4 py-3 max-w-lg mx-2 ml-auto" role="alert">
                        <div class="flex">
                            <div class="py-1"><svg class="fill-slate-400 w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M416 176C416 78.8 322.9 0 208 0S0 78.8 0 176c0 39.57 15.62 75.96 41.67 105.4c-16.39 32.76-39.23 57.32-39.59 57.68c-2.1 2.205-2.67 5.475-1.441 8.354C1.9 350.3 4.602 352 7.66 352c38.35 0 70.76-11.12 95.74-24.04C134.2 343.1 169.8 352 208 352C322.9 352 416 273.2 416 176zM599.6 443.7C624.8 413.9 640 376.6 640 336C640 238.8 554 160 448 160c-.3145 0-.6191 .041-.9336 .043C447.5 165.3 448 170.6 448 176c0 98.62-79.68 181.2-186.1 202.5C282.7 455.1 357.1 512 448 512c33.69 0 65.32-8.008 92.85-21.98C565.2 502 596.1 512 632.3 512c3.059 0 5.76-1.725 7.02-4.605c1.229-2.879 .6582-6.148-1.441-8.354C637.6 498.7 615.9 475.3 599.6 443.7z"/></svg></div>
                            <div class="w-full">
                                <div class="flex justify-between">
                                    <div class="mt-2 font-bold">Komentari:</div>
                                    <div class="font-light">{{$koments_br}}</div>
                                </div>
                            </div>
                        </div>
                    

                        @if(count($komentari))
                            @foreach($komentari as $komentar)
                                <div class="bg-slate-100 rounded-lg my-2 mb-4">
                                    <div class="py-2">
                                            <svg class="float-left fill-slate-500 w-4 h-4 ml-2 mr-2 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"/></svg>
                                            <span class="font-bold text-sm text-slate-500">{{ $komentar->name }}</span> <span class="text-sm text-slate-500 ml-4"> {{ App\Http\TimeFormatHelper::datumFormat($komentar->created_at) }}</span>
                                            <div class="text-lg text-slate-700 px-2 ml-10">{{ $komentar->komentar }}</div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="relative w-full">
                            <div class="mt-4 ml-auto">
                                <p class="text-slate-600 text-lg">Dodaj komentar:</p>
                                <textarea wire:model="new_coment" class="border border-slate-400 rounded-lg w-full" id="novi_komentar" type="textarea" class="mt-1 block w-full disabled:opacity-50"></textarea>
                                <p class="text-right">
                                    <button wire:click="addComment()" class="mt-2 bg-slate-400 hover:bg-slate-700 text-white font-bold py-2 px-4 border border-slate-600 rounded">Pošalji</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
    </div>

</div>