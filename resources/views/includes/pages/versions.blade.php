<div x-show="open == '{{ $page->id }}'" class="px-6 pt-2 bg-white border-t" style="display: none;">
    @foreach($page->contentVersions as $variant)
        <div class="flex items-center justify-between py-3 {{ $loop->first ? '' : 'border-t' }}">
            <div class="text-sm text-gray-400">
                <a 
                    href="{{ url('content/' . $page->id . '/' . $variant->id) }}"
                    @if($variant->type == 'main')
                        class="px-5 py-2 font-semibold text-green-400 group rounded-xl hover:text-green-500"
                    @elseif($variant->type == 'backup')
                        class="px-5 py-2 font-semibold text-yellow-400 group rounded-xl hover:text-yellow-500"
                    @elseif($variant->type == 'import')
                        class="px-5 py-2 font-semibold text-blue-400 group rounded-xl hover:text-blue-500"
                    @else
                        class="px-5 py-2 font-semibold text-gray-400 group rounded-xl hover:text-gray-500"
                    @endif
                >
                    {{ $variant->name }}
                    <svg class="inline-block w-4 h-4 ml-2 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                </a>
                 vytvořena: <span class="text-gray-600">{{ date("H:i d.m.Y", strtotime($page->created_at)) }}</span>
                @if ($page->updated_at != $page->created_at)
                , poslední úprava: <span class="text-gray-600">{{ date("H:i d.m.Y", strtotime($page->updated_at)) }}</span>
                @endif
            </div>
            <div class="flex space-x-3">
                @if($variant->type != 'main')
                <button class="items-center text-green-400 hover:text-green-500 btn">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                    </svg>
                    <span>Sloučit s hlavní verzí</span>
                </button>
                @endif
                <button class="items-center text-red-400 hover:text-red-500 btn">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endforeach
    <div class="flex items-center justify-center py-3 border-t">
        <div class="py-2 text-sm font-semibold text-gray-400 cursor-pointer hover:text-light-blue-400">
            Přidat novou verzi
        </div>
    </div>
</div>