<div class="flex">
    @include('web.content.modal')
    <div class="flex-none h-screen px-4 py-6 overflow-auto bg-white border-r w-80" x-data="{ developer: false }">
        <div>
            @if($confirmDelete)
                <div class="fixed inset-0 z-50 w-full min-h-screen px-8 py-3 bg-opacity-50 bg-blue-gray-800 sm:bottom-auto">
                    <div class="shadow-lg bg-blue-gray-100 rounded-3xl sm:max-w-xl sm:mx-auto">
                        <div class="flex items-center px-3 py-3 bg-white shadow-sm sm:px-6 rounded-3xl">
                            <div class="mr-3 sm:mr-5">
                                <div class="flex items-center justify-center w-10 h-10 text-red-500 bg-red-100 rounded-full">

                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-grow text-gray-700">
                                <p class="font-bold">Odstranit uživatele</p>
                                <p class="text-sm">Opravdu chcete uživatele odstranit? Nebude ho již možno nijak obnovit.</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-end px-6 py-2 space-x-2 text-sm">
                            <button wire:click="$set('confirmDelete', null)" class="px-4 py-2 font-semibold text-gray-600 hover:bg-blue-gray-200 rounded-xl ">Zrušit</button>
                            <button wire:click="delete({{ $confirmDelete }})" class="px-4 py-2 font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl">Odstranit</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="flex items-center justify-between pb-6 border-b">
            @if($parent && $parent != $group)
                <div class="flex items-center">
                    <button type="button" wire:click="back" class="p-2 border rounded-xl hover:text-light-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </button>
                    <p class="ml-4 font-bold">Úprava textů</p>
                </div>
            @else
                <div class="flex items-center">
                    <a href="{{ url('web/pages') }}" class="p-2 border rounded-xl hover:text-light-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </a>
                    <p class="ml-4 font-bold">Úprava textů</p>
                </div>
                <button wire:click="submit" type="button" class="shadow-sm btn-primary">
                    Uložit
                </button>
            @endif
        </div>
        <div class="flex items-center justify-between mb-6 border-b">
            <div x-data="{ open: false, lang: @entangle('lang') }" class="relative px-4 py-3 border-r">
                <div @click="open = !open" class="text-sm">
                    
                </div>
                <button type="button" @click="open = !open" class="flex items-center text-sm text-gray-400 hover:text-gray-600">
                    <img x-show="lang == 'cs'" class="h-6 mr-2" src="{{ asset('img/icons/cs.svg') }}">
                    <img x-show="lang == 'sk'" class="h-6 mr-2" src="{{ asset('img/icons/sk.svg') }}" style="display: none">
                    <img x-show="lang == 'en'" class="h-6 mr-2" src="{{ asset('img/icons/en.svg') }}" style="display: none">
                    <img x-show="lang == 'pl'" class="h-6 mr-2" src="{{ asset('img/icons/pl.svg') }}" style="display: none">
                    <img x-show="lang == 'hu'" class="h-6 mr-2" src="{{ asset('img/icons/hu.svg') }}" style="display: none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" class="absolute left-0 z-30 flex flex-col text-sm shadow-md bg-blue-gray-800 top-16 rounded-xl text-blue-gray-400 whitespace-nowrap" style="display: none">
                    <span @click="open = false, lang = 'cs'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-blue-gray-700 hover:text-white rounded-t-xl">Čeština</span>
                    <span @click="open = false, lang = 'sk'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-blue-gray-700 hover:text-white">Slovenština</span>
                    <span @click="open = false, lang = 'en'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-blue-gray-700 hover:text-white">Angličtina</span>
                    <span @click="open = false, lang = 'pl'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-blue-gray-700 hover:text-white">Polština</span>
                    <span @click="open = false, lang = 'hu'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-blue-gray-700 hover:text-white rounded-b-xl">Maďarština</span>
                </div>
            </div>
            <button 
                type="button" 
                @click="developer = !developer" 
                class="flex items-center pr-4 text-sm font-semibold text-gray-400 hover:text-gray-500"
                :class="{ 'text-light-blue-400 hover:text-light-blue-400': developer }"
            >
                <div class="flex items-center justify-center w-5 h-5 mr-2 bg-white border-2 rounded-full">
                    <div x-show="developer" class="w-2 h-2 rounded-full bg-light-blue-400" style="display: none"></div>
                </div>
                Developer
            </button>
        </div>
        <div x-show="!developer">
            @foreach ($form as $key => $item)
                <div class="mb-4">
                    <p class="px-4 pt-1 mb-1 text-xs">
                        {{ $state[$item]['label'] ? $state[$item]['label'] : $state[$item]['name'] }}
                    </p>
                    @switch($state[$item]['type'])
                        @case('html')
                            @include('web.content._html')
                            @break
                        @case('richtext')
                            @include('web.content._richtext')
                            @break
                        @case('textarea')
                            @include('web.content._textarea')
                            @break
                        @case('image')
                            @include('web.content._image')
                            @break
                        @case('list')
                            @include('web.content._list')
                            @break
                        @default
                            @include('web.content._text')
                    @endswitch 
                </div>
            @endforeach 
        </div>
        <div x-show="developer" style="display: none">
            <p class="px-4 pb-4 text-sm italic text-gray-400">
                Toto zobrazení slouží pro nastavení pořadí, smazání elmentů, úpravě jejich popisků, které jsou použity v administraci nebo případné smazání. 
            </p>
            <x-laravel-blade-sortable::sortable
                drag-handle="drag-handle"
                wire:onSortOrderChange="handleSortOrderChange"
            >
                @foreach ($form as $key => $item)
                    <x-laravel-blade-sortable::sortable-item 
                        class="mb-4" 
                        sort-key="{{ $item }}"
                        wire:key="{{ $item }}"
                    >
                        <p class="px-4 pt-1 mb-1 text-xs">
                            {{ $state[$item]['name'] }}
                        </p>
                        <div class="flex h-10">
                            <div class="flex items-center justify-center w-12 h-full text-gray-500 bg-gray-100 border-r drag-handle">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </div>
                            <input 
                                wire:model.lazy="state.{{ $item }}.label" 
                                type="text" 
                                class="w-full px-4 py-2 text-sm border-b bg-gray-50 focus:outline-none focus:border-light-blue-300" 
                                placeholder="Popisek" 
                            />
                            <div wire:click="$set('confirmDelete', '{{ $item }}')" class="flex items-center justify-center w-12 h-full text-red-400 bg-red-100 border-l border-red-200 hover:text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </div>
                        </div>
                        @if($state[$item]['type'] == 'list')
                            <div class="w-full px-3 py-3 space-y-2 text-sm bg-gray-50" wire:ignore.self>
                                <x-laravel-blade-sortable::sortable
                                    drag-handle="drag-handle"
                                    wire:onSortOrderChange="handleChildrenSortOrderChange"
                                >
                                    @foreach (isset($state[$item]['children']) ? collect($state[$item]['children'])->sortByDesc('order')->all() : [] as $key => $children)
                                        <x-laravel-blade-sortable::sortable-item 
                                            class="flex w-full mb-4 bg-white border rounded-xl" 
                                            sort-key="{{ $children['id'] }}"
                                            wire:key="{{ $key . $children['id'] }}"
                                        >
                                            <div class="flex items-center justify-center w-12 text-gray-500 bg-gray-100 border-r h-9 rounded-l-xl drag-handle">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                                </svg>
                                            </div>
                                            <div
                                                wire:click="showGroup('{{ $children['id'] }}')"
                                                class="block w-full px-4 py-2 font-semibold truncate bg-white cursor-pointer text-light-blue-500 hover:text-light-blue-800"
                                            >
                                                @if(substr( $children['label'], 0, 1 ) == "!")
                                                    @php
                                                        $label = collect($state[$children['id']]['children'])->where('name', substr( $children['label'], 1, 255 ))->first();
                                                    @endphp
                                                    @if($label && isset($label['value'][$lang]))
                                                        {{ $label['value'][$lang] }}
                                                    @else
                                                        {{ $key+1 }}
                                                    @endif
                                                @else
                                                    {{ $children['label'] }}
                                                @endif
                                            </div>
                                            <div wire:click="$set('confirmDelete', '{{ $children['id'] }}')" class="flex items-center justify-center w-12 text-red-400 bg-red-100 border-l border-red-200 h-9 rounded-r-xl hover:text-red-600">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </div>
                                        </x-laravel-blade-sortable::sortable-item>
                                    @endforeach
                                </x-laravel-blade-sortable::sortable>
                                <div wire:click="$set('add', { open: true, type: null, parent_id: '{{ $item }}' })" class="w-full px-4 py-2 mb-4 text-sm font-semibold text-center text-gray-500 bg-white cursor-pointer rounded-xl hover:text-gray-600">
                                    Vytvořit nový blok
                                </div>
                            </div>
                        @endif
                    </x-laravel-blade-sortable::sortable-item>
                @endforeach
            </x-laravel-blade-sortable::sortable>
        </div>
        <div x-show="developer" style="display: none">
            <div x-data="{ type: @entangle('add.type').defer, open: @entangle('add.open').defer }">
                <div wire:click="$set('add', { open: true, type: null })" class="px-6 py-4 mt-6 text-sm font-semibold leading-7 text-center text-gray-400 border cursor-pointer bg-gray-50 hover:text-light-blue-500">
                    Vytvořit nový blok
                </div>
                @include('web.content.add')
            </div>
        </div>
    </div>
    <div class="flex-grow">
        <iframe src="{{ config('option.frontend_url') }}" class="w-full h-full p-0 m-0 overflow-hidden bg-white border-0" scrolling="yes">
            Your browser doesn't support iframes
        </iframe>
    </div>
</div>
