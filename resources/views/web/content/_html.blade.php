<div class="flex h-16">
    <div x-data="{ open: false, editor: 'html'}" class="flex items-center justify-center w-full h-16 bg-gray-50">
        <button 
            wire:click="$set('state.{{ $item }}.opened', true)" 
            @click="open = true" 
            type="button"
            class="z-10 bg-white border cursor-pointer btn text-light-blue-500 hover:text-light-blue-800"
        >
            Upravit HTML
        </button>
        @if(isset($state[$item]['opened']))
            <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none">
                <div class="fixed top-0 left-0 flex items-center justify-between w-full px-8 py-6 bg-black bg-opacity-80">
                    <div class="font-bold text-white">
                        {{ $state[$item]['label'] }}
                    </div>
                    <button 
                        @click="open = false"
                        onclick="closeModal('{{ $item }}', 'html')"
                        type="button" 
                        class="btn-primary" 
                    >
                        Použít
                    </button>
                </div>
                <div class="w-full max-w-4xl h-3/4">
                    <textarea 
                        id="html-{{ $item }}"
                        wire:model.defer="state.{{ $item }}.value.{{ $lang }}"
                        class="w-full h-full p-8 text-white rounded-lg bg-warm-gray-900" 
                        placeholder="Zde můžete psát obsah pomocí HTML..."
                    ></textarea>
                </div>
            </div> 
        @endif
    </div>
</div>