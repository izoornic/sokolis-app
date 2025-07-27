<div>
    <div class="relative flex-auto p-4">
        <div class="mx-2 my-2">
            <div class="bg-yellow-50 border-t-4 border-yellow-500 rounded-b text-neutral-600 mb-2"> 
                <div class="text-lg font-bold px-4 py-3 flex justify-between">
                    <div class="flex">
                        <span>
                            <svg class="fill-current w-4 h-4 mt-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/></svg>
                        </span>
                        <span class="text-base mr-2 mt-0.5"></span>
                        <span class="ml-4 uppercase">Dodat nov račun</span>
                    </div>
                </div>
            </div>
        </div>
        <!--  ZGRADE  -->
       <div class="p-2 mb-2 border-b border-slate-300">
            <p>Zgrade čiji stanari će dobiti obaveštenje: <br /><span class="text-sm text-gray-500">Na portalu je dostupan novi račun.</span></p>
            @foreach ($zgrade_upravnika as $item)
               <p class="p-2 flex"> 
                <input type="checkbox" id="ch{{$item->id}}" value="{{$item->id}}" wire:model="zgrade"  class="form-checkbox h-6 w-6 text-blue-500" /> 
                <label for="ch{{$item->id}}" class="ml-4">- {{ $item->naziv }}</label>
                <span class="ml-4 text-sm text-gray-500"> za mesec {{$item->last_month_name}} </span>
                <span class="text-xs text-gray-500">Poslednji put poslato: {{$item->last_send}}</span>
                <span class="text-xs text-gray-500">Komentar: {{$item->db_coment}}</span>
                </p>
            @endforeach
            <div class="p-2 text-red-500 mb-3">{{$zgrade_error}} </div>
            
       </div>

        <div class="py-4">
            <button wire:click="posaljiObavestenje()" class="mt-2 ml-4 bg-yellow-500 hover:bg-yellow-900 text-white font-bold py-2 px-4 border border-yellow-500 rounded flex">  
                <svg class="w-6 h-6 current-color dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21a9 9 0 1 1 0-18c1.052 0 2.062.18 3 .512M7 9.577l3.923 3.923 8.5-8.5M17 14v6m-3-3h6"/></svg>
                Pošalji e-mail
            </button>
        </div>
      </div>
</div>
