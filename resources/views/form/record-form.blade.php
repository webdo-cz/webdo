<div x-data="{openSettings: false, openEditor: false}"> 
    @section('title')
        {{ __('form.' . $parent . '-' . $method . '-title') }}
    @endsection
    <x-layout.page-title>
        <div></div>
        <div class="flex space-x-3">
            <a href="{{ url($section . '/' . $parent . 's') }}" class="btn-transparent">
                {{ __('form.btn-cancel') }}
            </a>
            <button onclick="submit()" class="btn-primary">
                {{ __('form.btn-' . $method) }}
            </button>
            <button @click="openSettings = !openSettings" type="button" class="btn-secondary">
                {{ __('form.btn-settings') }}
            </button>
        </div>
    </x-layout.page-title>

    <script>
        function submit() {
            @this.set('state.body', document.querySelector("#body").value);
            @this.set('state.teaser', document.querySelector("#teaser").value);
            @this.call('submit');
        }
        function setBody() {
            document.querySelector("#body").value = document.querySelector("#editor > div").innerHTML;
        }
        function setEditor() {
            document.querySelector("#editor > div").innerHTML = document.querySelector("#body").value;
        }
    </script>

    <div x-show="openEditor" class="fixed inset-0 z-50 flex flex-col items-center justify-between min-h-screen bg-black bg-opacity-75" style="display: none">
        <div class="flex items-center justify-between w-full px-6 py-3 bg-black">
            <div class="font-bold text-white">
                HTML Editor
            </div>
            <div class="flex space-x-2">
                <button @click="openEditor = false" onclick="setBody()" type="button" class="btn-primary">
                    Zrušit
                </button>
                <button @click="openEditor = false" onclick="setEditor()" type="button" class="btn-success">
                    Upravit
                </button>
            </div>
        </div>
        <div class="w-full max-w-4xl h-3/4">
            <textarea id="body" class="w-full h-full p-8 text-white rounded-lg bg-warm-gray-900"></textarea>
        </div>
    </div>

    <div class="w-full mb-6 text-sm">
        <x-input wire:model.defer="state.title" name="title" label="{{ __('form.label-title') }}" placeholder="{{ __('form.placeholder-title-' . $parent) }}"/>
    </div>
    <div class="w-full mb-6" x-data="{ showTeaser: false, customTeaser: @entangle('state.custom_teaser').defer }">
        <div class="flex items-center justify-between w-full">
            <span x-show="!customTeaser" @click="showTeaser = !showTeaser" class="flex items-center px-2 text-sm cursor-pointer text-blue-gray-700">
                <svg class="w-4 h-4 mr-2" :class="{ 'transform rotate-180': showTeaser }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                Zobrazit náhled krátkého popisku
            </span>
            <div></div>
            <label class="flex items-center justify-start">
                <div class="flex items-center h-6 px-1 mr-2 bg-white border-2 border-gray-300 rounded-full outline-none w-11">
                    <input x-model="customTeaser" type="checkbox" class="absolute opacity-0 switch" />
                    <div class="w-4 h-4 transition duration-200 ease-in-out transform bg-gray-300 rounded-full"></div>
                </div>
                <div class="text-blue-gray-500">Vlastní krátký popisek</div>
            </label>
        </div>
        <div x-show="customTeaser" class="w-3/5 -mt-6 text-sm">
            <x-textarea wire:model.defer="teaser" name="teaser" label="{{ __('form.label-teaser') }}" placeholder="{{ __('form.placeholder-teaser-' . $parent) }}" rows="4"/>
        </div>
        <div x-show="showTeaser && !customTeaser" class="px-3 py-2 mx-6 my-2 bg-white">
            <textarea class="w-full text-sm bg-transparent" id="teaser" disabled placeholder="obsah je prazdný" rows="3"></textarea>
        </div>
    </div>
    <div class="w-full pt-8 mb-6 text-sm" wire:ignore>
        {{-- <x-textarea name="body" label="{{ __('form.label-body') }}" placeholder="{{ __('form.placeholder-body-' . $parent) }}" rows="5"/> --}}
        <div id="prevBody">@if (isset($state['body'])){!! $state['body'] !!}@endif</div>

        <div id="editor"></div>

        <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            var toolbarOptions = [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                ['blockquote', 'code-block'],

                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                

                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                [{ 'align': [] }],

                ['link', 'image', 'video'],

                ['clean'],                                        // remove formatting button
                ['html']
            ];

            //Quill.register('modules/imageResize', ImageResize);

            var editor = new Quill('#editor', {
                modules: {
                    toolbar: toolbarOptions,
                    //ImageResize: {
                    //    modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
                    //}
                },
                bounds: document.body,
                placeholder: 'Zde je prostor pro váš obsah',
                theme: 'snow'
            });
            // set teaser and html editor onload
            document.querySelector("#editor > div").innerHTML = document.querySelector("#prevBody").innerHTML;
            document.querySelector("#prevBody").outerHTML = "";

            editor.on('text-change', function() {
                document.querySelector("#body").value = editor.root.innerHTML;
                document.querySelector("#teaser").value = editor.getText().slice(0, 200);""
            });

            document.querySelector(".ql-html").outerHTML = '<button @click="openEditor = true" type="button" class="font-medium" style="width: auto;">HTML Editor</button>';

        });
        </script>

        {{-- <script>
            document.querySelector("#editor > div").innerHTML = ;
        </script> --}}
    </div>

    <div class="w-full" x-data="{ section: 'gallery' }">
        <div class="flex items-center justify-between">
            <div class="flex space-x-3 rounded-lg bg-light-blue-200 bg-opacity-60">
                <button 
                    @click="section = 'gallery'" 
                    type="button"
                    class="flex items-center px-4 py-2 text-sm font-semibold transition duration-300 ease-in-out rounded-lg cursor-pointer focus:outline-none"
                    :class="{ 'bg-light-blue-500 text-white': section == 'gallery', 'hover:bg-light-blue-300 text-light-blue-700': section != 'gallery' }"
                >
                    <span>{{ __('form.gallery-title') }}</span>
                </button>
                <button 
                    @click="section = 'files'" 
                    type="button"
                    class="flex items-center px-4 py-2 text-sm font-semibold transition duration-300 ease-in-out rounded-lg cursor-pointer focus:outline-none"
                    :class="{ 'bg-light-blue-500 text-white': section == 'files', 'hover:bg-light-blue-300 text-light-blue-700': section != 'files' }"
                >
                    <span>{{ __('form.files-title') }}</span>
                </button>
                @if ($parent == "product")
                <button 
                    @click="section = 'variants'" 
                    type="button"
                    class="flex items-center px-4 py-2 text-sm font-semibold transition duration-300 ease-in-out rounded-lg cursor-pointer focus:outline-none"
                    :class="{ 'bg-light-blue-500 text-white': section == 'variants', 'hover:bg-light-blue-300 text-light-blue-700': section != 'variants' }"
                >
                    <span>{{ __('form.variants-title') }}</span>
                </button>
                @endif
            </div>
        </div>
        <div x-show="section == 'gallery'" style="display: none">
            @include('form.partials.gallery')
        </div>
        <div x-show="section == 'files'" style="display: none">
            @include('form.partials.files')
        </div>
        @if ($parent == "product")
            <div x-show="section == 'variants'" style="display: none">
                @include('form.partials.variants')
            </div>
        @endif
    </div>

    @include('form.partials.settings')
    
</div>