<div>
    <div class="relative flex-auto p-4">
        <div class="mx-2 my-2">
            <div class="bg-teal-50 border-t-4 border-teal-500 rounded-b text-neutral-600 mb-2"> 
                <div class="text-lg font-bold px-4 py-3 flex justify-between">
                    <div class="flex">
                        <span>
                            <svg class="fill-current w-4 h-4 mt-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/></svg>
                        </span>
                        <span class="text-base mr-2 mt-0.5"></span>
                        <span class="ml-4 uppercase">Email obaveštenje</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-2">
            <p><span class="text-red-500 mb-3">*</span>Naslov:</p>
            <input type="text" id="subject" wire:model="subject" class="border-gray-400 rounded-lg w-full"></input>
            <div>
                @error('subject') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
            </div>
        </div>
        <div class="p-2 pb-4 my-2 border-b border-slate-300">
            <p>Poruka:</p>

            @livewire('livewire-quill', [
                'quillId' => 'customQuillId',
                'data' => $message,
                'classes' => 'bg-white rounded-b-lg',
                'toolbar' => [
                    ['bold', 'italic', 'underline'],
                    ['link'],
                    ['clean'],
                ],
            ])
        </div>
        <div>
            <textarea wire:model="message" id="message" class="hidden" id="customQuillId"></textarea>
            <div>
                @error('message') <span class="text-xs text-red-500 border-b border-slate-300 mb-4">{{ $message }}</span> @enderror 
            </div>
        </div>
       

        <!-- FAJLOVI -->
        <div class="p-2 mb-2 border-b border-slate-300">
            <p>Prilozi (Attachments):</p>
            @php
                $names_index = 0;
            @endphp
            @if ($files)
                @foreach($files as $file)
                    <div class="flex justify-between bg-teal-50 m-2 p-2" >
                        <span class="mt-2 max-w-96">{{ $file['original_name'] }}</span>
                        <!-- <input type="text" placeholder="Tekst za link" id="" wire:model.live="files.{{$names_index}}.link_txt" class="border-gray-400 rounded-lg w-72"></input> -->
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
                    <input id="browse_btn" type="file" accept="image/*,.pdf,.xlsx,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" wire:model="cur_file" style="visibility: hidden; height: 2px; width: 150px">
                </div>
            </div>
            <div class="p-2 text-red-500 mb-3">
              Moguće je dodati: Slike, PDF, Microsoft Word i Excel fajlove.
            </div>
        </div>
       <!--  ZGRADE  -->
       <div class="p-2 mb-2 border-b border-slate-300">
            <p>Zgrade čiji stanari će dobiti obaveštenje: <br /><span class="text-sm text-gray-500">( Ovu vrstu obaveštenja dobijaju svi stanari i ne mogu je isključiti preko podešavanja profila.)</span></p>
            @foreach ($zgrade_upravnika as $item)
               <p class="p-2"> <input type="checkbox" value="{{$item->id}}" wire:model="zgrade"  class="form-checkbox h-6 w-6 text-blue-500"> - {{ $item->naziv }}</p>
            @endforeach
            <div class="p-2 text-red-500 mb-3">{{$zgrade_error}} </div>
            
       </div>

        <div class="py-4">
            <button wire:click="posaljiObavestenje()" class="mt-2 ml-4 bg-teal-700 hover:bg-teal-900 text-white font-bold py-2 px-4 border border-teal-600 rounded flex">  
                <svg class="w-6 h-6 current-color dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21a9 9 0 1 1 0-18c1.052 0 2.062.18 3 .512M7 9.577l3.923 3.923 8.5-8.5M17 14v6m-3-3h6"/></svg>
                Pošalji e-mail
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