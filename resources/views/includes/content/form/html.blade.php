<div 
    x-data="{
        show: false,
        value: null,
        open() {
            this.value = document.querySelector('#html-{{ $element['id'] }}').innerHTML;
            this.show = true;
        },
        submit() {
            @this.$set('state.{{ $element['id'] }}.value.{{ $lang }}', this.value, true);
            this.show = false;
        }
    }"
    class="flex flex-col-reverse"
>
    <button
        @click="open"
        type="button" 
        class="flex justify-between w-full px-4 py-3 font-medium text-left text-white transition duration-300 bg-gray-800 border-2 border-gray-900 rounded-lg group border-opacity-20 hover:text-light-blue-400"
    >
        <span class="pl-1">Upravit HTML</span>
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
        <div class="w-full max-w-4xl p-4 text-white rounded-lg shadow h-3/4 bg-warm-gray-900">
            <textarea 
                id="html"
                x-model="value"
                class="w-full h-full p-4 bg-transparent"
                placeholder="Zde můžete psát obsah pomocí HTML..."
            ></textarea>
            <div id="html-{{ $element['id'] }}" class="hidden">{!! $element['value'][$lang] !!}</div>
        </div>
    </div>
</div>