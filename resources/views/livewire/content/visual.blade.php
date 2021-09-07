<div 
    x-data="{
        developer: false,
        moreModal: false,
        lang: @entangle('lang'),
        langModal: false,
    }"
>

    @include('includes.content.header')

    <div class="">
    </div>
    
    <div class="flex">
        <div class="overflow-y-scroll border-t w-80 bg-gray-50 edit-pannel">
            @if($group)
                @php
                   if(($state[$state[$group]['parent_id']]['type'] ?? null) == 'list') {
                       $isList = false;
                    }else {
                        $isList = true;
                    }
                @endphp
                <button 
                    type="button"
                    @if($isList ?? false)
                        wire:click="$set('group', '{{ $state[$group]['parent_id'] }}', true)" 
                    @else
                        wire:click="$set('group', '{{ $state[$state[$group]['parent_id']]['parent_id'] }}', true)" 
                    @endif
                    class="flex items-center w-full p-5 space-x-1 font-semibold text-white cursor-pointer bg-light-blue-400 hover:bg-light-blue-500"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <div>Zpět</div>
                </button>
            @endif
            @if($developer)
                @include('includes.content.developer')
            @else
                <div class="p-5">
                    @include('includes.content.form')
                </div>
                
            @endif
        </div>
        <div class="flex-grow">
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            window.addEventListener('beforeunload', (event) => {
                event.returnValue = `Opravdu chcete odejít? Provedené změny budou ztraceny.`;
            });
        });
    </script>
    <style>
        .draggable-mirror .draggable-mirror-hide {
            display: none !important;
        }

        .draggable-mirror .draggable-w-265 {
            width: 265px !important;
        }
    </style>
</div>