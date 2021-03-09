<textarea
    wire:model.defer="state.{{ $item }}.value.{{ $lang }}" 
    class="w-full h-10 px-4 py-2 overflow-hidden text-sm border-b bg-gray-50 focus:outline-none focus:border-light-blue-300" 
    placeholder="Zadejte text..."
    x-data="{
        resize() {
            $el.style.height = '40px';
            if($el.scrollHeight < 40) {
                $el.style.height = '40px';
            }else {
                $el.style.height = $el.scrollHeight + 'px';
            }
            
        }
    }"
    x-init="resize"
    @input="resize"
></textarea> 