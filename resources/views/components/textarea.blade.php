@props(['inputId' => rand(1111111, 9999999), 'name', 'label', 'type' => 'text', 'value' => null, 'rows' => '3'])
<div class="w-full text-sm">
    <label for="{{ $inputId }}" class="pl-2 text-blue-gray-500">
        {{ $label }} @error($name) - <span class="font-normal text-red-500">{{ $message }}</span> @enderror
    </label>
    <textarea 
        id="{{ $inputId }}" 
        name="{{ $name }}" 
        rows="{{ $rows }}" 
        {!! $attributes !!} 
        class="w-full px-4 py-2 mt-1 bg-white border-2 rounded-lg form focus:outline-none border-blue-gray-300  @error($name) border-red-300 @enderror"
    >{{ $value }}</textarea>

</div>