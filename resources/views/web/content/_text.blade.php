<div class="mb-4">
    <p class="px-4 pt-1 text-xs">{{ $item['label'] }}</p>
    <input 
        wire:change="$set('{{ $prefix . $key }}.edited', true, true)"
        wire:model.defer="{{ $prefix . $key }}.value"
        type="text" 
        class="w-full px-4 py-2 text-sm border-b bg-gray-50 focus:outline-none focus:border-light-blue-300" 
        placeholder="{{ $item['label'] }}" 
    />  
</div>