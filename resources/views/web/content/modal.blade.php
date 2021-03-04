<div
    x-data="{ 
        id: @entangle('modal.id').defer,
        type: @entangle('modal.type').defer,
        lang: @entangle('lang').defer,
        initFilepond() {
            const pond = FilePond.create(this.$refs.filepond, {
                onprocessfile: (error, file) => {
                    pond.removeFile(file.id)
                    if(pond.getFiles().length == 0) {
                        this.id = null
                    }
                },
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        @this.upload('state.' + this.id + '.upload.' + this.lang, file, load, error, progress)
                    }
                }
            });
        }
    }"
    x-init="initFilepond"
>
    <div x-show="id" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="fixed top-0 left-0 flex items-center justify-between w-full bg-black bg-opacity-80">
            <div class="px-8 py-6 font-bold text-white">
                <div class="font-bold text-white">
                    Upravit: {{ $modal['id'] ? $state[$modal['id']]['label'] : "" }}
                </div>
            </div>
            <button 
                type="button" 
                class="p-5 text-white bg-black"
                @click="id = null"
            >
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div 
            class="w-full max-w-2xl bg-white rounded-lg shadow"
            wire:ignore
        >
            <div class="p-4">
                <input type="file" x-ref="filepond">
            </div>
        </div>
    </div>
</div>