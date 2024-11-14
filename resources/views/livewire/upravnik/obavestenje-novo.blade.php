<div>
    <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
        <h5 class="text-xl font-medium leading-normal text-surface flex">
            @if($oid)
                <svg class="w-6 h-6 mt-1 mr-2 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m11.5 11.5 2.071 1.994M4 10h5m11 0h-1.5M12 7V4M7 7V4m10 3V4m-7 13H8v-2l5.227-5.292a1.46 1.46 0 0 1 2.065 2.065L10 17Zm-5 3h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/></svg>

            @else
                <svg class="w-6 h-6 mt-1 mr-2 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path fill="currentColor" d="M4 9.05H3v2h1v-2Zm16 2h1v-2h-1v2ZM10 14a1 1 0 1 0 0 2v-2Zm4 2a1 1 0 1 0 0-2v2Zm-3 1a1 1 0 1 0 2 0h-2Zm2-4a1 1 0 1 0-2 0h2Zm-2-5.95a1 1 0 1 0 2 0h-2Zm2-3a1 1 0 1 0-2 0h2Zm-7 3a1 1 0 0 0 2 0H6Zm2-3a1 1 0 1 0-2 0h2Zm8 3a1 1 0 1 0 2 0h-2Zm2-3a1 1 0 1 0-2 0h2Zm-13 3h14v-2H5v2Zm14 0v12h2v-12h-2Zm0 12H5v2h14v-2Zm-14 0v-12H3v12h2Zm0 0H3a2 2 0 0 0 2 2v-2Zm14 0v2a2 2 0 0 0 2-2h-2Zm0-12h2a2 2 0 0 0-2-2v2Zm-14-2a2 2 0 0 0-2 2h2v-2Zm-1 6h16v-2H4v2ZM10 16h4v-2h-4v2Zm3 1v-4h-2v4h2Zm0-9.95v-3h-2v3h2Zm-5 0v-3H6v3h2Zm10 0v-3h-2v3h2Z"/></svg>
            @endif
            <span>{{ $title }} - {{ $oid }}</san>
        </h5>  
    </div>

    <div class="relative flex-auto p-4">
        <div class="p-2">
            <p><span class="text-red-500 mb-3">*</span>Naslov:</p>
            <input type="text" id="ob_naslov" wire:model="ob_naslov" class="border-gray-400 rounded-lg w-full"></input>
            <div>
                @error('ob_naslov') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
            </div>
        </div>
        <div class="p-2 pb-4 my-2 border-b border-slate-300">
            <p>Tekst obaveštenja:</p>

            @livewire('livewire-quill', [
                'quillId' => 'customQuillId',
                'data' => $content,
                'classes' => 'bg-white rounded-b-lg',
                'toolbar' => [
                    ['bold', 'italic', 'underline'],
                    [
                        [
                            'align' => '',
                        ],
                        [
                            'align' => 'center',
                        ],
                        [
                            'align' => 'right',
                        ],
                    ],
                    ['link'],
                    ['image'],
                ],
            ])
        </div>
        
        <!-- FAJLOVI -->
        @if (!$files)
          <div class="p-2 mb-2 border-b border-slate-300">
            <p>Fajlovi:</p>
            <div class="flex">
              <label for="browse_btn" style="cursor:pointer" class="ms-1 inline-block rounded bg-slate-500 px-6 pb-2 pt-2.5 text-base font-medium uppercase leading-normal text-white shadow-neutral-200 hover:text-neutral-700 hover:bg-slate-100 hover:shadow-neutral-400">Dodja fajlove: </label>
              <input id="browse_btn" type="file" accept=".pdf,.xlsx,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" wire:model="files" multiple style="visibility: hidden; height: 2px; width: 150px">
            </div>
            <div class="p-2 text-red-500 mb-3">
              Moguće je dodati PDF, Microsoft Word i Excel fajlove.
            </div>
          </div>
        @endif

       <!--  ZGRADE  -->
       <div class="p-2 mb-2 border-b border-slate-300">
            <p>Zgrade koje vide obaveštenje:</p>
            @foreach ($zgrade_upravnika as $item)
               <p class="p-2"> <input type="checkbox" value="{{$item->id}}" wire:model="zgrade"  class="form-checkbox h-6 w-6 text-blue-500"> - {{ $item->naziv }}</p>
            @endforeach
            <div class="p-2 text-red-500 mb-3">{{$zgrade_error}} </div>
            
       </div>

        <div class="py-4">
            <button wire:click="save()" class="mt-2 ml-4 bg-teal-700 hover:bg-teal-900 text-white font-bold py-2 px-4 border border-teal-600 rounded flex">  
                <svg class="w-6 h-6 current-color dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21a9 9 0 1 1 0-18c1.052 0 2.062.18 3 .512M7 9.577l3.923 3.923 8.5-8.5M17 14v6m-3-3h6"/></svg>
                Sačuvaj
            </button>
        </div>
      </div>
      <style>
        .ql-container {
            min-height: 10rem;
            height: 100%;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .ql-editor {
            height: 100%;
            flex: 1;
            overflow-y: auto;
            width: 100%;
        }
      </style>
</div>
