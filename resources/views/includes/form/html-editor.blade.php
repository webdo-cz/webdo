<button @click="open" class="absolute top-0 right-0 px-4 py-4 mt-0.5 text-sm font-semibold">HTML Editor</button>
    <div x-show="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none">
        <div class="fixed top-0 left-0 flex items-center justify-between w-full bg-black bg-opacity-80">
            <div class="px-8 py-6 font-bold text-white">
                <div class="font-bold text-white">
                    HTML Editor
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
        </div>
    </div>