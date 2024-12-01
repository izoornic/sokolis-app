<div>
<div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
      <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
        <h5 class="text-xl font-medium leading-normal text-surface flex">
            @if($email_state == 'exist')
                <svg class="w-6 h-6 current-color dark:text-white mr-2 mt-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="1.5" d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z"/></svg>
            @else
                <svg class="w-6 h-6 current-color dark:text-white mr-2 mt-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 12h4m-2 2v-4M4 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
            @endif
            <span>{{ $title }}</span>
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
        @if($email_state == 'init')
            <div>Unesi e-mail adresu novog stanara:</div>
            <div class="flex">
                <input type="text" wire:model="email" class="border border-teal-600 rounded mr-4 min-w-80"></input>
                <div>
                    <button wire:click="searchEmail" class="mt-2 bg-teal-700 hover:bg-teal-900 text-white font-bold py-2 px-4 border border-teal-600 rounded flex mb-1">
                    <svg class="w-6 h-6 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/></svg>
                    Pretraži</button>
                </div>
            </div>
            <div>
                @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
            </div>
        @elseif($email_state == 'new' || 'exist')
            <div class="py-2 border-b-2 border-neutral-100">
                <p>Email:</p>
                <p class="text-gray-500">{{ $email }}</p>
            </div>
            <div class="py-2 border-b-2 border-neutral-100">
                <p><span class="text-red-500 mb-3">*</span>@if($pravno_lice) Naziv: @else Ime i prezime: @endif</p>
                <input type="text" id="name" wire:model="name" class="border border-teal-600 rounded min-w-80"></input>
                <div>
                    @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
                </div>
            </div>
           
            <div class="py-2 border-b-2 border-neutral-100">
                @if($email_state == 'new')
                    <p><span class="text-red-500 mb-3">*</span>Lozinka:</p>
                    <input type="text" id="pass" wire:model="pass" class="border border-teal-600 rounded min-w-80"></input>
                    <div>
                        @error('pass') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
                    </div>
                @elseif($email_state == 'exist')
                <button
                    type="button"
                    wire:click="$dispatch('openModal', { component: 'modals.reset-lozinke', arguments: {name: '{{$name}}', user_id: '{{$user_id}}'}})"
                    class="ms-1 inline-block rounded bg-red-300 px-4 py-2 font-medium uppercase leading-normal text-white shadow-neutral-200 transition duration-150 ease-in-out  hover:text-white hover:bg-red-900 hover:shadow-neutral-400 focus:bg-bg-teal-900 focus:shadow-neutral-400 focus:outline-none focus:ring-0 active:bg-teal-900 active:shadow-shadow-neutral-400 flex"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>
                    <span class="">Resetuj lozinku</span>
                </button>
                @endif
            </div>
           
            <div class="py-2 border-b-2 border-neutral-100">
                <p>Telefon:</p>
                <div class="flex items-center max-w-80">
                <div id="dropdown-phone-button" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-200 border border-teal-600 rounded-s-lg">
                +381
                </div>
                    <label for="phone-input" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Phone number:</label>
                    <div class="relative w-full">
                        <input type="text" wire:model="tel" id="phone-input" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-0 border border-teal-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="63 12 34 567" />
                    </div>
                </div>
                <div>
                    @error('tel') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
                </div>
            </div>
            @if($email_state == 'new')
            <div class="py-2 border-b-2 border-neutral-100">
                <p>Pravno lice:</p>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" wire:model.live="pravno_lice" value="" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">@if($pravno_lice) Da @else Ne @endif</span>
                </label>
            </div>
            @endif
            @if($pravno_lice)
                <div class="py-2 border-b-2 border-neutral-100">
                    <p><span class="text-red-500 mb-3">*</span>Adresa:</p>
                    <input type="text" wire:model="adresa" class="border border-teal-600 rounded min-w-80"></input>
                    <div>
                        @error('adresa') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
                    </div>
                </div>
                <div class="py-2 border-b-2 border-neutral-100">
                    <p><span class="text-red-500 mb-3">*</span>Sediste:</p>
                    <input type="text" wire:model="sediste" class="border border-teal-600 rounded min-w-80"></input>
                    <div>
                        @error('sediste') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
                    </div>
                </div>
                <div class="py-2 border-b-2 border-neutral-100">
                    <p><span class="text-red-500 mb-3">*</span>Poštanski broj:</p>
                    <input type="text" wire:model="postanskibr" class="border border-teal-600 rounded min-w-80"></input>
                    <div>
                        @error('postanskibr') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
                    </div>
                </div>
                <div class="py-2 border-b-2 border-neutral-100">
                    <p><span class="text-red-500 mb-3">*</span>Marični broj:</p>
                    <input type="text" wire:model="mb" class="border border-teal-600 rounded min-w-80"></input>
                    <div>
                        @error('mb') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
                    </div>
                </div>
                <div class="py-2 border-b-2 border-neutral-100">
                    <p><span class="text-red-500 mb-3">*</span>Pib:</p>
                    <input type="text" wire:model="pib" class="border border-teal-600 rounded min-w-80"></input>
                    <div>
                        @error('pib') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
                    </div>
                </div>
                <div class="py-2 border-b-2 border-neutral-100">
                    <p>Tekući račun:</p>
                    <input type="text" wire:model="tr" class="border border-teal-600 rounded min-w-80"></input>
                    <div>
                        @error('tr') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
                    </div>
                </div>
            @endif
            
            
        @else

        @endif
      </div>
       <!-- Modal footer -->
       <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 p-4">
        <button 
          type="button"
          class="mr-4 inline-block rounded bg-neutral-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-700 transition duration-150 ease-in-out hover:bg-neutral-400 hover:text-white focus:bg-neutral-400 focus:outline-none focus:ring-0 active:bg-neutral-400"
          wire:click="$dispatch('closeModal')"
          >
          Otkaži
        </button>
        @if($email_state == 'new')
        <button
          type="button"
          wire:click="newUser"
          class="ms-1 inline-block rounded bg-teal-700 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-neutral-200 transition duration-150 ease-in-out  hover:text-white hover:bg-teal-900 hover:shadow-neutral-400 focus:bg-bg-teal-900 focus:shadow-neutral-400 focus:outline-none focus:ring-0 active:bg-teal-900 active:shadow-shadow-neutral-400"
          >
          Dodaj novog stanara
        </button>
        @elseif($email_state == 'exist')
        <button
          type="button"
          wire:click="editUser"
          class="ms-1 inline-block rounded bg-teal-700 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-neutral-200 transition duration-150 ease-in-out  hover:text-white hover:bg-teal-900 hover:shadow-neutral-400 focus:bg-bg-teal-900 focus:shadow-neutral-400 focus:outline-none focus:ring-0 active:bg-teal-900 active:shadow-shadow-neutral-400"
          >
          Izmeni podatke
        </button>
        @endif
      </div>
</div>
</div>
