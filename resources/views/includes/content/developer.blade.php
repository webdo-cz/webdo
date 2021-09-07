@if($group)
    <div class="p-4 mx-5 space-y-1 text-gray-400 bg-gray-100 rounded-b-lg cursor-default">
        <div class="w-full text-sm">
            <label class="pl-4 mb-1 text-sm text-gray-500">
                Selektor
            </label>
            <input 
                wire:model.lazy="state.{{ $group }}.name"
                type="text"
                class="w-full px-4 py-2 text-gray-900 bg-white border-2 rounded-lg form focus:outline-none border-blue-gray-400 border-opacity-20"
            >
        </div>
        <div class="w-full pb-2 text-sm">
            <label class="pl-4 mb-1 text-sm text-gray-500">
                Label
            </label>
            <input 
                wire:model.lazy="state.{{ $group }}.label"
                type="text"
                class="w-full px-4 py-2 text-gray-900 bg-white border-2 rounded-lg form focus:outline-none border-blue-gray-400 border-opacity-20"
            >
        </div>
    </div>
@endif
<div class="p-5">
    <div wire:sortable="handleSortOrderChange" wire:sortable-group="handleSortOrderChange">
        @foreach(collect($state)->where('parent_id', $group)->sortByDesc('order') as $key => $element)
            <div 
                wire:sortable.item="{{ $element['id'] }}"
                wire:key="developer{{ $element['id'] }}"
            >
                <div 
                    x-data="{ open: false }"
                    @open-item.window="if($event.detail.open != '{{ $element['id'] }}'){ open = false }"
                    class="flex flex-col-reverse w-full max-w-xs mb-4 text-sm"
                >
                    <div class="p-1 -mt-2 space-y-1 text-gray-400 bg-gray-100 rounded-b-lg cursor-default draggable-mirror-hide">

                        @include('includes.content.developer.form')

                        @if($element['type'] == 'list' && !($state[$element['id']]['delete'] ?? false))
                            <div class="p-3" x-show="!open">
                                @include('includes.content.developer.list')
                            </div>
                        @endif
                    </div>

                    @include('includes.content.developer.item')
                </div>
            </div>
        @endforeach
    </div>
    @if(($state[$group]['type'] ?? null) == 'list')
        @include('includes.content.developer.add-group')
    @else
        @include('includes.content.developer.add-element')
    @endif
    
</div>