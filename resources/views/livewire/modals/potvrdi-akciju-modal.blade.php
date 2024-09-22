<div>
    <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none">
      <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4">
        <h5 class="text-xl font-medium leading-normal text-surface">
         {{ $naslov }}
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

        <div class="p-2 pb-4 mb-2 border-b border-slate-300"> 
            <p class="text-slate-600 text-lg">{{ $body_text }}</p>
        </div>

      <!-- Modal footer -->
      <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 p-4">
        <button 
          type="button"
          class="inline-block rounded bg-neutral-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-700 transition duration-150 ease-in-out hover:bg-neutral-400 hover:text-white focus:bg-neutral-400 focus:outline-none focus:ring-0 active:bg-neutral-400"
          wire:click="$dispatch('closeModal')"
          >
          Otkaži
        </button>
        <button
          type="button"
          wire:click="confirmAction"
          class="ms-1 inline-block rounded bg-teal-500 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-neutral-200 transition duration-150 ease-in-out  hover:text-neutral-700 hover:bg-teal-200 hover:shadow-neutral-400 focus:bg-bg-teal-200 focus:shadow-neutral-400 focus:outline-none focus:ring-0 active:bg-teal-200 active:shadow-shadow-neutral-400"
          >
          {{ $button_label }}
        </button>
      </div>
    </div>
</div>