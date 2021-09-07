<div class="w-full py-2 mb-4 text-sm">
    <button 
        wire:click="$set('group', '{{ $element['id'] }}', true)" 
        type="button"
        class="flex justify-between w-full px-4 py-3 font-medium text-left transition duration-300 bg-white border-2 border-gray-400 rounded-lg text-light-blue-500 group border-opacity-20 hover:text-light-blue-600"
    >
        <span class="pl-1">{{ $element['label'] }}</span>
        <svg class="w-5 h-5 transition duration-300 opacity-0 text-light-blue-400 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
</div>