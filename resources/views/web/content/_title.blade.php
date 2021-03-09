<div class="px-1 text-xl font-semibold">
    @if(isset($state[$item]['value'][$lang]))
        {{ $state[$item]['value'][$lang] }}
    @elseif(isset($state[$item]['value']['cs']))
        {{ $state[$item]['value']['cs'] }}
    @else
        {{ $state[$item]['name'] }}
    @endif
</div>