<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <button wire:click="NovoObavestenje" class="mt-2 mr-4 bg-teal-700 hover:bg-teal-900 text-white font-bold py-2 px-4 border border-teal-600 rounded flex">  
            <svg class="w-6 h-6 current-color dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/></svg>
            {{ __('Novo e-mail obaveštenje') }}
        </button>

        <button wire:click="NoviRacun" class="mt-2 bg-yellow-500 hover:bg-yellow-300 text-white font-bold py-2 px-4 border border-yellow-500 rounded flex">  
             <svg class="w-6 h-6 text-current dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"> <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z"/></svg>
            {{ __('Nov račun dodat') }}
        </button>
    </div>
    <livewire:upravnik.komponente.session-flash-message />
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Vrsta obaveštenja</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tema (subject)</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Br. zgrada</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Br. stanara</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Datum</th>
                                <th class="px-6 py-3 bg-gray-50"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($data as $email)
                                <tr>
                                    <td class="px-2">{{ $email->tip }}</td>
                                    <td class="px-2">{{ $email->subject }}</td>
                                    <td class="px-2 text-center">{{ $email->zgrade_count }}</td>
                                    <td class="px-2 text-center">{{ $email->stanari_count }}</td>
                                    <td class="px-2">{{ App\Http\TimeFormatHelper::datumFormat($email->created_at) }}</td>
                                    <td class="px-2">
                                        <button wire:click="$dispatch('openModal', { component: 'modals.email-pregled', arguments: {email_id: '{{$email->id}}'}})" class="my-1 bg-white hover:bg-emerald-600 text-gray-500 hover:text-white font-bold py-1 px-2 rounded flex" title ="Pregledaj e-mail obaveštenje">
                                            <svg class="w-6 h-6 text-current dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 4H4m0 0v4m0-4 5 5m7-5h4m0 0v4m0-4-5 5M8 20H4m0 0v-4m0 4 5-5m7 5h4m0 0v-4m0 4-5-5"/></svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-5">
            {{ $data->links() }}
        </div>
</div>