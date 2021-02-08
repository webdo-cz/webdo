<div x-show="open" @click.away="open = false" class="min-h-screen bg-gray-100 py-6 font-sans antialiased">
    <div class="bg-gray-800 absolute inset-0 opacity-40 z-10"></div>
    <div class="fixed py-3 z-50 bottom-0 sm:bottom-auto w-full px-8 flex items-center justify-center min-h-screen">
        <div class="sm:max-w-3xl w-full">
            <div class="bg-white shadow-lg rounded-3xl w-full flex flex-col">
                <div
                    class="flex flex-col sm:flex-row justify-between flex-wrap px-6 sm:px-4 py-6 bg-white rounded-3xl shadow-sm">
                    <div class="flex justify-end mb-2 w-full">
                        <button
                            @click="open = false"
                            class="w-10 h-10 opacity-50 hover:bg-gray-200 text-gray-600 rounded-full flex items-center justify-center cursor-pointer">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="sm:w-1/2 md:w-1/3 p-2">
                        <div
                            wire:click="createNewRecord('text')"
                            @click="open = false"
                            class="border rounded-lg py-4 px-6 leading-7 hover:bg-gray-50 cursor-pointer text-gray-600 hover:text-black">
                            <p class="font-semibold ">Text</p>
                            <p class="text-xs text-gray-500">Obyčejné textové pole</p>
                        </div>
                    </div>
                    <div class="sm:w-1/2 md:w-1/3 p-2">
                        <div
                            wire:click="createNewRecord('textarea')"
                            @click="open = false"
                            class="border rounded-lg py-4 px-6 leading-7 hover:bg-gray-50 cursor-pointer text-gray-600 hover:text-black">
                            <p class="font-semibold">Textarea</p>
                            <p class="text-xs text-gray-500">Textové pole s více řádky</p>
                        </div>
                    </div>
                    <div class="sm:w-1/2 md:w-1/3 p-2">
                        <div
                            wire:click="createNewRecord('html')"
                            @click="open = false"
                            class="border rounded-lg py-4 px-6 leading-7 hover:bg-gray-50 cursor-pointer text-gray-600 hover:text-black">
                            <p class="font-semibold">HTML</p>
                            <p class="text-xs text-gray-500">HTML Editor např. pro SVG</p>
                        </div>
                    </div>
                    <div class="sm:w-1/2 md:w-1/3 p-2">
                        <div
                            wire:click="createNewRecord('richtext')"
                            @click="open = false"
                            class="border rounded-lg py-4 px-6 leading-7 hover:bg-gray-50 cursor-pointer text-gray-600 hover:text-black">
                            <p class="font-semibold">Richtext</p>
                            <p class="text-xs text-gray-500">Wysiwyg editor</p>
                        </div>
                    </div>
                    <div class="sm:w-1/2 md:w-1/3 p-2">
                        <div
                            wire:click="createNewRecord('image')"
                            @click="open = false"
                            class="border rounded-lg py-4 px-6 leading-7 hover:bg-gray-50 cursor-pointer text-gray-600 hover:text-black">
                            <p class="font-semibold">Image</p>
                            <p class="text-xs text-gray-500">Nahrání obrázku</p>
                        </div>
                    </div>
                    <div class="sm:w-1/2 md:w-1/3 p-2">
                        <div
                            wire:click="createNewRecord('group')"
                            @click="open = false"
                            class="border rounded-lg py-4 px-6 leading-7 hover:bg-gray-50 cursor-pointer text-gray-600 hover:text-black">
                            <p class="font-semibold">Group</p>
                            <p class="text-xs text-gray-500">List skupin dalších polí</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>