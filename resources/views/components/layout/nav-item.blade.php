@php
    $urlE = explode('/',$url);
    $section = $urlE[0] ?? '';
    $parent = $urlE[1] ?? '';
@endphp
<a 
    href="{{ url($url) }}" 
    class="flex items-center w-full px-4 py-4 border-l-4 border-transparent sm:py-2"
    :class="{ 'bg-light-blue-100 text-light-blue-500 border-light-blue-500': urlSection + urlParent == '{{ $section.$parent }}', 'hover:bg-blue-gray-100 hover:text-blue-gray-700 hover:border-blue-gray-300': urlSection + urlParent != '{{ $section.$parent }}' }"
>
    {{ $slot }}
</a>