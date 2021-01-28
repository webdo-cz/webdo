<div class="flex w-full px-4 py-2 mt-6 space-x-2 font-bold bg-blue-gray-200 text-blue-gray-600">
    Galerie
</div>
<div class="p-4 text-sm bg-white">
    <div class="flex space-x-2">
        @foreach($this->state['gallery']['prev'] as $key => $image)
        <div x-data="{ 'show': false }" @keydown.escape="show = false" class="relative inline-block w-20 h-20 bg-gray-700 bg-center bg-cover rounded-lg" style="background-image: url('{{ $image['full_path'] }}')">
            <button wire:click.prevent="removeFrom({{ $key }}, 'prevGallery')" wire:loading.attr="disabled" class="absolute z-10 flex items-center justify-center w-6 h-6 text-xs leading-none text-white transition duration-200 ease-in-out bg-red-500 rounded-full -top-1 -right-1 hover:bg-red-400" type="button" name="button">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <button @click="show = true" class="flex items-center justify-center w-full h-full transition duration-200 ease-in-out opacity-0 hover:opacity-100" type="button" name="button">
                <svg class="h-12 p-2 bg-black rounded-lg opacity-80 text-blue-gray-100" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                </svg>
            </button>
            <div x-show="show" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-black opacity-75"></div>
                </div>
                <img @click.away="show = false" class="absolute max-w-full max-h-screen transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" src="{{ $image['full_path'] }}">
            </div>
        </div>
        @endforeach
        @foreach($this->state['gallery']['new'] as $key => $image)
        <div x-data="{ 'show': false }" @keydown.escape="show = false" class="relative inline-block w-20 h-20 bg-gray-700 bg-center bg-cover rounded-lg" style="background-image: url('{{ $image->temporaryUrl() }}')">
            <button wire:click.prevent="removeFrom({{ $key }}, 'gallery')" wire:loading.attr="disabled" class="absolute z-10 flex items-center justify-center w-6 h-6 text-xs leading-none text-white transition duration-200 ease-in-out bg-red-500 rounded-full -top-1 -right-1 hover:bg-red-400" type="button" name="button">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <button @click="show = true" class="flex items-center justify-center w-full h-full transition duration-200 ease-in-out opacity-0 hover:opacity-100" type="button" name="button">
                <svg class="h-12 p-2 bg-black rounded-lg opacity-80 text-blue-gray-100" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                </svg>
            </button>
            <div x-show="show" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-black opacity-75"></div>
                </div>
                <img @click.away="show = false" class="absolute max-w-full max-h-screen transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" src="{{ $image->temporaryUrl() }}">
            </div>
        </div>
        @endforeach
        <label for="galleryUpload" class="flex flex-col items-center justify-center w-20 h-20 space-y-1 transition duration-200 ease-in-out rounded-lg cursor-pointer bg-blue-gray-300 hover:bg-blue-gray-200 text-blue-gray-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
            </svg>
            <div class="text-xs font-bold text-center">Přidat obrázek</div>
        </label>
        <input id="galleryUpload" type="file" wire:model="galleryUpload" hidden>
    </div>
</div>
