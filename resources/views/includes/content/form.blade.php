@foreach(collect($state)->where('delete', '!=' , true)->where('parent_id', $group)->sortByDesc('order') as $element)
    @if(!($element['delete'] ?? false))
        <div wire:key="{{ $element['id'] }}" class="w-full mb-4 text-sm">
            @if($element['type'] != 'group')
                <p class="pl-4 mb-1 text-sm font-medium text-gray-500">
                    {{ $element['label'] }}
                </p>
            @endif
            @includeIf('includes.content.form.' . $element['type'])
        </div>
    @endif
@endforeach

<script>
    document.addEventListener("DOMContentLoaded", () => {
        window.livewire.hook('message.processed', (component) => {
            window.dispatchEvent(new CustomEvent('textarea-resize'));
            console.log('resize-all-message');
        });
    });
</script>