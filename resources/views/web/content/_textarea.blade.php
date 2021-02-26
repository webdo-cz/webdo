<textarea
    wire:model.defer="state.{{ $item }}.value.{{ $lang }}" 
    class="w-full px-4 py-2 text-sm border-b bg-gray-50 focus:outline-none focus:border-light-blue-300" 
    placeholder="{{ $state[$item]['label'] }}"
></textarea> 