@php
    $child = explode('/',$url)[2] ?? '';
@endphp
<a 
    href="{{ url($url) }}" 
    class="inline-flex items-center px-6 py-4 border-b-2 focus:outline-none"
    :class="{ 'bg-light-blue-100 border-light-blue-500 text-light-blue-500': urlChild == '{{ $child }}', 'border-transparent hover:bg-blue-gray-100 hover:text-blue-gray-700 hover:border-blue-gray-300': urlChild != '{{ $child }}' }"
>
{{ $slot }}
</a>