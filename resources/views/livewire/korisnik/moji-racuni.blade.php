<div class="p-6">
    @if(count($stanovi_lista) > 1)
    <div class="flex justify-end px-4 py-3 sm:px-6">
        <div class="">
            <label class="" for="izabrani_stan">Odaberi stan</label>
            <select wire:model.live="izabrani_stan" id="izabrani_stan" class=" block appearance-none bg-white border rounded-md text-gray-700 py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                @foreach (App\Models\Stan::stanoviKorisnika($stanovi_lista) as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif
   
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200" style="width: 100% !important">
                        <thead>
                            <tr>
                                <th class="pl-2 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Zaduženje za</th>
                                <th class="py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Zaduženo</th>
                                <th class="py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Datum</th>
                                <th class="py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Razduženo</th>
                                <th class="py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Datum</th>
                                <th class="py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Saldo</th>
                                <th class="py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Račun</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if (count($data))
                                @foreach ($data as $item)
                                    @if($item['stari_dug'] < 2)
                                        <tr>
                                            <td class="pl-2 py-2"><span class="text-gray-600">@if($item['stari_dug'] == 0){{$item['m_naziv']}} '{{$item['y_no']}}.@else Stari dug @endif</span></td>
                                            <td class="py-2">{{$item['zaduzeno']}}</td>
                                            <td class="py-2"><span class="text-gray-600">{{$item['datum']}}</span></td>
                                            <td class="py-2">{{$item['razduzeno']}}</td>
                                            <td class="py-2"><span class="text-gray-600">{{$item['r_date']}}</span></td>
                                            <td class="py-2">
                                                <span class="flex">
                                                    @if($item['saldo_sign'] == 0)
                                                        <svg class="w-5 h-5 mr-1 mt-0.5 text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                                    @elseif($item['saldo_sign'] == 1)
                                                        <svg class="w-5 h-5 mr-1 mt-0.5 text-red-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                                    @else
                                                        <svg class="w-5 h-5 mr-1 mt-0.5 text-sky-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                                    @endif
                                                    {{$item['saldo']}}
                                                </span>
                                            </td>
                                            <td class="px-1 py-2">
                                                @if($item['stari_dug'] == 0)
                                                    <a target="_blanck" href="{{$pdf_link}}{{$item['rkv']}}">
                                                        <div class="py-0.5 max-w-8 border rounded-md border-amber-700 text-amber-700 bg-amber-100 hover:text-amber-100 hover:bg-amber-700">
                                                            <svg class="w-6 h-6 mx-auto text-current dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z"/></svg>
                                                        </div>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @else 
                                        <tr class="bg-gray-100">
                                            <td class="pl-2 py-2">Ukupno</td>
                                            <td class="py-2"><span class="font-bold">{{$item['zaduzeno']}}</span></td>
                                            <td class="py-2"></td>
                                            <td class="py-2"><span class="font-bold">{{$item['razduzeno']}}</span></td>
                                            <td class="py-2"></td>
                                            <td class="py-2">
                                                <span class="flex font-bold">
                                                        @if($item['saldo_sign'] == 0)
                                                            <svg class="w-5 h-5 mr-1 mt-0.5 text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                                        @elseif($item['saldo_sign'] == 1)
                                                            <svg class="w-5 h-5 mr-1 mt-0.5 text-red-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                                        @else
                                                            <svg class="w-5 h-5 mr-1 mt-0.5 text-sky-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                                        @endif
                                                        {{$item['saldo']}}
                                                </span>
                                            </td>
                                            <td class="py-2"></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else 
                                <tr>
                                    <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">Trenutno nema računa!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @if (count($data))
                    <div class="px-6 py-4 mb-6">
                        
                         {{ $data->withPath(url()->current())->links() }}
                    </div>
                       
                    <table class="min-w-full divide-y divide-gray-200 bg-gray-100" style="width: 100% !important">
                        <tfoot>
                            <tr>
                                <td class="pl-2 py-2 text-right">Ukupno zaduženo: </td>
                                <td class="py-2 text-left"><span class="font-bold ml-2">{{ $ukupno_dug['zaduzeno'] }}</span></td>
                                <td class="py-2 text-right">Ukupno razduženo: </td>
                                <td class="py-2 text-left"><span class="font-bold  ml-2">{{ $ukupno_dug['razduzeno'] }}</span></td>
                                <td class="py-2 text-right">Saldo: </td>
                                <td class="py-2 text-left">
                                     <span class="flex font-bold">
                                    @if($ukupno_dug['saldo_sign'] == 0)
                                        <svg class="w-5 h-5 mr-1 mt-0.5 text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    @elseif($ukupno_dug['saldo_sign'] == 1)
                                        <svg class="w-5 h-5 mr-1 mt-0.5 text-red-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    @else
                                        <svg class="w-5 h-5 mr-1 mt-0.5 text-sky-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    @endif    
                               {{ $ukupno_dug['saldo'] }}</span></td>
                            </tr>
                        </tfoot>
                    </table>
                     @endif
                </div>
            </div>
        </div>
    </div>
</div>
