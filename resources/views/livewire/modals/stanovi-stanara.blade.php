<div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
      <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
        <h5 class="text-xl font-medium leading-normal text-surface flex">
        <svg class="w-6 h-6 dark:text-white mr-2 mt-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/></svg>
            <span class="">Stanovi, stanar: {{$uss_name}}</san>
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

        {{-- The data table --}}
      <div class="flex flex-col">
          <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                  <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                      <table class="min-w-full divide-y divide-gray-200" style="width: 100% !important">
                          <thead>
                              <tr>
                                  <th class="px-2 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Lamela</th>
                                  <th class="px-2 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Sprat</th>
                                  <th class="px-2 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Stan br.</th>
                                  <th class="px-2 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">Površina</th>
                                  <th class="px-2 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase">::</th>
                              
                              </tr>
                          </thead>

                          <tbody class="bg-white divide-y divide-gray-200"> 
                          @if ($data->count())
                            @foreach ($data as $item)
                                <tr>
                                  <td class="px-2 py-1"> {{$item->naziv}}</td>
                                  <td class="px-2 py-1"> {{$item->sprat}}</td>
                                  <td class="px-2 py-1"> {{$item->stanbr}}</td>
                                  <td class="px-2 py-1"> {{$item->povrsina}} m2</td>
                                  <td class="px-2 py-1">
                                    <button wire:click="unlinkStan({{$item->sid}}, {{$item->userId}})" class="my-1 bg-white hover:bg-red-600 text-gray-500 hover:text-white font-bold py-1 px-2 rounded flex" title ="Ukloni stan">  
                                      <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/></svg>
                                    </button></td>
                                </tr>
                               
                            @endforeach
                          @else
                            <tr>
                              <td colspan="4">Odabrani korisnik nema stanove u vlasništvu. </td>
                            </tr>
                          @endif
                          </tbody>
                        </table>
                   </div>
                </div>
            </div>
          </div>
    </div>
</div>
