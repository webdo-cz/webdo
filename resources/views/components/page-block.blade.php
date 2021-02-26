@props(['children'])

<div>
    @foreach ($children as $item)
    <div class="p-4 border">
        {{ $item->name }} - {{ $item->label }} - {{ $item->value }} - {{ $item->type }}
        <x-page-block :children="$item->children"/>
    </div>
    @endforeach
</div>