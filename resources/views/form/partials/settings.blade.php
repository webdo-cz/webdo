<div x-show="openSettings" class="fixed inset-0 z-30 bg-blue-gray-800 opacity-10"></div>
<div x-show="openSettings" @click.away="openSettings = false" class="fixed top-0 right-0 z-40 min-h-screen bg-white w-96" style="display: none">
    <div class="relative flex items-center justify-between px-10 py-8 bg-gradient-to-r from-cyan-300 to-light-blue-400">
        <div>
            <h3 class="text-xl font-semibold">Nastavení</h3>
            <p class="text-sm">Upravte nastavení vašeho produktu</p>
        </div>
        <button @click="openSettings = false" class="flex items-center justify-center w-10 h-10 rounded-full opacity-50 cursor-pointer hover:bg-light-blue-500 text-light-blue-800" type="button">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <div class="px-10 py-10">
        <h4 class="pb-2 mb-4 text-lg font-bold border-b">Vlastnosti</h4>
        <div class="relative flex justify-between mb-2 text-sm" x-data="{ status: false }">
            <p>Stav:</p>
            <p @click="status = !status" class="font-bold">{{ __('form.settings.detail-' . $state['status']) }}</p>
            <div x-show="status" @click.away="status = false" class="absolute right-0 z-30 flex flex-col bg-white shadow-xl top-8 rounded-xl text-blue-gray-400">
                <div class="w-full px-4 py-3 font-bold text-white rounded-t-lg bg-blue-gray-400">
                    Nastavit stav
                </div>
                <button @click="status = false" class="absolute top-0 right-0 flex items-center justify-center w-10 h-8 pt-1 mt-1 text-blue-gray-500 hover:text-blue-gray-700" type="button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <div class="px-6 py-4">
                    <label class="flex items-stretch justify-start mt-2 mb-4">
                        <div class="flex items-center justify-center w-5 h-5 mt-1 mr-2 bg-white border-2 border-gray-300 rounded-full focus-within:border-blue-500">
                            <input wire:model="state.status" type="radio" class="absolute opacity-0 radio" value="published"/>
                            <div class="w-2 h-2 transition duration-200 ease-in-out transform rounded-full opacity-0 bg-light-blue-500"></div>
                        </div>
                        <div class="w-48 text-blue-gray-500">
                            <p class="font-bold text-blue-gray-800">{{ __('form.settings.detail-published') }}</p>
                            <p>{{ __('form.settings.detail-published-description') }}</p>
                        </div>
                    </label>
                    <label class="flex items-start justify-start mb-4">
                        <div class="flex items-center justify-center w-5 h-5 mt-1 mr-2 bg-white border-2 border-gray-300 rounded-full focus-within:border-blue-500">
                            <input wire:model="state.status" type="radio" class="absolute opacity-0 radio" value="hidden"/>
                            <div class="w-2 h-2 transition duration-200 ease-in-out transform rounded-full opacity-0 bg-light-blue-500"></div>
                        </div>
                        <div class="w-48 text-blue-gray-500">
                            <p class="font-bold text-blue-gray-800">{{ __('form.settings.detail-hidden') }}</p>
                            <p>{{ __('form.settings.detail-hidden-description') }}</p>
                        </div>
                    </label>
                    <label class="flex items-start justify-start mb-4">
                        <div class="flex items-center justify-center w-5 h-5 mt-1 mr-2 bg-white border-2 border-gray-300 rounded-full focus-within:border-blue-500">
                            <input wire:model="state.status" type="radio" class="absolute opacity-0 radio" value="non-published"/>
                            <div class="w-2 h-2 transition duration-200 ease-in-out transform rounded-full opacity-0 bg-light-blue-500"></div>
                        </div>
                        <div class="w-48 text-blue-gray-500">
                            <p class="font-bold text-blue-gray-800">{{ __('form.settings.detail-non-published') }}</p>
                            <p>{{ __('form.settings.detail-non-published-description') }}</p>
                        </div>
                    </label>
                    <label class="flex items-start justify-start">
                        <div class="flex items-center justify-center w-5 h-5 mt-1 mr-2 bg-white border-2 border-gray-300 rounded-full focus-within:border-blue-500">
                            <input wire:model="state.status" type="radio" class="absolute opacity-0 radio" value="unavailable"/>
                            <div class="w-2 h-2 transition duration-200 ease-in-out transform rounded-full opacity-0 bg-light-blue-500"></div>
                        </div>
                        <div class="w-48 text-blue-gray-500">
                            <p class="font-bold text-blue-gray-800">{{ __('form.settings.detail-unavailable') }}</p>
                            <p>{{ __('form.settings.detail-unavailable-description') }}</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="relative flex justify-between mb-2 text-sm" x-data="{ published: false }">
            <p>Publikováno:</p>
            <p @click="published = !published" class="font-bold">
                @if(isset($state['published_at'])) 
                    {{ date("H:i d.m.Y", strtotime($state['published_at'])) }} 
                @else 
                    aktualní čas
                @endif
            </p>
            <div wire:ignore x-show="published" @click.away="published = false" class="absolute right-0 z-30 flex flex-col pb-5 bg-white shadow-xl top-8 rounded-xl text-blue-gray-600">
                <div class="w-full px-4 py-3 mb-2 font-bold text-white rounded-t-lg bg-blue-gray-400">
                    Nastavit datum a čas publikování
                </div>
                <button @click="published = false" class="absolute top-0 right-0 flex items-center justify-center w-10 h-8 pt-1 mt-1 text-blue-gray-500 hover:text-blue-gray-700" type="button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <div class="px-4">
                    <input type="text" id="published" hidden value="{{ isset($state['published_at']) ? $state['published_at'] : null }}"/>
                    <script>
                        document.addEventListener('DOMContentLoaded', (event) => {
                            flatpickr("#published", {
                                enableTime: true,
                                time_24hr: true,
                                inline: true,
                                "locale": "cs"
                            });
                        });
                    </script>                  
                </div>
                <div class="flex mx-6 mt-4 space-x-2">
                    <button wire:click="$set('state.published_at', document.getElementById('published').value)" @click="published = false" class="justify-center flex-grow btn-success" type="button">Nastavit</button>
                    <button wire:click="$set('state.published_at', null)" @click="published = false" class="btn-primary" type="button">
                        akt. čas
                    </button>
                </div>
            </div>
        </div>

        <div x-data="{ showMore: [] }">
            @foreach (config('option.term', []) as $key => $termType)
                <h4 class="pb-2 mt-8 mb-4 text-lg font-bold border-b">{{ $termType }}</h4>
                @forelse ($terms->where('type', $key) as $term)
                    <label @if($loop->index > 2) x-show.transition="showMore.{{ $key }}"@endif class="flex items-center justify-start mb-2">
                        <div class="flex items-center justify-center w-5 h-5 mr-2 bg-white border-2 border-gray-300 rounded focus-within:border-blue-500">
                            <input type="checkbox" class="absolute opacity-0 checkbox" value="{{ $term->id }}" wire:model.defer="state.terms"/>
                            <svg class="w-3 h-3 transition duration-200 ease-in-out transform opacity-0 fill-current text-light-blue-500" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /></svg>
                        </div>
                        <div class="text-blue-gray-500">{{ $term->name }}</div>
                    </label>
                @empty 
                    <div class="text-gray-400">List je prazdný</div>
                @endforelse
                @if($terms->where('type', $key)->count() > 3)
                    <div @click="showMore.{{ $key }} = !showMore.{{ $key }}" class="mb-2 text-sm text-center text-gray-600 cursor-pointer hover:text-light-blue-500">
                        <p x-show="!showMore.{{ $key }}" class="font-bold">Zobrazit více</p>
                        <p x-show="showMore.{{ $key }}" class="font-bold">Zobrazit méně</p>
                    </div>
                @endif  
            @endforeach
        </div>

        <div x-data="{ thumbnail: 'static' }">
            <h4 class="flex items-center justify-between pb-2 mt-8 mb-4 text-lg font-bold border-b">
                Náhledový obrázek
            </h4>
            <div class="flex mb-4">
                <div class="flex space-x-1 rounded-lg bg-light-blue-200 bg-opacity-60">
                    <button 
                        @click="thumbnail = 'static'"
                        type="button"
                        class="flex items-center px-4 py-2 text-sm font-semibold rounded-lg cursor-pointer focus:outline-none"
                        :class="{ 'bg-light-blue-500 text-white': thumbnail == 'static', 'hover:bg-light-blue-200 text-light-blue-500': thumbnail != 'static' }"
                    >
                        <span>Statický</span>
                    </button>
                    <button 
                        @click="thumbnail = 'hover'"
                        type="button"
                        class="flex items-center px-4 py-2 text-sm font-semibold rounded-lg cursor-pointer focus:outline-none"
                        :class="{ 'bg-light-blue-500 text-white': thumbnail == 'hover', 'hover:bg-light-blue-200 text-light-blue-500': thumbnail != 'hover' }"
                    >
                        <span>Po najetí myši</span>
                    </button>
                </div>
            </div>
            <div x-show="thumbnail == 'static'" class="flex items-center justify-between space-x-2">
                @if(!empty($state['thumbnail']['static']))
                    <div class="w-24 h-24 bg-center bg-cover bg-blue-gray-200 rounded-2xl" style="background-image: url('{{ $state['thumbnail']['static']->temporaryUrl() }}')"></div>
                @elseif(!empty($state['thumbnail']['prev-static']))
                    <div class="w-24 h-24 bg-center bg-cover bg-blue-gray-200 rounded-2xl" style="background-image: url('{{ $state['thumbnail']['prev-static']['full_path'] }}')"></div>
                @endif
                <div class="space-y-2 text-right">
                    <label class="px-4 py-2 text-sm font-semibold text-white bg-blue-gray-400 hover:bg-blue-gray-500 rounded-xl">
                        @if(!empty($state['thumbnail']['static']) || !empty($state['thumbnail']['prev-static']))
                            <span>Nahrát nový</span>
                        @else
                            <span>Nahrat náhledový obrázek</span>
                        @endif
                        <input type="file" wire:model.defer="state.thumbnail.static" hidden>
                    </label>
                    @if(!empty($state['thumbnail']['static']))
                        <button wire:click="$set('state.thumbnail.static', null)" class="px-4 py-2 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl">Odstranit</button>
                    @elseif(!empty($state['thumbnail']['prev-static']))
                        <button wire:click="$set('state.thumbnail.prev-static', null)" class="px-4 py-2 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl">Odstranit</button>
                    @endif
                </div>
            </div>
            <div x-show="thumbnail == 'hover'" class="flex items-center justify-between space-x-2">
                @if(!empty($state['thumbnail']['hover']))
                    <div class="w-24 h-24 bg-center bg-cover bg-blue-gray-200 rounded-2xl" style="background-image: url('{{ $state['thumbnail']['hover']->temporaryUrl() }}')"></div>
                @elseif(!empty($state['thumbnail']['prev-hover']))
                    <div class="w-24 h-24 bg-center bg-cover bg-blue-gray-200 rounded-2xl" style="background-image: url('{{ $state['thumbnail']['prev-hover']['full_path'] }}')"></div>
                @endif
                <div class="space-y-2 text-right">
                    <label class="px-4 py-2 text-sm font-semibold text-white bg-blue-gray-400 hover:bg-blue-gray-500 rounded-xl">
                        @if(!empty($state['thumbnail']['hover']) || !empty($state['thumbnail']['prev-hover']))
                            <span>Nahrát nový</span>
                        @else
                            <span>Nahrat náhledový obrázek</span>
                        @endif
                        <input type="file" wire:model.defer="state.thumbnail.hover" hidden>
                    </label>
                    @if(!empty($state['thumbnail']['hover']))
                        <button wire:click="$set('state.thumbnail.hover', null)" class="px-4 py-2 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl">Odstranit</button>
                    @elseif(!empty($state['thumbnail']['prev-hover']))
                        <button wire:click="$set('state.thumbnail.prev-hover', null)" class="px-4 py-2 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl">Odstranit</button>
                    @endif
                </div>
            </div>
        </div>

        <h4 class="pb-2 mt-8 mb-4 text-lg font-bold border-b">Vlastní URL</h4>
        <div class="flex text-sm">
            <div class="z-10 flex items-center pl-4 pr-2 text-gray-500 rounded-l-lg bg-blue-gray-200">adresa/</div>
            <input 
                wire:model.defer="state.slug" 
                type="text"
                placeholder="vlastni-url"
                class="w-full px-4 py-2 bg-white border-2 rounded-r-lg form focus:outline-none border-blue-gray-200" 
            />                
        </div>
    </div>
</div>