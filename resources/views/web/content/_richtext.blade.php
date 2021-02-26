<div class="relative h-20 bg-gray-50">
    <div class="absolute flex items-center justify-center w-full h-20" x-data="{ open: false, editor: 'markdown' }">
        <button 
            wire:click="$set('state.{{ $item }}.opened', true)" 
            @click="open = true" 
            type="button" 
            class="z-10 bg-white border btn text-light-blue-500 hover:text-light-blue-800"
        >
            Upravit text
        </button>
        @if(isset($state[$item]['opened']))
            <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none">
                <div class="fixed top-0 left-0 flex items-center justify-between w-full px-8 py-6 bg-black bg-opacity-80">
                    <div class="font-bold text-white">
                        {{ $state[$item]['label'] }}
                    </div>
                    <div class="flex space-x-6">
                        <div class="flex bg-white bg-opacity-10 rounded-xl">
                            <button 
                                @click="editor = 'markdown'"
                                onclick="setEditor('{{ $item }}')"
                                type="button"
                                :class="{ 'text-gray-200 bg-transparent hover:bg-blue-400 hover:bg-opacity-10 hover:text-light-blue-400': editor != 'markdown', 'text-gray-600 bg-gray-200': editor == 'markdown' }"
                                class="btn"
                            >
                                Markdown Editor
                            </button>
                            <button 
                                @click="editor = 'html'"
                                onclick="setHTML('{{ $item }}')"
                                type="button"
                                :class="{ 'text-gray-200 bg-transparent hover:bg-blue-400 hover:bg-opacity-10 hover:text-light-blue-400': editor != 'html', 'text-gray-600 bg-gray-200': editor == 'html' }"
                                class="btn"
                            >
                                HTML Editor
                            </button>
                        </div>
                        <button 
                        
                            @click="open = false"
                            onclick="closeModal('{{ $item }}', 'html')"
                            type="button" 
                            class="btn-primary" 
                            style="display: none"
                        >
                            Použít
                        </button>
                        <button
                            
                            @click="open = false" 
                            onclick="closeModal('{{ $item }}', 'markdown')"
                            type="button" 
                            class="btn-primary"
                        >
                            Použít
                        </button>
                    </div>
                </div>
                <div x-show="editor == 'html'" class="w-full max-w-4xl h-3/4" style="display: none">
                    <textarea 
                        id="html-{{ $item }}"
                        wire:model.defer="state.{{ $item }}.value.{{ $lang }}"
                        class="w-full h-full p-8 text-white rounded-lg bg-warm-gray-900" 
                        placeholder="Zde můžete psát obsah pomocí HTML..."
                    ></textarea>
                </div>
                <div 
                    x-show="editor == 'markdown'" 
                    class="w-full max-w-4xl p-2 bg-white rounded-md" 
                    style="display: none"
                >
                    <div wire:ignore>
                        <div id="editor-{{ $item }}"></div>
                        <script>
                            var editor_{{ $item }} = new Quill('#editor-{{ $item }}', {
                                modules: {
                                    toolbar: toolbarOptions,
                                },
                                bounds: document.body,
                                placeholder: 'Zde je prostor pro váš obsah',
                                theme: 'snow'
                            });
                            setEditor('{{ $item }}');
                        </script>
                    </div>
                </div>
            </div> 
        @endif
    </div>
    <div class="w-full px-6 py-4 text-sm text-gray-400">
        @if(isset($state[$item]['value'][$lang]))
        
        @endif
    </div>
</div>