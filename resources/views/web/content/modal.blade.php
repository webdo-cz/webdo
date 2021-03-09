<div
    x-data="{
        modal: @entangle('modal').defer,
        lang: @entangle('lang').defer,
        window: null,
        value: null,
        init() {
            this.$watch('modal', () => {
                this.window = this.modal.type;
                console.log(this.modal.value);
                if(this.modal.type == 'richtext') {
                    document.querySelector('#quill > div').innerHTML = this.modal.value;
                }
                this.value = this.modal.value;
            });
            this.initQuill();
            this.initFilepond();
        },
        initQuill() {
            const toolbarOptions = [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],
                ['clean']
            ];
            const quill = new Quill('#quill', {
                modules: {
                    toolbar: toolbarOptions,
                },
                bounds: document.body,
                placeholder: 'Zde je prostor pro váš obsah',
                theme: 'snow'
            });
            quill.on('text-change', () => {
                this.value = document.querySelector('#quill > div').innerHTML;
            });
        },
        initFilepond() {
            const pond = FilePond.create(this.$refs.filepond, {
                onprocessfile: (error, file) => {
                    pond.removeFile(file.id)
                    if(pond.getFiles().length == 0) {
                        @this.closeModal();
                    }
                },
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        @this.upload('state.' + this.modal.id + '.upload.' + this.lang, file, load, error, progress)
                    }
                }
            });
        },
        setQuill() {
            document.querySelector('#quill > div').innerHTML = this.value;
        },
        submit() {
            @this.$set('state.' + this.modal.id + '.value.' + this.lang, this.value);
            @this.closeModal();
        }
    }"
    x-init="init"
>
    <div x-show="modal.id" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none">
        <div class="fixed top-0 left-0 flex items-center justify-between w-full bg-black bg-opacity-80">
            <div class="px-8 py-6 font-bold text-white">
                <div class="font-bold text-white">
                    Upravit: {{ $modal['id'] ? $state[$modal['id']]['label'] : "" }}
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <div x-show="modal.type == 'richtext'" class="flex bg-white bg-opacity-10 rounded-xl">
                    <button 
                        @click="window = 'richtext', setQuill()"
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
                    x-show="modal.type != 'image'"
                    type="button" 
                    class="btn-primary"
                    @click="submit"
                >
                    Použít
                </button>
                <button 
                    type="button" 
                    class="p-5 text-gray-600 bg-black hover:text-white"
                    wire:click="closeModal"
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
                'max-w-4xl h-3/4 text-white bg-warm-gray-900': window == 'html',
                'max-w-2xl bg-white': window == 'image',
            }"
            wire:ignore
        >
            <div x-show="window == 'richtext'">
                <div id="quill"></div>
            </div>
            <div x-show="window == 'html'" class="h-full">
                <textarea 
                    id="html"
                    x-model="value"
                    class="w-full h-full p-4 bg-transparent"
                    placeholder="Zde můžete psát obsah pomocí HTML..."
                ></textarea>
            </div>
            <div x-show="window == 'image'">
                <input type="file" x-ref="filepond">
            </div>
        </div>
    </div>
</div>