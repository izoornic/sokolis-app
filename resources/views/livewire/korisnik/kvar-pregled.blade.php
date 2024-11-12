<div>
    <div class="mx-4 my-4">
        <div style="">
            <div class="bg-red-50 bg-red-800 text-red-800 hover:text-red-800 fill-red-800 border-red-800"></div>
            <div class="bg-yellow-50 bg-yellow-600 text-yellow-600 hover:text-yellow-600 fill-yellow-600 border-yellow-600"></div>
            <div class="bg-teal-50 bg-teal-600 text-teal-600 hover:text-teal-600 fill-teal-600 border-teal-600"></div>
        </div>
        <div class="bg-{{$tiket->prioritet_bg_collor}} border-t-4 border-{{$tiket->prioritet_txt_collor}} rounded-b text-slate-600 px-4 py-3 shadow-md mb-6 mx-2 my-2" role="alert">
			<div class="flex justify-between">  
				<div class="flex">
					<div class="py-1"><svg class="fill-{{$tiket->prioritet_txt_collor}} w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M128 160H448V352H128V160zM512 64C547.3 64 576 92.65 576 128V208C549.5 208 528 229.5 528 256C528 282.5 549.5 304 576 304V384C576 419.3 547.3 448 512 448H64C28.65 448 0 419.3 0 384V304C26.51 304 48 282.5 48 256C48 229.5 26.51 208 0 208V128C0 92.65 28.65 64 64 64H512zM96 352C96 369.7 110.3 384 128 384H448C465.7 384 480 369.7 480 352V160C480 142.3 465.7 128 448 128H128C110.3 128 96 142.3 96 160V352z"/></svg></div>
					<div>
						<div class="flex"><span class="mt-1">Prioritet:</span> 
                        <span class="mt-1 mx-2 font-bold uppercase text-{{$tiket->prioritet_txt_collor}}">{{$tiket->prioritet_naziv}}</span>
                        <span class="ml-3 mt-1">Status: </span>
                        <span>
                            @if($tiket->tiket_statusId == 1)  
                            <svg class="w-8 h-8 ml-2 text-{{$tiket->prioritet_txt_collor}} dark:text-white ml-2 mb-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M15 7a2 2 0 1 1 4 0v4a1 1 0 1 0 2 0V7a4 4 0 0 0-8 0v3H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V7Zm-5 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/></svg>
                            @else
                            <svg class="w-8 h-8 ml-2 text-{{$tiket->prioritet_txt_collor}} dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/></svg>
                            @endif
                        </span>
                        <span class="ml-2 mt-1 font-bold uppercase text-{{$tiket->prioritet_txt_collor}}">@if($tiket->tiket_statusId == 1) otvoren @else zatvoren @endif</span>
                        @if($upravnik)
                           <span class="mt-1 ml-4 font-bold flex">
                                @if($tiket->vidljiv_zgradi == 1) 
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="1.5" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/><path stroke="currentColor" stroke-width="1.5" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                    <span class="ml-2">vidljiv zgradi</span>
                                @else 
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                    <span class="ml-2">vidljiv samo vlasniku</span> 
                                @endif
                            </span>
                        @endif
                        
                        </div>
						<table class="divide-y divide-gray-200">
							<tr>
								<td class="p-2">Kreiran:</td>
								<td><span class="font-bold">{{ App\Http\TimeFormatHelper::datumFormat($tiket->created_at) }}</span></td>
								<td class="px-2 pl-4"><svg class="float-left fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"/></svg>otvorio:</td>
								<td><span class="font-bold">{{$tiket_creator}}</span></td>
							</tr>
							<tr>
								<td class="p-2">Poslednja promena:</td>
								<td><span class="font-bold">{{ App\Http\TimeFormatHelper::datumFormat($tiket->updated_at) }}</span></td>
								<td class="px-2 pl-4"></td>
								<td></td>
							</tr>
						</table>
                        
					</div>
				</div>
        
				<div>
                @if($vlasnik_tiketa)
                    @if($tiket->tiket_statusId == 1) 
                        <button wire:click="showComfirmModal('zatvori')" title='promeni status' class="my-1 bg-neutral-100 hover:bg-white text-neutral-600 hover:text-{{$tiket->prioritet_txt_collor}} font-bold py-1 px-2 border border-neutral-200 rounded flex">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/></svg>
                            <span>Zatvori tiket</span>
                        </button> 
                    @else 
                        <button wire:click="showComfirmModal('otvori')" title='promeni status' class="my-1 bg-neutral-100 hover:bg-white text-neutral-600 hover:text-{{$tiket->prioritet_txt_collor}} font-bold py-1 px-2 border border-neutral-200 rounded flex">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M15 7a2 2 0 1 1 4 0v4a1 1 0 1 0 2 0V7a4 4 0 0 0-8 0v3H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V7Zm-5 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/></svg>
                            <span>Otvori tiket</span>
                        </button> 
                    @endif
                   <div class="py-4">
                        <button wire:click="showComfirmModal('obrisi')" title='Obriši tiket' class="my-1 bg-neutral-100 hover:bg-white text-neutral-600 hover:text-{{$tiket->prioritet_txt_collor}} font-bold py-1 px-2 border border-neutral-200 rounded flex">
                                <svg class="fill-current w-4 h-4 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z"/></svg> 
                                <span>Obriši tiket</span>
                        </button>
                    </div>
                    @if($upravnik)
                    <div class="py-4">
                        <button wire:click="showComfirmModal('promeniVidljivost')" title='promeni vidljivost tiketa' class="my-1 bg-neutral-100 hover:bg-white text-neutral-600 hover:text-{{$tiket->prioritet_txt_collor}} font-bold py-1 px-2 border border-neutral-200 rounded flex">
                            <svg class="w-6 h-6 text-current mr-1 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="1.5" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/><path stroke="currentColor" stroke-width="1.5" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                <span>Promeni vidljivost</span>
                        </button>
                    </div>  
                    @endif
                @endif
            
            </div>
        </div> 
            <div class="mt-6 py-2">Vrsta kvara: <span class="font-bold text-{{$tiket->prioritet_txt_collor}}">{{$tiket->kvar_tip_naziv}}</div>
            <div class="mb-6 py-2">Opis: <span class="font-bold"> {{$tiket->opis}}</span></div>
        </div> 
    </div>
    
    <!-- SLIKE --> 
    @if($slike->count() || $vlasnik_tiketa)
    <div class="mx-6 my-4">
        <div class="bg-grey-50 border-t-4 border-slate-400 rounded-b text-sky-900 px-4 py-3 shadow-md mb-6" role="alert">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($slike as $slika)
                <div>       
                    <a style="cursor:pointer" wire:click="viewImage({{ $slika->id }})"><img class="h-auto max-w-full rounded-lg" @if($sorce == 'local') src="{{route('image.displayImage',  $slika->image_path)}}" @else src="/storage/{{$slika->image_path}}" @endif alt=""></a>
                </div>
                @endforeach
            </div>
        
            @if($vlasnik_tiketa && $tiket_status == 1)
            <div class="flex items-center px-4 py-3 text-right sm:px-6">
                <button wire:click="dodajSlike()" class="mt-2 bg-slate-400 hover:bg-slate-100 text-white hover:text-neutral-700 font-bold py-2 px-4 border border-neutral-700 rounded flex">
                    <svg class="w-6 h-6 text-current mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path fill="currentColor" d="M16 18H8l2.5-6 2 4 1.5-2 2 4Zm-1-8.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"/><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 18h8l-2-4-1.5 2-2-4L8 18Zm7-8.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"/></svg>
                    {{ __('DODAJ SLIKE') }}
                </button>
            </div>
            @endif
        </div>
    </div>
    @endif

    <div class="flex mx-4 my-4">
        <div class="w-2/5 flex-initial mx-2 my-2">

            <div class="bg-sky-100 border-t-4 border-sky-500 rounded-b text-sky-900 px-4 py-3 shadow-md mb-6" role="alert">
                <div class="flex">
                    <div class="py-1">                    
                        <svg class="fill-current w-6 h-6 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z"/></svg>
                    </div>
                    <div>
                        <p class="p-2">Zgrada: <span class="font-bold">{{ $zgrada->naziv }}</span> </p>
                        <p class="p-2">@if($zgrada->stan_namenaId == 1) Stan br: @else Lokal br: @endif<span class="font-bold">{{$zgrada->stanbr}}</span></p>
                        <p class="text-sm">&nbsp;</p>
                        <p></p>
                    </div>
                </div>
            </div>
            @if($vlasnik_tiketa && $tiket->tiket_statusId == 1)
            <div class="border-t-4 border-sky-500 rounded-b text-sky-900 px-4 py-3 shadow-md mb-6" role="alert">
                <div class="p-2 pb-4 mb-2">
                    <p class="text-slate-600 text-lg">Promeni prioritet:</p>
                    <div class="flex mt-4 mb-2">
                        @foreach (App\Models\KvarTiketPrioritet::prList() as $value)
                            @if($tiket->tiket_prioritetId == $value->id)
                                <span class="flex-none py-2 px-4 mx-2 font-bold rounded bg-{{$value->prioritet_txt_collor}} text-white">{{ $value->prioritet_naziv }}</span>
                            @else
                                <button wire:click="kvarPrioritet({{ $value->id }})" class="flex-none bg-{{ $value->prioritet_bg_collor }} hover:bg-{{$value->prioritet_bg_hower_collor}} text-{{$value->prioritet_txt_collor}} font-bold py-2 px-4 rounded mx-2">
                                    {{ $value->prioritet_naziv }}
                                </button>
                            @endif
                        @endforeach
                    </div>
            
                    <div class="flex mt-4" style="display:none">
                            <button class="flex-none bg-red-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded mx-2">
                                <span class="bg-red-800 border-red-500 fill-red-500 text-red-800"></span>
                            </button>
                            <button class="flex-none bg-orange-500 hover:bg-orange-200 text-white font-bold py-2 px-4 rounded mx-2">
                                <span class="bg-yellow-600 border-orange-500 fill-orange-500 text-yellow-600"></span>
                            </button>
                            <button class="flex-none bg-yellow-500 hover:bg-yellow-200 text-white font-bold py-2 px-4 rounded mx-2">
                                <span class="bg-teal-600 border-yellow-500 fill-yellow-500 text-teal-600"></span>
                            </button>
                            <button class="flex-none bg-red-50 hover:bg-red-200 text-white font-bold py-2 px-4 rounded mx-2">
                                <span class="bg-teal-50 border-green-500 fill-green-500 text-green-500"></span>
                            </button>
                    </div>
                </div>
            </div>
            @endif
            <!-- HISTORY  -->
            <div class="border-t-4 border-sky-500 rounded-b text-sky-900 px-4 py-3 shadow-md mb-6" role="alert">
                <div class="mt-2 mb-6"><svg class="float-left fill-current w-4 h-4 mb-4 mr-4 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C201.7 512 151.2 495 109.7 466.1C95.2 455.1 91.64 436 101.8 421.5C111.9 407 131.8 403.5 146.3 413.6C177.4 435.3 215.2 448 256 448C362 448 448 362 448 256C448 149.1 362 64 256 64C202.1 64 155 85.46 120.2 120.2L151 151C166.1 166.1 155.4 192 134.1 192H24C10.75 192 0 181.3 0 168V57.94C0 36.56 25.85 25.85 40.97 40.97L74.98 74.98C121.3 28.69 185.3 0 255.1 0L256 0zM256 128C269.3 128 280 138.7 280 152V246.1L344.1 311C354.3 320.4 354.3 335.6 344.1 344.1C335.6 354.3 320.4 354.3 311 344.1L239 272.1C234.5 268.5 232 262.4 232 256V152C232 138.7 242.7 128 256 128V128z"/></svg>
                    <span class="font-bold">Istorija tiketa:</span>
                </div>
               
                    <ol class="relative border-l border-gray-200 dark:border-gray-700">
                                       
                        <li class="mb-4 ml-6">            
                            <span class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-sky-100 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/></svg>  
                            </span>
                            
                            <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white"> - <span class="bg-sky-100 text-sky-900 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">{{ App\Http\TimeFormatHelper::datumFormat($tiket->created_at) }}</span></h3>
                            <p class="mb-0 text-base font-normal text-gray-500 dark:text-gray-400">Akcija: <span class="font-bold">Tiket kreiran</span></p>
                            <p class="mb-2 text-base font-normal text-gray-500 dark:text-gray-400">Prioritet: <span class="font-bold">{{$tiket->prioritet_naziv}}</span></p>                          
                        </li>
                        
                    </ol>
                    <p class="mb-0 text-base font-normal text-gray-500 dark:text-gray-400"><span class="font-bold">Tiket #{{$this->tkid}}</span></p>  
               
            </div>
        </div>
        


        <div class="relative w-full">
            <div class="bg-white border-t-4 border-slate-500 rounded-b text-slate-900 px-4 py-3 shadow-md mx-4 ml-10 mt-2" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="fill-slate-400 w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M416 176C416 78.8 322.9 0 208 0S0 78.8 0 176c0 39.57 15.62 75.96 41.67 105.4c-16.39 32.76-39.23 57.32-39.59 57.68c-2.1 2.205-2.67 5.475-1.441 8.354C1.9 350.3 4.602 352 7.66 352c38.35 0 70.76-11.12 95.74-24.04C134.2 343.1 169.8 352 208 352C322.9 352 416 273.2 416 176zM599.6 443.7C624.8 413.9 640 376.6 640 336C640 238.8 554 160 448 160c-.3145 0-.6191 .041-.9336 .043C447.5 165.3 448 170.6 448 176c0 98.62-79.68 181.2-186.1 202.5C282.7 455.1 357.1 512 448 512c33.69 0 65.32-8.008 92.85-21.98C565.2 502 596.1 512 632.3 512c3.059 0 5.76-1.725 7.02-4.605c1.229-2.879 .6582-6.148-1.441-8.354C637.6 498.7 615.9 475.3 599.6 443.7z"/></svg></div>
                    <div class="w-full">
                        <div class="flex justify-between">
                            <div class="mt-2 font-bold">Komentari:</div>
                            <div class="font-light">{{$tiket->tiket_br_komentara}}</div>
                        </div>
                    </div>
                </div>
            

                @if($komentari->count())
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
                @if($tiket->tiket_statusId == 1 )
                <div class="relative w-full">
                    <div class="mt-4 ml-auto">
                        <p class="text-slate-600 text-lg">Dodaj komentar:</p>
                        <textarea wire:model="new_coment" class="border border-slate-400 rounded-lg w-full" id="novi_komentar" type="textarea" class="mt-1 block w-full disabled:opacity-50"></textarea>
                        <p class="text-right">
                            <button wire:click="addComment()" class="mt-2 bg-slate-400 hover:bg-slate-700 text-white font-bold py-2 px-4 border border-slate-600 rounded">Pošalji</button>
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>




    </div>
    

</div>