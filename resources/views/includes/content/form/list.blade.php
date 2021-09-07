<div 
    class="bg-white border-2 rounded-lg flex-flex-col border-blue-gray-400 border-opacity-20"
>
    @foreach(collect($state)->where('delete', '!=' , true)->where('parent_id', $element['id'])->sortByDesc('order') as $item)
        <button
            wire:click="$set('group', '{{ $item['id'] }}', true)"
            wire:key="{{ $element['id'] . $item['id'] }}"
            type="button" 
            class="{{ $loop->first ? '' : 'border-t-2' }} flex justify-between w-full px-4 py-3 font-medium text-left text-light-blue-500 transition duration-300 group border-blue-gray-400 border-opacity-20 hover:text-light-blue-600"
        >
            <span class="px-1 truncate">
                @if(substr( $item['label'], 0, 1 ) == "!")
                    @php
                        $label = collect($state)->where('parent_id', $item['id'])->where('name', substr( $item['label'], 1, 255 ))->first();
                    @endphp
                    {{ $label['value'][$lang] ?? $loop->iteration }}
                @else
                    {{ $item['label'] }}
                @endif
            </span>
            <svg class="flex-none w-5 h-5 transition duration-300 opacity-0 text-light-blue-400 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    @endforeach
</div>