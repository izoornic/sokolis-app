<div class="p-6">

<livewire:korisnik.komponente.obavestenje tip="vazno" naslov="Radovi na vertikali" textdisp="Od petka 26. do nedelje 28. 8. 2024. vrsi ce se radovi na kuhinjskoj vertikali."/>

<livewire:korisnik.komponente.obavestenje tip="obavestenje" naslov="Sastanak skupštine stanara" textdisp="Lorem ipsum dolor sit amet, consectetur adipiscing elit. In dolor diam, feugiat quis enim sed, ullamcorper semper ligula. Mauris consequat justo volutpat"/>

<livewire:korisnik.komponente.obavestenje tip="info" naslov="Inspekcija protivpožarnih aparata" textdisp="Lorem ipsum dolor sit amet, consectetur adipiscing elit. In dolor diam, feugiat quis enim sed, ullamcorper semper ligula. Mauris consequat justo volutpat"/>

   <div class="my-2">
      <button wire:click="$dispatch('openModal', { component: 'modals.info-modal' })">--</button>
   </div>
</div>
