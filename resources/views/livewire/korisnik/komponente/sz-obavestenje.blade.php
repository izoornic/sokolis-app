<div class="my-2">
    <div class="mx-2 my-2">
        <div class="bg-slate-50 border-t-4 border-gray-500 rounded-b text-neutral-600 shadow-md mb-6 pb-2"> 
            <div class="bg-gray-200 text-lg font-bold px-4 py-3 flex justify-between">
                <div class="flex">
                    <span>
                        <svg class="fill-current w-4 h-4 mr-2 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z"/></svg>
                    </span>
                    <span class="text-base mr-2 mt-0.5">{{App\Http\TimeFormatHelper::datumFormat($ob_datum)}} </span>
                    <span class="ml-4 uppercase">  {{ $naslov }}</span>
                </div>
            </div>
            <div class="bg-slate-100 px-4 text-right">
                @foreach(App\Models\SzObavestenjeZgradaIndex::getZgradeObavestenja($o_id) as $zgrada)
                    {{ $zgrada }} &nbsp; &nbsp;
                @endforeach
            </div>
            <div class="">  
                <div class="p-4 text-base text-xl leading-7 text-gray-700">
                    <p> {!! nl2br(e($textdisp)) !!}</p>
                </div>
            </div>


            
        </div>
    </div>
</div>
