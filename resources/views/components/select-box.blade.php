@props(['alpineVar' => null, 'value' => null, 'title' => null, 'description' => null])

<div
    @click="{{ $alpineVar }} = '{{ $value }}'"
    class="px-6 py-4 leading-7 border-2 rounded-lg cursor-pointer group"
    :class="{ 
        'bg-light-blue-100 text-light-blue-500 border-light-blue-300': {{ $alpineVar }} == '{{ $value }}',
        'text-gray-500 hover:bg-gray-100 hover:text-black hover:border-gray-300': {{ $alpineVar }} != '{{ $value }}'
    }"
>
    <p class="font-semibold">{{ $title }}</p>
    <p 
        class="text-xs"
        :class="{ 
            'text-light-blue-400': {{ $alpineVar }} == '{{ $value }}',
            'text-gray-400 group-hover:text-gray-500': {{ $alpineVar }} != '{{ $value }}'
        }"
    >
        {{ $description }}
    </p>
</div>