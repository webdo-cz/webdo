<div class="relative flex items-center space-x-2">
    <div wire:loading wire:target="state.{{ $element['id'] }}.upload.{{ $lang }}">
        <div class="absolute inset-0 flex items-center justify-center bg-gray-50 bg-opacity-70">
            <svg class="w-8 h-8 animate-spin" wire:loading.class.remove="hidden" wire:target="submit" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.75 22c0 .966-.783 1.75-1.75 1.75s-1.75-.784-1.75-1.75.783-1.75 1.75-1.75 1.75.784 1.75 1.75zm-1.75-22c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm10 10.75c.689 0 1.249.561 1.249 1.25 0 .69-.56 1.25-1.249 1.25-.69 0-1.249-.559-1.249-1.25 0-.689.559-1.25 1.249-1.25zm-22 1.25c0 1.105.896 2 2 2s2-.895 2-2c0-1.104-.896-2-2-2s-2 .896-2 2zm19-8c.551 0 1 .449 1 1 0 .553-.449 1.002-1 1-.551 0-1-.447-1-.998 0-.553.449-1.002 1-1.002zm0 13.5c.828 0 1.5.672 1.5 1.5s-.672 1.501-1.502 1.5c-.826 0-1.498-.671-1.498-1.499 0-.829.672-1.501 1.5-1.501zm-14-14.5c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2zm0 14c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2z"/>
            </svg>
        </div>
    </div>
    @if($element['upload'][$lang] ?? null)
        <img src="{{ $element['upload'][$lang]->temporaryUrl() }}" class="flex-none object-cover w-20 h-20 bg-gray-200 rounded-lg">
    @elseif(($element['value'][$lang] ?? null) && !($element['delete-file'][$lang] ?? false))
        <img src="{{ asset('storage/files/' . $element['value'][$lang]) }}" class="flex-none object-cover w-20 h-20 bg-gray-200 rounded-lg">
    @else
        <div class="flex items-center justify-center flex-none w-20 h-20 bg-gray-100 rounded">
            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>
    @endif
    <div class="flex-grow">
        <label 
            for="imgupload{{ $element['id'] }}" 
            class="block w-full px-4 py-2 mb-2 font-medium text-center transition duration-300 rounded-lg cursor-pointer bg-light-blue-100 text-light-blue-500 group hover:text-light-blue-600"
        >
            Nahrát obrázek
        </label>
        <input wire:model.defer="state.{{ $element['id'] }}.upload.{{ $lang }}" id="imgupload{{ $element['id'] }}" type="file" hidden>
        @if($element['upload'][$lang] ?? null)
            <button
                wire:click="$set('state.{{ $element['id'] }}.upload.{{ $lang }}', null)"
                type="button"
                class="w-full px-4 font-medium text-left transition duration-300 text-light-blue-400 hover:text-light-blue-500"
            >
                Vratit zpět
            </button>
        @elseif(($element['value'][$lang] ?? null) && !($element['delete-file'][$lang] ?? false))
            <button
                wire:click="$set('state.{{ $element['id'] }}.delete-file.{{ $lang }}', true)"
                type="button" 
                class="w-full px-4 font-medium text-left text-red-400 transition duration-300 hover:text-red-500"
            >
                Smazat
            </button>
        @elseif($element['delete-file'][$lang] ?? false)
            <button
                wire:click="$set('state.{{ $element['id'] }}.delete-file.{{ $lang }}', false)"
                type="button"
                class="w-full px-4 font-medium text-left transition duration-300 text-light-blue-400 hover:text-light-blue-500"
            >
                Vratit zpět
            </button>
        @endif
    </div>
</div>