<div 
    x-data="{
        settings: false,
        lang: @entangle('lang'),
        langModal: false,
        initQuill() {
            var toolbarOptions = [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],
                ['link', 'image', 'video'],
                ['clean'],
                ['html']
            ];
            const quill = new Quill('#quill', {
                modules: {
                    toolbar: toolbarOptions,
                },
                bounds: document.body,
                placeholder: 'Zde je prostor pro váš obsah',
                theme: 'snow'
            });
            document.querySelector('#teaser').value = quill.getText().slice(0, 200);
            quill.on('text-change', () => {
                @this.set('state.body.' + this.lang, document.querySelector('#quill > div').innerHTML, true);
                document.querySelector('#teaser').value = quill.getText().slice(0, 200);
            });
        },
        changeLang(lang) {
            var body = @this.get('state.body.' + lang);
            console.log(lang, body);
            if(typeof body !== 'undefined') {
                document.querySelector('#quill > div').innerHTML = body;
            }else {
                document.querySelector('#quill > div').innerHTML = null;
            }
        }
    }"
    x-init="initQuill; $watch('lang', value => changeLang(value))"
    class="w-full mb-8"
>
    <div>
        <x-validation-errors/>
    </div>
    
    @include('includes.form.header')

    <div class="relative">
        <div class="max-w-4xl pt-8 mx-auto space-y-8">
            @include('includes.form.title')
            @include('includes.form.teaser')
            @include('includes.form.quill')
            <div 
                x-data="{
                    tab: 'gallery',
                    initFilepond() {
                        const pond = FilePond.create(this.$refs.filepond, {
                            allowPaste: false,
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
                @include('includes.form.seo')
                <div
                    wire:ignore 
                    class="w-full mt-4"
                    x-show="tab == 'gallery' || tab == 'files'"
                >
                    <input type="file" x-ref="filepond" multiple>
                </div>
            </div>
        </div>
        <div 
            x-show.transition.origin.top.right="settings"
            class="absolute top-0 right-0 border-t w-80 bg-gray-50 edit-pannel"
            style="display: none"
        >
            @include('includes.form.settings')
        </div>
    </div>

</div>