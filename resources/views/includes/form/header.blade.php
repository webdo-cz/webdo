<div class="flex items-center justify-between w-full h-20 px-6 bg-white shadow-sm">
    <h1 class="pl-4 text-xl font-bold tracking-wide text-blue-gray-900">
        Vytvořit příspěvek
    </h1>
    <div class="flex items-center space-x-4">
        <div class="relative">
            <button @click="langModal = !langModal" class="space-x-2 transition duration-300 bg-white btn group hover:shadow-sm">
                <div class="px-2 py-1 text-light-blue-500 group-hover:text-light-blue-600">
                    {{ config('option.langs.' . $lang) }}
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div 
                @click.away="langModal = false" 
                x-show="langModal"
                style="display: none" 
                class="absolute right-0 z-50 w-56 p-6 space-y-3 bg-white rounded-lg shadow-sm top-20"
            >
                @foreach (config('option.langs', []) as $key => $label)
                    <button 
                        :class="{ 'text-light-blue-500 font-semibold': lang == '{{ $key }}' }" 
                        class="block text-sm text-gray-700 cursor-pointer hover:text-light-blue-500" 
                        @click="lang = '{{ $key }}', langModal = false" 
                        type="button"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>
        <div class="w-px h-6 bg-gray-300"></div>
        <a href="{{ url($section . '/' . $type . 's') }}" class="transition duration-300 bg-light-blue-100 text-light-blue-500 btn hover:text-light-blue-600">
            <span class="px-3 py-1">Zrušit</span>
        </a>
        <button wire:click="submit" type="button" class="transition duration-300 bg-green-500 btn hover:bg-green-600 text-green-50 hover:text-white">
            <span class="px-3 py-1">Uložit</span>
            <x-loading-spin size="6" target="submit" />
        </button>
        <div class="w-px h-6 bg-gray-300"></div>
        <button @click="settings = !settings" class="py-2.5 flex space-x-1 text-gray-400 transition duration-300 hover:text-gray-900">
            {{-- <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
            </svg> --}}
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span>Nastavení</span>
        </button>
    </div>
</div>