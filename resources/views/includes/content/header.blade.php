<div class="flex items-center justify-between w-full h-20 px-6 bg-white">
    <h1 class="pl-2 text-xl font-bold tracking-wide text-blue-gray-900">
        {{ $post->title }} - <span class="text-lg font-normal">{{ $version->name }}</span>
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
                class="absolute right-0 w-56 p-6 space-y-3 bg-white rounded-lg shadow-sm top-20"
            >
                @foreach (config('option.langs', []) as $key => $label)
                    <button 
                        :class="{ 'text-light-blue-500 font-semibold': lang == '{{ $key }}' }" 
                        class="block text-sm text-gray-700 hover:text-light-blue-500" 
                        @click="lang = '{{ $key }}', langModal = false" 
                        type="button"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>
        <div class="w-px h-6 bg-gray-300"></div>
        <a href="{{ url('web/pages') }}" class="transition duration-300 bg-light-blue-100 text-light-blue-500 btn hover:text-light-blue-600">
            <span class="px-3 py-1">Zrušit</span>
        </a>
        <button wire:click="submit" type="button" class="transition duration-300 bg-green-500 btn hover:bg-green-600 text-green-50 hover:text-white">
            <span class="px-3 py-1">Uložit</span>
            <x-loading-spin size="6" target="submit" />
        </button>
        <div class="w-px h-6 bg-gray-300"></div>
        <div class="relative">
            <button @click="moreModal = !moreModal" class="py-2.5 text-gray-500 transition duration-300 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
            <div @click.away="moreModal = false" x-show="moreModal" style="display: none" class="absolute right-0 px-6 py-4 bg-white rounded-lg shadow-sm top-20 w-72">
                <p class="mb-4 text-sm text-blue-gray-500">Poslední úprava: 17:54 27.7.2020</p>
                <label class="flex items-center justify-start mb-2">
                    <div class="flex items-center justify-center flex-none w-5 h-5 mr-2 bg-white border-2 border-gray-200 rounded-full">
                        <input wire:model="developer" type="checkbox" class="absolute opacity-0 radio" name="radio" value="1" />
                        <div class="w-2 h-2 transition duration-200 ease-in-out transform rounded-full opacity-0 bg-light-blue-400"></div>
                    </div>
                    <div class="flex-none text-sm font-semibold text-blue-gray-500">Mód správce</div>
                </label>
            </div>
        </div>
    </div>
</div>