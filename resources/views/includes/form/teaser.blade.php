<div class="w-full max-w-2xl mx-auto" x-data="{ showTeaser: false, customTeaser: @entangle('state.custom_teaser').defer }">
    <div class="flex items-center justify-between w-full">
        <span x-show="!customTeaser" @click="showTeaser = !showTeaser" class="flex items-center px-2 text-sm cursor-pointer text-blue-gray-700">
            <svg class="w-4 h-4 mr-2" :class="{ 'transform rotate-180': showTeaser }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
            Zobrazit náhled krátkého popisku
        </span>
        <div></div>
        <label class="flex items-center justify-start">
            <div class="flex items-center h-6 px-1 mr-2 bg-white border-2 border-gray-300 rounded-full outline-none w-11">
                <input x-model="customTeaser" type="checkbox" class="absolute opacity-0 switch" />
                <div class="w-4 h-4 transition duration-200 ease-in-out transform bg-gray-300 rounded-full"></div>
            </div>
            <div class="text-blue-gray-500">Vlastní krátký popisek</div>
        </label>
    </div>
    <div x-show="customTeaser" class="py-3 -mt-6 text-sm">
        <x-textarea wire:model.defer="teaser.{{ $lang }}" name="teaser" label="Krátký popisek" placeholder="Teaser" rows="3"/>
    </div>
    <div x-show="showTeaser && !customTeaser" class="p-3 mx-6 mt-2 bg-white">
        <textarea class="w-full text-sm bg-transparent" id="teaser" disabled placeholder="obsah je prazdný" rows="3"></textarea>
    </div>
</div>