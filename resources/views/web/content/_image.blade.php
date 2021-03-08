<div class="flex w-full bg-gray-50 max-h-28">
    <div class="flex w-full bg-gray-50 max-h-28">
        <input type="text" class="hidden">
        @if(isset($state[$item]['upload'][$lang]) && is_object($state[$item]['upload'][$lang]))
            <div 
                class="w-2/6 h-16 m-2 bg-white bg-center bg-cover rounded-md" 
                style="background-image: url('{{ $state[$item]['upload'][$lang]->temporaryUrl() }}')"
            ></div>
        @elseif(isset($state[$item]['value'][$lang]) && (!isset($state[$item]['delete'][$lang]) || !$state[$item]['delete'][$lang]))
            <div 
                class="w-2/6 h-16 m-2 bg-white bg-center bg-cover rounded-md" 
                style="background-image: url('{{ asset('files/' . $state[$item]['value'][$lang]) }}')"
            ></div>
        @endif
        <div class="flex items-center justify-center w-full py-4">
            <button
                wire:click="openModal({{ $item }})"
                type="button"
                class="z-10 -mr-5 bg-white shadow cursor-pointer btn text-light-blue-500 hover:text-light-blue-800"
            >
                Vybrat obrázek
            </button>
            @if(isset($state[$item]['upload'][$lang]) && is_object($state[$item]['upload'][$lang]))
                <button 
                    wire:click="$set('state.{{ $item }}.upload.{{ $lang }}', null)" 
                    type="button" 
                    class="py-2 pl-4 pr-3 text-white rounded-l-none rounded-xl bg-light-blue-400 hover:bg-light-blue-500"
                >
                    <svg class="w-4 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                    </svg>
                </button>
            @elseif(isset($state[$item]['value'][$lang]) && (!isset($state[$item]['delete'][$lang]) || !$state[$item]['delete'][$lang]))
                <button
                    wire:click="$set('state.{{ $item }}.delete.{{ $lang }}', true)"
                    type="button"
                    class="py-2 pl-4 pr-3 text-white bg-red-400 rounded-l-none rounded-xl hover:bg-red-500"
                >
                    <svg class="w-4 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            @elseif(isset($state[$item]['delete'][$lang]) && $state[$item]['delete'][$lang])
                <button 
                    wire:click="$set('state.{{ $item }}.delete.{{ $lang }}', false)" 
                    type="button" 
                    class="py-2 pl-4 pr-3 text-white rounded-l-none rounded-xl bg-light-blue-400 hover:bg-light-blue-500"
                >
                    <svg class="w-4 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                    </svg>
                </button>
            @endif
        </div>
    </div> 
</div> 