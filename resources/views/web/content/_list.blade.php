<div class="w-full px-3 py-3 space-y-2 text-sm bg-gray-50">
    @forelse (isset($state[$item]['children']) ? collect($state[$item]['children'])->sortByDesc('order')->all() : [] as $key => $children)
        <button
            type="button" 
            wire:click="showGroup('{{ $children['id'] }}')" 
            class="block w-full px-4 py-2 font-semibold truncate bg-white border cursor-pointer rounded-xl text-light-blue-500 hover:text-light-blue-800"
        >
            {{ $children['label'] }}
        </button>
    @empty
        <p class="text-xs text-center text-gray-400">
            List je prázdný
        </p>
    @endforelse
</div>