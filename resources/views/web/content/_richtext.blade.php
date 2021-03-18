<div class="relative h-20 bg-gray-50">
    <div class="absolute flex items-center justify-center w-full h-20">
        <button 
            wire:click="openModal({{ $item }})"
            type="button" 
            class="z-10 bg-white border btn text-light-blue-500 hover:text-light-blue-800"
        >
            Upravit text
        </button>
    </div>
    <div class="w-full px-6 py-4 text-sm text-gray-400">
        @if(isset($state[$item]['value'][$lang]))
            {!! mb_substr(strip_tags($state[$item]['value'][$lang]), 0, 100) !!}...
        @endif
    </div>
</div>