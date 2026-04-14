<div class="p-6">

    <h2 class="text-lg font-semibold text-gray-700 mb-6">Pregled zgrada</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        @foreach($zgrade as $zgrada)
            @php
                $ukupnoKvarova = collect($kvarovi[$zgrada->id] ?? [])->sum();
            @endphp

            <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden flex flex-col">

                {{-- Card header --}}
                <div class="bg-emerald-600 px-4 py-3">
                    <h3 class="text-white font-bold text-base leading-tight">{{ $zgrada->naziv }}</h3>
                    <p class="text-emerald-100 text-xs mt-0.5">{{ $zgrada->adresa }}, {{ $zgrada->sediste }}</p>
                </div>

                {{-- Stats --}}
                <div class="p-4 flex-1 space-y-4">

                    {{-- Apartment count --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 text-gray-500 text-sm">
                            <svg class="w-5 h-5 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
                            </svg>
                            <span>Stanovi / Lokali</span>
                        </div>
                        <span class="font-bold text-gray-800 text-base">{{ $zgrada->stanovi_count }}</span>
                    </div>

                    {{-- Open fault tickets --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2 text-gray-500 text-sm">
                                <svg class="w-5 h-5 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <span>Otvorene prijave</span>
                            </div>
                            <span class="font-bold text-gray-800 text-base">{{ $ukupnoKvarova }}</span>
                        </div>

                        @if($ukupnoKvarova > 0)
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($prioriteti as $p)
                                    @if(($kvarovi[$zgrada->id][$p->id] ?? 0) > 0)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold border border-current text-{{ $p->prioritet_txt_collor }}">
                                            {{ $p->prioritet_naziv }}: {{ $kvarovi[$zgrada->id][$p->id] }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-gray-400 italic">Nema otvorenih prijava</p>
                        @endif
                    </div>

                </div>

                {{-- Actions --}}
                @php
                    $nKvar = max(0, (int) ($nevidjeniKvarovi[$zgrada->id] ?? 0));
                    $nObav = max(0, (int) ($nevidjeniObavestenja[$zgrada->id] ?? 0));
                @endphp
                <div class="px-4 pb-4 pt-2 border-t border-gray-100 flex gap-2">
                    <button
                        wire:click="goToPage({{ $zgrada->id }}, '/upravnik-kvarovi')"
                        class="relative flex items-center gap-1.5 text-xs bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white border border-emerald-300 font-semibold py-1.5 px-3 rounded transition-colors"
                        title="Prikaži kvarove za ovu zgradu"
                    >
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        Kvarovi
                        @if($nKvar > 0)
                            <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-xs font-bold leading-none rounded-full px-1.5 py-0.5">{{ $nKvar }}</span>
                        @endif
                    </button>
                    <button
                        wire:click="goToPage({{ $zgrada->id }}, '/upravnik-obavestenja')"
                        class="relative flex items-center gap-1.5 text-xs bg-gray-50 hover:bg-gray-600 text-gray-700 hover:text-white border border-gray-300 font-semibold py-1.5 px-3 rounded transition-colors"
                        title="Prikaži obaveštenja za ovu zgradu"
                    >
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 9H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h6m0-6v6m0-6 5.419-3.87A1 1 0 0 1 18 6v12a1 1 0 0 1-1.581.87L11 15m7 0a3 3 0 0 0 0-6"/>
                        </svg>
                        Obaveštenja
                        @if($nObav > 0)
                            <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-xs font-bold leading-none rounded-full px-1.5 py-0.5">{{ $nObav }}</span>
                        @endif
                    </button>
                </div>

            </div>
        @endforeach

    </div>

    {{-- Safelist hidden dynamic colors used by prioriteti --}}
    <div class="hidden">
        <span class="text-red-800 text-red-600 text-red-500"></span>
        <span class="text-yellow-600 text-yellow-500"></span>
        <span class="text-teal-600 text-teal-500"></span>
        <span class="text-green-600 text-green-500"></span>
        <span class="text-orange-600 text-orange-500"></span>
        <span class="text-blue-600 text-blue-500"></span>
        <span class="text-gray-600 text-gray-500"></span>
    </div>

</div>
