<div 
    x-data="{
        show: false,
        inited: false,
        window: 'richtext',
        value: null,
        open() {
            if(!this.inited) {
                this.initQuill();
            }
            this.show = true;
        },
        syncQuill() {
            document.querySelector('#quill-{{ $element['id'] }} > div').innerHTML = this.value;
        },
        initQuill() {
            console.log('inited');
            this.value = document.querySelector('#quill-{{ $element['id'] }}').innerHTML;
            const toolbarOptions = [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],
                ['clean']
            ];
            const quill = new Quill('#quill-{{ $element['id'] }}', {
                modules: {
                    toolbar: toolbarOptions,
                },
                bounds: document.body,
                placeholder: 'Zde je prostor pro váš obsah',
                theme: 'snow'
            });
            quill.on('text-change', () => {
                this.value = document.querySelector('#quill-{{ $element['id'] }} > div').innerHTML;
            });
            this.inited = true;
        },
        submit() {
            @this.$set('state.{{ $element['id'] }}.value.{{ $lang }}', this.value, true);
            this.show = false;
        }
    }"
    class="flex flex-col-reverse"
>
    <div class="p-4 -mt-2 text-gray-400 bg-gray-100 rounded-b-lg cursor-default">
        @if(isset($element['value'][$lang]))
            {!! mb_substr(strip_tags($element['value'][$lang]), 0, 97) !!}...
        @endif
    </div>
    <button 
        @click="open"
        type="button" 
        class="flex justify-between w-full px-4 py-3 font-medium text-left transition duration-300 bg-white border-2 rounded-lg text-light-blue-500 group border-blue-gray-400 border-opacity-20 hover:text-light-blue-600"
    >
        <span class="pl-1">Upravit textový blok</span>
        <svg class="w-5 h-5 transition duration-300 opacity-0 text-light-blue-400 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
        </svg>
    </button>
    <div x-show="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none">
        <div class="fixed top-0 left-0 flex items-center justify-between w-full bg-black bg-opacity-80">
            <div class="px-8 py-6 font-bold text-white">
                <div class="font-bold text-white">
                    Upravit: {{ $element['label'] ?? null }}
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <div class="flex bg-white bg-opacity-10 rounded-xl">
                    <button 
                        @click="window = 'richtext', syncQuill()"
                        type="button"
                        :class="{ 'text-gray-200 bg-transparent hover:bg-black hover:bg-opacity-10 hover:text-light-blue-400': window != 'richtext', 'text-gray-600 bg-gray-200': window == 'richtext' }"
                        class="btn"
                    >
                        Markdown Editor
                    </button>
                    <button 
                        @click="window = 'html'"
                        type="button"
                        :class="{ 'text-gray-200 bg-transparent hover:bg-black hover:bg-opacity-10 hover:text-light-blue-400': window != 'html', 'text-gray-600 bg-gray-200': window == 'html' }"
                        class="btn"
                    >
                        HTML Editor
                    </button>
                </div>
                <button 
                    type="button" 
                    class="btn-primary"
                    @click="submit"
                >
                    Použít
                </button>
                <button 
                    type="button" 
                    class="p-5 text-gray-600 bg-black hover:text-white"
                    @click="show = false"
                >
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div 
            class="w-full p-4 rounded-lg shadow"
            :class="{ 
                'max-w-4xl bg-white': window == 'richtext',
                'max-w-4xl h-3/4 text-white bg-warm-gray-900': window == 'html'
            }"
            wire:ignore
        >
            <div x-show="window == 'richtext'">
                <div id="quill-{{ $element['id'] }}">{!! $element['value'][$lang] !!}</div>
            </div>
            <div x-show="window == 'html'" class="h-full">
                <textarea 
                    id="html"
                    x-model="value"
                    class="w-full h-full p-4 bg-transparent"
                    placeholder="Zde můžete psát obsah pomocí HTML..."
                ></textarea>
            </div>
        </div>
    </div>
</div>