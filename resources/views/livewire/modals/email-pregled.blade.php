<div>
    <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
      <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
        <h5 class="text-xl font-medium leading-normal text-surface">
          Tema: {{ $email->subject }}
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
        <p class="text-sm font-normal leading-normal">
          Kreiran: <span class="">{{ App\Http\TimeFormatHelper::datumFormat($email->created_at) }}</span>
        </p>

        <p class="text-sm font-normal leading-normal">
          Tip: {{ $email->tip->naziv }}
        </p>
        <p class="mt-4 text-sm font-normal leading-normal border-t-2 border-neutral-100">
            Tekst:
        </p>
        <p class="mt-4 font-normal leading-normal">
          {!! $email->message !!}
        </p>
        <p class="pb-4 mb-4 border-b-2 border-neutral-100" >&nbsp;</p>
        <!-- ATTACMENTS -->
         @if(count($attacments))
            <p class="mt-4 text-sm font-normal leading-normal border-t-2 border-neutral-100">
                Prilozi:
            </p>
            <p class="text-sm font-normal leading-normal">
              @foreach($attacments as $attachment)
                <a href="{{ route('attachment.displayAttachment', ['filename'=>$attachment->originalName] ) }}" class="text-blue-500 hover:underline" target="_blank">
                    {{ $attachment->originalName }}
                </a>
                <br />
              @endforeach
            </p>
        @endif
        

        <div class="border-x-2 border-neutral-100 bg-slate-100 mt-10">
            <button type="button" class="flex items-center justify-between w-full mt-5 p-2 font-medium rtl:text-right text-gray-700 border border-b-0 border-gray-200 focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-gray-800 gap-3" wire:click="toogleZgrade">
                <span>Zgrade: </span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
            @if($zgrade_visible)
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($eml_zgrade as $zgrada)
                            <tr class="bg-slate-50">
                                <td class="ps-4 px-2">{{ $zgrada->naziv }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
       
        <div class="border-x-2 border-neutral-100 bg-slate-100 mt-10">
            <button type="button" class="flex items-center justify-between w-full mt-5 p-2 font-medium rtl:text-right text-gray-700 border border-b-0 border-gray-200 focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-gray-800 gap-3" wire:click="toogleStanari">
                <span>Stanari: </span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
            @if($stanari_visible)
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($eml_stanari as $stanar)
                            <tr class="bg-slate-50">
                                <td class="ps-4 px-2">{{ $stanar->name  }}</td>
                                <td class="px-2">{{ $stanar->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-5">
                    {{ $eml_stanari->links() }}
                </div>
            @endif
        </div>
       
      <!-- Modal footer -->
      <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 p-4">
        <button 
          type="button"
          class="inline-block rounded bg-neutral-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-700 transition duration-150 ease-in-out hover:bg-neutral-400 hover:text-white focus:bg-neutral-400 focus:outline-none focus:ring-0 active:bg-neutral-400"
          wire:click="$dispatch('closeModal')"
          >
          Close
        </button>
      </div>
    </div>

</div>

