<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <button wire:click="$dispatch('openModal', { component: 'modals.tiket-prijava' })" class="mt-2 bg-teal-700 hover:bg-teal-900 text-white font-bold py-2 px-4 border border-teal-600 rounded flex">
            <svg class="fill-current w-4 h-4 mr-2 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 384"><path d="M576,208V128a64,64,0,0,0-64-64H64A64,64,0,0,0,0,128v80a48,48,0,0,1,48,48A48,48,0,0,1,0,304v80a64,64,0,0,0,64,64H512a64.06,64.06,0,0,0,64-64V304a48,48,0,0,1,0-96ZM438,286.5H318.5V406h-61V286.5H138v-61H257.5V106h61V225.5H438Z" transform="translate(0 -64)"/></svg>
            {{ __('Nova prijava') }}
        </button>
    </div>
    @if(Session::has('status'))

    <div class="w-full">
        <div id="toast-success" class="mx-auto flex items-center w-full max-w-lg p-4 mb-4 text-gray-800 bg-green-50 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-50 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{session('status')}}</div>
            <button wire:click="closeAlert" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-gray-800 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </div>
    @endif
    {{-- The data table --}}
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200" style="width: 100% !important">
                        <thead>
                            <tr>
                                <th class="px-2 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Br:</th>
                                <th class="px-2 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Datum</th>
                                <th class="py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-2 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Vrsta</th>
                                <th class="px-2 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Opis</th>
                                <th class="px-2 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path fill="currentColor" d="M16 18H8l2.5-6 2 4 1.5-2 2 4Zm-1-8.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"/><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 18h8l-2-4-1.5 2-2-4L8 18Zm7-8.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"/></svg>
                                </th>
                                <th class="px-2 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Prioritet</th>
                                <th class="px-2 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" /></svg>
                                </th>
                                <th class="px-2 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase"> :: </th>
                            </tr>
                        </thead>


                        
                        <tbody class="bg-white divide-y divide-gray-200">                           
                            @if ($data->count())
                                @foreach ($data as $item)
                                    @php
                                     if(!$item->broj_vidjenih) $item->broj_vidjenih = 0;
                                     $br_novih = $item->tiket_br_komentara - $item->broj_vidjenih;
                                    @endphp
                                    <tr class="@if($item->tstid == 3) bg-emerald-50 @endif">
                                        <td class="px-2 py-2">#{{ $item->ktid }}</td>
                                        <td >{{ App\Http\TimeFormatHelper::datumFormat($item->crt)}}</td>
                                        <td class="text-center">
                                                @if($item->tiket_statusId == 1) 
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                                                @else 
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-auto"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                                                @endif
                                        </td>
                                        <td><span class="px-2">{{$item->kvar_tip_naziv}} </span></td>
                                        <td class="px-2 pr-2 max-w-64"><span class="px-2">{{Illuminate\Support\Str::limit($item->opis, 40, '...')}} </span></td>
                                        <td class="text-center">{{$item->broj_slika}}</td>
                                        <td class="px-2 pr-2"><span class="font-bold text-{{$item->prioritet_txt_collor}}">{{ $item->prioritet_naziv }}</span></td>
                                        <td class="text-center relative">{{ $item->tiket_br_komentara }} 
                                            @if($br_novih)    
                                                <span class="p-0.5 text-white bg-red-500 rounded-xl absolute top-1 right-1" style="font-size: 0.75rem; line-height: 0.75rem;">+{{$br_novih}}</span>
                                            @endif
                                        </td>                           
                                        <td class="px-2 pr-2">
                                            <a href="/kvar-pregled?tid={{$item->ktid}}" class="my-1 bg-neutral-400 hover:bg-neutral-600 text-white font-bold py-1 px-2 border border-neutral-600 rounded flex">
                                                <svg class="float-left fill-current w-4 h-4 mr-2 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M128 160H448V352H128V160zM512 64C547.3 64 576 92.65 576 128V208C549.5 208 528 229.5 528 256C528 282.5 549.5 304 576 304V384C576 419.3 547.3 448 512 448H64C28.65 448 0 419.3 0 384V304C26.51 304 48 282.5 48 256C48 229.5 26.51 208 0 208V128C0 92.65 28.65 64 64 64H512zM96 352C96 369.7 110.3 384 128 384H448C465.7 384 480 369.7 480 352V160C480 142.3 465.7 128 448 128H128C110.3 128 96 142.3 96 160V352z"/></svg>
                                                    {{ __('Pregled') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else 
                                <tr>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">Trenutno nema prijava kvarova!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="hidden">
            <p class="text-red-800">gg</p>
            <p class="text-yellow-600">gg</p>
            <p class="text-teal-600">gg</p>
        </div>
    </div>
    
    <div class="mt-5">
    {{ $data->links() }}
    </div>


   
</div>
