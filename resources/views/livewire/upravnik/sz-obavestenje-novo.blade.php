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
        <div class="mx-2 my-2">
            <div class="bg-slate-50 border-t-4 border-gray-500 rounded-b text-neutral-600 mb-2"> 
                <div class="bg-gray-200 text-lg font-bold px-4 py-3 flex justify-between">
                    <div class="flex">
                        <span>
                            <svg class="fill-current w-4 h-4 mr-2 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z"/></svg>
                        </span>
                        <span class="text-base mr-2 mt-0.5"></span>
                        <span class="ml-4 uppercase">Obaveštenje</span>
                    </div>
                </div>
            </div>
        </div>

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
        <div class="p-2 mb-2 border-b border-slate-300">
            <p>Fajlovi:</p>
            @foreach($db_files as $db_file)
                <div class="flex justify-between bg-teal-50 m-2 p-2" >
                    <span class="mt-2 max-w-96">Ranije sačuvan fajl</span>
                    <p class="border-gray-400 rounded-lg w-72">{{ $db_file->sz_link_text }}</p>
                    <span><button wire:click="delDbUpload({{$db_file->id}})" class="p-2 bg-red-700 hover:bg-red-900 text-white rounded">
                        <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/></svg>
                    </button></span>
                </div>
            @endforeach
            @php
                $names_index = 0;
            @endphp
            @if ($files)
                @foreach($files as $file)
                    <div class="flex justify-between bg-teal-50 m-2 p-2" >
                        <span class="mt-2 max-w-96">{{ $file['original_name'] }}</span>
                        <input type="text" placeholder="Tekst za link" id="" wire:model.live="files.{{$names_index}}.link_txt" class="border-gray-400 rounded-lg w-72"></input>
                        <span><button wire:click="delUpload({{$names_index}})" class="p-2 bg-red-700 hover:bg-red-900 text-white rounded">
                            <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/></svg>
                        </button></span>
                    </div>
                    @php
                        $names_index ++;
                    @endphp
                @endforeach
            @endif
            <div class="relative flex-auto p-4">
                <div class="flex">
                    <label for="browse_btn" style="cursor:pointer" class="ms-1 inline-block rounded bg-teal-700 px-6 pb-2 pt-2.5 text-base font-medium uppercase leading-normal text-white shadow-neutral-200 hover:bg-teal-900">Izaberi fajl: </label>
                    <input id="browse_btn" type="file" accept=".pdf,.xlsx,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" wire:model="cur_file" style="visibility: hidden; height: 2px; width: 150px">
                </div>
            </div>
            <div class="p-2 text-red-500 mb-3">
              Moguće je dodati PDF, Microsoft Word i Excel fajlove.
            </div>
        </div>
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
