<div class="fixed inset-0 z-50 flex items-center justify-center w-full min-h-screen px-8 py-3 bg-opacity-50 bg-blue-gray-800 sm:bottom-auto">
    <div class="w-full sm:max-w-3xl">
        <div class="flex flex-col w-full bg-white shadow-lg rounded-3xl">
            <div class="px-6 py-8 sm:px-9">
                <div class="flex items-center justify-between mb-6">
                    <div class="text-lg font-bold text-gray-800">
                        Správa SEO: {{ $page['title']['cs'] }}
                    </div>
                    <button wire:click="$set('page', null)" class="flex items-center justify-center w-10 h-10 text-gray-700 rounded-full opacity-50 cursor-pointer hover:bg-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="space-y-4">
                    <p class="text-sm text-gray-600">
                        Tyto údaje jsou použity v hlavičce stránky, které jsou použity při sdílení na socialních sítích a při vyhledávání. 
                    </p>
                    <p class="text-sm text-gray-600">
                        Pokud není některý z údajů vyplněný jsou použity údaje z index stránky.
                    </p>
                    <x-input wire:model.defer="page.page_title" name="title" label="Nadpis stránky" placeholder=""/>
                    <x-input wire:model.defer="page.meta_title" name="name" label="Meta nadpis (og:title, twitter:title)" placeholder=""/>
                    <x-textarea wire:model.defer="page.meta_description" name="name" label="Meta popis (og:description, twitter:description)" placeholder=""/>
                    <x-textarea wire:model.defer="page.meta_keywords" name="name" label="Meta klíčové slova (slova oddělte čárkou)" placeholder=""/>
                    <div 
                        class="w-full text-sm"
                        x-data="{
                            init() {
                                this.initFilepond();
                            },
                            initFilepond() {
                                const pond = FilePond.create(this.$refs.filepond, {
                                    onprocessfile: (error, file) => {
                                        pond.removeFile(file.id)
                                    },
                                    server: {
                                        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                                            @this.upload('page.thumbnail.upload', file, load, error, progress)
                                        }
                                    }
                                });
                            }
                        }"
                        x-init="init"
                    >
                        <label class="pl-2 text-blue-gray-500">
                            Náhledový obrázek (doporučená velikost: 1200x628)
                        </label>
                        <div class="relative flex mt-3">
                            <div class="relative flex-none">
                                @if(isset($page['thumbnail']['upload']) && is_object($page['thumbnail']['upload']))
                                    <button
                                        wire:click="$set('page.thumbnail.upload', null)"
                                        type="button" 
                                        class="absolute top-0 right-0 z-50 p-2 mr-2 -mt-2 text-white rounded-xl bg-light-blue-400 hover:bg-light-blue-500"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                        </svg>
                                    </button>
                                    <img class="flex-none object-cover mr-4 rounded" style="height: 5.45em; width: 5.45em" src="{{ $page['thumbnail']['upload']->temporaryUrl() }}">
                                @elseif(isset($page['thumbnail']['delete']) && $page['thumbnail']['delete'])
                                    <button 
                                        wire:click="$set('page.thumbnail.delete', false)" 
                                        type="button" 
                                        class="absolute top-0 right-0 z-50 p-2 mr-2 -mt-2 text-white rounded-xl bg-light-blue-400 hover:bg-light-blue-500"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                        </svg>
                                    </button>
                                    <div class="mr-4 bg-gray-100 rounded" style="height: 5.45em; width: 5.45em"></div>
                                @elseif(isset($page['thumbnail']['path']))
                                    <button
                                        wire:click="$set('page.thumbnail.delete', true)"
                                        type="button" 
                                        class="absolute top-0 right-0 z-50 p-2 mr-2 -mt-2 text-white bg-red-400 rounded-xl hover:bg-red-500"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                    <img class="flex-none object-cover mr-4 rounded" style="height: 5.45em; width: 5.45em" src="{{ asset('files/' . $page['thumbnail']['path']) }}">
                                @endif
                            </div>
                            <div wire:ignore class="w-full">
                                <input type="file" x-ref="filepond" accept="image/png, image/jpeg, image/gif">
                            </div>
                        </div>
                    </div>
                    <button wire:click="editSeo" class="btn-primary">
                        <span class="px-3 py-1">Upravit</span>
                        <x-loading-spin size="6" target="editSeo" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>