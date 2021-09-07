<div class="p-3" x-show="open">
    <div class="w-full text-sm">
        <label class="pl-4 mb-1 text-sm text-gray-500">
            Selektor
        </label>
        <input 
            wire:model.lazy="state.{{ $element['id'] }}.name"
            type="text" 
            class="w-full px-4 py-2 text-gray-900 bg-white border-2 rounded-lg form focus:outline-none border-blue-gray-400 border-opacity-20"
        >
    </div>
    <div class="w-full text-sm">
        <label class="pl-4 mb-1 text-sm text-gray-500">
            Label
        </label>
        <input 
            wire:model.lazy="state.{{ $element['id'] }}.label"
            type="text" 
            class="w-full px-4 py-2 text-gray-900 bg-white border-2 rounded-lg form focus:outline-none border-blue-gray-400 border-opacity-20"
        >
    </div>
</div>