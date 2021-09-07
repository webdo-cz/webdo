<div class="relative">
    <textarea
        wire:model.defer="state.{{ $element['id'] }}.value.{{ $lang }}" 
        class="w-full px-4 py-1.5 overflow-y-hidden text-gray-900 bg-white border-2 rounded-lg placeholder form focus:outline-none border-blue-gray-400 border-opacity-20" 
        placeholder="Zadejte text..."
        x-data="{
            init() {
                {{-- window.livewire.hook('element.updated', (component) => {
                    this.resize();
                    console.log('resize{{ $element['id'] }}');
                }); --}}
                this.resize();
            },
            resize() {
                $el.style.height = '38px';
                if($el.scrollHeight < 38) {
                    $el.style.height = '38px';
                }else {
                    $el.style.height = 12 + $el.scrollHeight + 'px';
                }
                
            }
        }"
        @textarea-resize.window="resize()"
        @input="resize"
        x-init="init"
    ></textarea>
</div> 