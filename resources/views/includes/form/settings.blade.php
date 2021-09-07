<div class="px-6 py-10">
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
                    <div class="flex items-center justify-center w-5 h-5 mr-2 bg-white border-2 border-gray-300 rounded focus-within:border-gray-300">
                        <input type="checkbox" class="absolute opacity-0 checkbox" value="{{ $term->id }}" wire:model.defer="state.terms"/>
                        <svg class="w-3 h-3 transition duration-200 ease-in-out transform opacity-0 fill-current text-light-blue-500" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z" /></svg>
                    </div>
                    <div class="text-blue-gray-500">{{ $term->name }}</div>
                </label>
            @empty 
                <div class="text-sm text-gray-400">List je prazdný</div>
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
        <div x-show="thumbnail == 'static'">
            <div class="relative flex items-center space-x-2">
                <div wire:loading wire:target="state.thumbnail.static">
                    <div class="absolute inset-0 flex items-center justify-center bg-gray-50 bg-opacity-70">
                        <svg class="w-8 h-8 animate-spin" wire:loading.class.remove="hidden" wire:target="submit" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.75 22c0 .966-.783 1.75-1.75 1.75s-1.75-.784-1.75-1.75.783-1.75 1.75-1.75 1.75.784 1.75 1.75zm-1.75-22c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm10 10.75c.689 0 1.249.561 1.249 1.25 0 .69-.56 1.25-1.249 1.25-.69 0-1.249-.559-1.249-1.25 0-.689.559-1.25 1.249-1.25zm-22 1.25c0 1.105.896 2 2 2s2-.895 2-2c0-1.104-.896-2-2-2s-2 .896-2 2zm19-8c.551 0 1 .449 1 1 0 .553-.449 1.002-1 1-.551 0-1-.447-1-.998 0-.553.449-1.002 1-1.002zm0 13.5c.828 0 1.5.672 1.5 1.5s-.672 1.501-1.502 1.5c-.826 0-1.498-.671-1.498-1.499 0-.829.672-1.501 1.5-1.501zm-14-14.5c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2zm0 14c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2z"/>
                        </svg>
                    </div>
                </div>
                @if($state['thumbnail']['static'] ?? null)
                    <img src="{{ $state['thumbnail']['static']->temporaryUrl() }}" class="flex-none object-cover w-20 h-20 bg-gray-200 rounded-lg">
                @elseif(($state['thumbnail']['prev-static'] ?? null) && !($state['thumbnail']['prev-static']['delete'] ?? false))
                    <img src="{{ $state['thumbnail']['prev-static']['full_path'] }}" class="flex-none object-cover w-20 h-20 bg-gray-200 rounded-lg">
                @else
                    <div class="flex items-center justify-center flex-none w-20 h-20 bg-gray-100 rounded">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
                <div class="flex-grow">
                    <label 
                        for="thumbnail-static" 
                        class="block w-full px-4 py-2 mb-2 text-sm font-medium text-center text-white transition duration-300 rounded-lg cursor-pointer bg-blue-gray-400 hover:bg-blue-gray-500"
                    >
                        Nahrát obrázek
                    </label>
                    <input wire:model.defer="state.thumbnail.static" id="thumbnail-static" type="file" hidden>
                    @if($state['thumbnail']['static'] ?? null)
                        <button
                            wire:click="$set('state.thumbnail.static', null)"
                            type="button"
                            class="w-full px-4 text-sm font-medium text-left transition duration-300 text-light-blue-400 hover:text-light-blue-500"
                        >
                            Vratit zpět
                        </button>
                    @elseif(($state['thumbnail']['prev-static'] ?? null) && !($state['thumbnail']['prev-static']['delete'] ?? false))
                        <button
                            wire:click="$set('state.thumbnail.prev-static.delete', true)"
                            type="button" 
                            class="w-full px-4 text-sm font-medium text-left text-red-400 transition duration-300 hover:text-red-500"
                        >
                            Smazat
                        </button>
                    @elseif($state['thumbnail']['prev-static']['delete'] ?? false)
                        <button
                            wire:click="$set('state.thumbnail.prev-static.delete', false)"
                            type="button"
                            class="w-full px-4 text-sm font-medium text-left transition duration-300 text-light-blue-400 hover:text-light-blue-500"
                        >
                            Vratit zpět
                        </button>
                    @endif
                </div>
            </div>
        </div>
        <div x-show="thumbnail == 'hover'">
            <div class="relative flex items-center space-x-2">
                <div wire:loading wire:target="state.thumbnail.hover">
                    <div class="absolute inset-0 flex items-center justify-center bg-gray-50 bg-opacity-70">
                        <svg class="w-8 h-8 animate-spin" wire:loading.class.remove="hidden" wire:target="submit" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.75 22c0 .966-.783 1.75-1.75 1.75s-1.75-.784-1.75-1.75.783-1.75 1.75-1.75 1.75.784 1.75 1.75zm-1.75-22c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm10 10.75c.689 0 1.249.561 1.249 1.25 0 .69-.56 1.25-1.249 1.25-.69 0-1.249-.559-1.249-1.25 0-.689.559-1.25 1.249-1.25zm-22 1.25c0 1.105.896 2 2 2s2-.895 2-2c0-1.104-.896-2-2-2s-2 .896-2 2zm19-8c.551 0 1 .449 1 1 0 .553-.449 1.002-1 1-.551 0-1-.447-1-.998 0-.553.449-1.002 1-1.002zm0 13.5c.828 0 1.5.672 1.5 1.5s-.672 1.501-1.502 1.5c-.826 0-1.498-.671-1.498-1.499 0-.829.672-1.501 1.5-1.501zm-14-14.5c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2zm0 14c1.104 0 2 .896 2 2s-.896 2-2.001 2c-1.103 0-1.999-.895-1.999-2s.896-2 2-2z"/>
                        </svg>
                    </div>
                </div>
                @if($state['thumbnail']['hover'] ?? null)
                    <img src="{{ $state['thumbnail']['hover']->temporaryUrl() }}" class="flex-none object-cover w-20 h-20 bg-gray-200 rounded-lg">
                @elseif(($state['thumbnail']['prev-hover'] ?? null) && !($state['thumbnail']['prev-hover']['delete'] ?? false))
                    <img src="{{ $state['thumbnail']['prev-hover']['full_path'] }}" class="flex-none object-cover w-20 h-20 bg-gray-200 rounded-lg">
                @else
                    <div class="flex items-center justify-center flex-none w-20 h-20 bg-gray-100 rounded">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
                <div class="flex-grow">
                    <label 
                        for="thumbnail-hover" 
                        class="block w-full px-4 py-2 mb-2 text-sm font-medium text-center text-white transition duration-300 rounded-lg cursor-pointer bg-blue-gray-400 hover:bg-blue-gray-500"
                    >
                        Nahrát obrázek
                    </label>
                    <input wire:model.defer="state.thumbnail.hover" id="thumbnail-hover" type="file" hidden>
                    @if($state['thumbnail']['hover'] ?? null)
                        <button
                            wire:click="$set('state.thumbnail.hover', null)"
                            type="button"
                            class="w-full px-4 text-sm font-medium text-left transition duration-300 text-light-blue-400 hover:text-light-blue-500"
                        >
                            Vratit zpět
                        </button>
                    @elseif(($state['thumbnail']['prev-hover'] ?? null) && !($state['thumbnail']['prev-hover']['delete'] ?? false))
                        <button
                            wire:click="$set('state.thumbnail.prev-hover.delete', true)"
                            type="button" 
                            class="w-full px-4 text-sm font-medium text-left text-red-400 transition duration-300 hover:text-red-500"
                        >
                            Smazat
                        </button>
                    @elseif($state['thumbnail']['prev-hover']['delete'] ?? false)
                        <button
                            wire:click="$set('state.thumbnail.prev-hover.delete', false)"
                            type="button"
                            class="w-full px-4 text-sm font-medium text-left transition duration-300 text-light-blue-400 hover:text-light-blue-500"
                        >
                            Vratit zpět
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <h4 class="pb-2 mt-8 mb-4 text-lg font-bold border-b">Vlastní URL</h4>
    <div 
        x-data="{ 
            slug(value) {
                const a = 'àáäâãèéëêìíïîòóöôùúüûñçßÿœæŕśńṕẃǵǹḿǘẍźḧ·/_,:;'
                const b = 'aaaaaeeeeiiiioooouuuuncsyoarsnpwgnmuxzh------'
                const p = new RegExp(a.split('').join('|'), 'g')
                this.$refs.slug.value = value.toString()
                    .toLowerCase()
                    .replace(/ /g,'-')
                    .replace(/[^\w-]+/g,'');
            } 
        }" 
        class="flex text-sm"
    >
        <div class="z-10 flex items-center px-3 text-gray-400 rounded-l-lg bg-blue-gray-200">/</div>
        <input 
            x-ref="slug"
            x-on:input="slug($event.target.value)"
            wire:model.defer="state.slug.{{ $lang }}"
            type="text"
            placeholder="vlastni-url"
            class="w-full px-4 py-2 bg-white border-2 rounded-r-lg form focus:outline-none border-blue-gray-200" 
        />                
    </div>
</div>