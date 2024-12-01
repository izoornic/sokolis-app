<div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
    <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
        <h5 class="text-xl font-medium leading-normal text-surface flex">
            <svg class="w-6 h-6 current-color dark:text-white mr-2 mt-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="1.5" d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z"/></svg>
            <span>Reset lozinke - korisnik: {{$name}}</span>
        </h5>
        <button type="button" class="box-content rounded-none border-none text-neutral-500 hover:text-neutral-800 hover:no-underline focus:text-neutral-800 focus:opacity-100 focus:shadow-none focus:outline-none" wire:click="close()">
            <span class="[&>svg]:h-6 [&>svg]:w-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5"  stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </span>
        </button>
    </div>

    <!-- MODAL BODY -->
    <div class="p-4">
        <div class="py-2 border-b-2 border-neutral-100">
            <p class="">Lozinka mora da sadrži najmanje: 
                <ul class="text-red-500 pl-2">
                    <li>8 karaktera, </li>
                    <li>jedno veliko slovo, </li>
                    <li>jedan broj, </li>
                    <li>jedan specijalni karakter</li>
                </ul>
            </p>
        </div>
        <div class="py-2 border-b-2 border-neutral-100">
            <p><span class="text-red-500 mb-3">*</span>Nova lozinka:</p>
            <input type="password" id="pass" wire:model="pass" class="border border-teal-600 rounded min-w-80"></input>
            <div>
                @error('pass') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
            </div>
        </div>
        <div class="py-2 border-b-2 border-neutral-100">
            <p><span class="text-red-500 mb-3">*</span>Potvrdi lozinku:</p>
            <input type="password" id="pass_confirmation" wire:model="pass_confirmation" class="border border-teal-600 rounded min-w-80"></input>
            <div>
                @error('pass_confirmation') <span class="text-xs text-red-500">{{ $message }}</span> @enderror 
            </div>
        </div>
    </div>

    <!-- Modal footer -->
    <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 p-4">
        <button 
          type="button"
          class="mr-4 inline-block rounded bg-neutral-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-700 transition duration-150 ease-in-out hover:bg-neutral-400 hover:text-white focus:bg-neutral-400 focus:outline-none focus:ring-0 active:bg-neutral-400"
          wire:click="close()"
          >
          Otkaži
        </button>
        <button
          type="button"
          wire:click="saveNewPass"
          class="ms-1 inline-block rounded bg-teal-700 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-neutral-200 transition duration-150 ease-in-out  hover:text-white hover:bg-teal-900 hover:shadow-neutral-400 focus:bg-bg-teal-900 focus:shadow-neutral-400 focus:outline-none focus:ring-0 active:bg-teal-900 active:shadow-shadow-neutral-400"
          >
          Promeni lozinku
        </button>
    </div>
</div>