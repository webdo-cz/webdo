<div x-show="open" @click.away="open = false" class="min-h-screen py-6 font-sans antialiased bg-gray-100" style="display: none">
    <div class="fixed inset-0 z-10 bg-gray-800 opacity-40"></div>
    <div class="fixed inset-0 z-50 flex items-center justify-center w-full min-h-screen px-8 py-3">
        <div class="w-full sm:max-w-3xl">
            <div class="flex flex-col w-full bg-white shadow-lg rounded-3xl">
                <div class="px-6 py-6 shadow-sm sm:px-4 rounded-3xl">
                    <div class="flex items-center justify-between w-full mb-2">
                        <h3 class="pl-4 text-lg font-semibold">
                            Přidat nový  blok
                        </h3>
                        <button
                            @click="open = false"
                            class="flex items-center justify-center w-10 h-10 text-gray-600 rounded-full opacity-50 cursor-pointer hover:bg-gray-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-2">
                        <div class="mb-2">
                            <x-input wire:model.defer="add.name" name="name" label="Selektor" placeholder="test"/>
                        </div>
                        <div class="mb-2">
                            <x-input wire:model.defer="add.label" name="label" label="Label" placeholder="test"/>
                        </div>
                    </div>
                    @if(!isset($add['parent_id']))
                    <div class="pl-4 text-sm text-blue-gray-500">
                        Typ
                    </div>
                    <div class="flex flex-col flex-wrap justify-between sm:flex-row border-blue-gray-300">
                        <div class="p-2 sm:w-1/2 md:w-1/3">
                            <div
                                wire:click="$set('add.type', 'text', true)"
                                :class="{ 'border-light-blue-400 bg-light-blue-100 hover:bg-light-blue-100': type === 'text' }"
                                class="px-6 py-4 leading-7 text-gray-600 border-2 rounded-lg cursor-pointer border-blue-gray-300 hover:bg-gray-50 hover:text-black">
                                <p class="font-semibold ">Text</p>
                                <p class="text-xs text-gray-500">Obyčejné textové pole</p>
                            </div>
                        </div>
                        <div class="p-2 sm:w-1/2 md:w-1/3">
                            <div
                                wire:click="$set('add.type', 'textarea', true)"
                                :class="{ 'border-light-blue-400 bg-light-blue-100 hover:bg-light-blue-100': type === 'textarea' }"
                                class="px-6 py-4 leading-7 text-gray-600 border-2 rounded-lg cursor-pointer border-blue-gray-300 hover:bg-gray-50 hover:text-black">
                                <p class="font-semibold">Textarea</p>
                                <p class="text-xs text-gray-500">Textové pole s více řádky</p>
                            </div>
                        </div>
                        <div class="p-2 sm:w-1/2 md:w-1/3">
                            <div
                                wire:click="$set('add.type', 'html', true)"
                                :class="{ 'border-light-blue-400 bg-light-blue-100 hover:bg-light-blue-100': type === 'html' }"
                                class="px-6 py-4 leading-7 text-gray-600 border-2 rounded-lg cursor-pointer border-blue-gray-300 hover:bg-gray-50 hover:text-black">
                                <p class="font-semibold">HTML</p>
                                <p class="text-xs text-gray-500">HTML Editor např. pro SVG</p>
                            </div>
                        </div>
                        <div class="p-2 sm:w-1/2 md:w-1/3">
                            <div
                                wire:click="$set('add.type', 'richtext', true)"
                                :class="{ 'border-light-blue-400 bg-light-blue-100 hover:bg-light-blue-100': type === 'richtext' }"
                                class="px-6 py-4 leading-7 text-gray-600 border-2 rounded-lg cursor-pointer border-blue-gray-300 hover:bg-gray-50 hover:text-black">
                                <p class="font-semibold">Richtext</p>
                                <p class="text-xs text-gray-500">Wysiwyg editor</p>
                            </div>
                        </div>
                        <div class="p-2 sm:w-1/2 md:w-1/3">
                            <div
                                wire:click="$set('add.type', 'image', true)"
                                :class="{ 'border-light-blue-400 bg-light-blue-100 hover:bg-light-blue-100': type === 'image' }"
                                class="px-6 py-4 leading-7 text-gray-600 border-2 rounded-lg cursor-pointer border-blue-gray-300 hover:bg-gray-50 hover:text-black">
                                <p class="font-semibold">Image</p>
                                <p class="text-xs text-gray-500">Nahrání obrázku</p>
                            </div>
                        </div>
                        <div class="p-2 sm:w-1/2 md:w-1/3">
                            <div
                                wire:click="$set('add.type', 'list', true)"
                                :class="{ 'border-light-blue-400 bg-light-blue-100 hover:bg-light-blue-100': type === 'list' }"
                                class="px-6 py-4 leading-7 text-gray-600 border-2 rounded-lg cursor-pointer hover:bg-gray-50 hover:text-black">
                                <p class="font-semibold">List</p>
                                <p class="text-xs text-gray-500">List skupin dalších polí</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="px-2 mt-4">
                        <button type="button" wire:click="create" class="btn-primary">
                            Přidat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>