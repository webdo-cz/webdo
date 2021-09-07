<div 
    x-data="{
        tab: 'gallery',
        initFilepond() {
            const pond = FilePond.create(this.$refs.filepond, {
                labelIdle: `<span class='font-medium underline cursor-pointer filepond--label-action'>Vyberte</span> nebo přetáhněte obrázek`,
                onprocessfile: (error, file) => {
                    pond.removeFile(file.id)
                },
                server: {
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        @this.upload('upload.' + this.tab, file, load, error, progress)
                    }
                }
            });
        }
    }"
    x-init="initFilepond"
    class=""
>
    <div class="inline-flex mb-4 space-x-1 rounded-lg bg-light-blue-200 bg-opacity-60">
        <button
            @click="tab = 'gallery'"
            type="button" 
            class="flex items-center px-4 py-2 text-sm font-semibold text-white rounded-lg cursor-pointer focus:outline-none bg-light-blue-500" 
            :class="{ 
                'bg-light-blue-500 text-white': tab == 'gallery', 
                'hover:bg-light-blue-200 text-light-blue-500': tab != 'gallery' 
            }"
        >
            <span>Galerie</span>
        </button>
        <button
            @click="tab = 'files'"
            type="button" 
            class="flex items-center px-4 py-2 text-sm font-semibold text-white rounded-lg cursor-pointer focus:outline-none bg-light-blue-500" 
            :class="{ 
                'bg-light-blue-500 text-white': tab == 'files', 
                'hover:bg-light-blue-200 text-light-blue-500': tab != 'files' 
            }"
        >
            <span>Soubory</span>
        </button>
        <button
            @click="tab = 'seo'"
            type="button" 
            class="flex items-center px-4 py-2 text-sm font-semibold text-white rounded-lg cursor-pointer focus:outline-none bg-light-blue-500" 
            :class="{ 
                'bg-light-blue-500 text-white': tab == 'seo', 
                'hover:bg-light-blue-200 text-light-blue-500': tab != 'seo' 
            }"
        >
            <span>SEO</span>
        </button>
    </div>
    @include('includes.form.gallery')
    @include('includes.form.files')
    <div x-show="tab == 'seo'">
        <div class="space-y-4">
            <p class="text-sm text-gray-600">
                Pokud není nadpis stránky vyplněn je použit nadpis příspěvku.
            </p>
            <x-input wire:model.defer="state.page_title.{{ $lang }}" name="page_title" label="Nadpis stránky" placeholder=""/>
            <x-input wire:model.defer="state.meta_title.{{ $lang }}" name="meta_title" label="Meta nadpis (og:title, twitter:title)" placeholder=""/>
            <x-textarea wire:model.defer="state.meta_description.{{ $lang }}" name="meta_description" label="Meta popis (og:description, twitter:description)" placeholder=""/>
            <x-textarea wire:model.defer="state.meta_keywords.{{ $lang }}" name="meta_keywords" label="Meta klíčové slova (slova oddělte čárkou)" placeholder=""/>
        </div>
    </div>
    <style>
        .filepond--drop-label, .filepond--panel-root {
            background-color: white !important;
        }
    </style>
    <div 
        wire:ignore 
        class="w-full mt-4"
        x-show="tab == 'gallery' || tab == 'files'"
    >
        <input type="file" x-ref="filepond" multiple>
    </div>
</div>