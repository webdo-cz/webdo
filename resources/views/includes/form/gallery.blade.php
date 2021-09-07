<div x-show="tab == 'gallery'">
    <div class="flex flex-wrap">
        @foreach($state['gallery'] as $key => $image)
            @if(!($image['delete'] ?? false))
                <div 
                    x-data="{ 'show': false }" 
                    @keydown.escape="show = false" 
                    class="relative w-20 h-20 mb-3 ml-2 bg-gray-700 bg-center bg-cover rounded-lg" 
                    style="background-image: url('{{ $image['full_path'] }}')"
                >
                    <button wire:click="$set('state.gallery.{{ $key }}.delete', true)" wire:loading.attr="disabled" class="absolute z-10 flex items-center justify-center w-6 h-6 text-xs leading-none text-white transition duration-200 ease-in-out bg-red-500 rounded-full -top-1 -right-1 hover:bg-red-400" type="button" name="button">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <button @click="show = true" class="flex items-center justify-center w-full h-full transition duration-200 ease-in-out opacity-0 hover:opacity-100" type="button" name="button">
                        <svg class="w-10 h-10 p-2 text-white bg-black rounded-lg bg-opacity-60 opacity-80" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                        </svg>
                    </button>
                    <div x-show="show" class="fixed inset-0 z-40 overflow-y-auto" style="display: none;">
                        <div class="fixed inset-0 transition-opacity">
                            <div class="fixed inset-0 bg-black bg-opacity-40"></div>
                            <button 
                                @click="show = false"
                                type="button"
                                class="absolute z-50 w-8 h-8 text-gray-100 cursor-pointer top-4 right-4" 
                            >
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <img 
                            @click.away="show = false" 
                            class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" 
                            src="{{ $image['full_path'] }}" 
                            alt="" 
                            style="top: 50%;left: 50%;"
                        >
                    </div>
                </div>
            @endif
        @endforeach
        @if(!empty($state['gallery']) && !empty($upload['gallery']))<div class="h-10 pl-2 my-5 border-r border-gray-300"></div>@endif
        @foreach($upload['gallery'] as $key => $image)
            @if($image)
                <div 
                    x-data="{ 'show': false }" 
                    @keydown.escape="show = false" 
                    class="relative w-20 h-20 mb-3 ml-2 bg-gray-700 bg-center bg-cover rounded-lg" 
                    style="background-image: url('{{ $image->temporaryUrl() }}')"
                >
                    <button wire:click="$set('upload.gallery.{{ $key }}', null)" wire:loading.attr="disabled" class="absolute z-10 flex items-center justify-center w-6 h-6 text-xs leading-none text-white transition duration-200 ease-in-out bg-red-500 rounded-full -top-1 -right-1 hover:bg-red-400" type="button" name="button">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                    <button @click="show = true" class="flex items-center justify-center w-full h-full transition duration-200 ease-in-out opacity-0 hover:opacity-100" type="button" name="button">
                        <svg class="w-10 h-10 p-2 text-white bg-black rounded-lg bg-opacity-60 opacity-80" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                        </svg>
                    </button>
                    <div x-show="show" class="fixed inset-0 z-40 overflow-y-auto" style="display: none;">
                        <div class="fixed inset-0 transition-opacity">
                            <div class="fixed inset-0 bg-black bg-opacity-40"></div>
                            <button 
                                @click="show = false"
                                type="button"
                                class="absolute z-50 w-8 h-8 text-gray-100 cursor-pointer top-4 right-4" 
                            >
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <img 
                            @click.away="show = false" 
                            class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" 
                            src="{{ $image->temporaryUrl() }}" 
                            alt="" 
                            style="top: 50%;left: 50%;"
                        >
                    </div>
                </div>
            @endif
        @endforeach 
    </div>
</div>