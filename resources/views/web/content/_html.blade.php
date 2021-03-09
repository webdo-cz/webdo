<div class="flex h-16">
    <div class="flex items-center justify-center w-full h-16 bg-gray-50">
        <button 
            wire:click="openModal({{ $item }})"
            type="button"
            class="z-10 bg-white border cursor-pointer btn text-light-blue-500 hover:text-light-blue-800"
        >
            Upravit HTML
        </button>
    </div>
</div>