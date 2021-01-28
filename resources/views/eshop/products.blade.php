<x-layout.page-title>
    <h1>{{ __('eshop/products.title') }}</h1>
    <div class="flex space-x-3">
        <a href="{{ url('eshop/products/add-record') }}" class="btn-primary">
            {{ __('form.btn-add-record') }}
        </a>
    </div>
</x-layout.page-title>
<div class="mb-4 bg-white">
    @foreach($products as $key => $product)
        <div class="flex {{ $loop->first ? '' : 'border-t' }}">
            <a href="{{ url('eshop/products/edit-record/' . $product->id) }}" class="flex flex-col justify-between flex-grow w-2/3 px-4 py-4 text-sm font-medium leading-5 transition duration-200 cursor-pointer md:items-center md:flex-row sm:px-6 hover:bg-light-blue-500 hover:text-white">
                <div class="flex items-center">
                    <div class="hidden w-4 mr-6 text-base text-center sm:block">
                        {{ $key+1 }}
                    </div>
                    <div class="truncate">
                        {{ $product->title }}<br>
                        <span class="opacity-60">Autor: {{ $product->user->name }}</span>
                    </div>
                </div>
                <div class="flex flex-col flex-shrink-0 sm:ml-2 sm:flex-row sm:items-center sm:space-x-4">
                    <div class="mb-2 text-xs sm:text-right sm:mb-0 xs:text-sm">
                        <span class="hidden opacity-60 md:inline-block">Vytvořeno:</span> {{ date("H:i d.m.Y", strtotime($product->created_at)) }} <br class="hidden md:block">
                        @if ($product->updated_at != $product->created_at)
                        <span class="opacity-60 md:hidden">/</span>
                        <span class="hidden opacity-60 md:inline-block">Poslední úprava:</span> {{ date("H:i d.m.Y", strtotime($product->updated_at)) }}
                        @endif
                    </div>
                </div>
            </a>
            <div class="flex items-center px-4 text-red-500 transition duration-200 cursor-pointer hover:bg-red-500 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </div>
        </div>
    @endforeach
</div>
<div class="flex items-center justify-center mb-4 text-sm text-blue-gray-400">
    <button class="flex justify-center w-10 py-2 mr-1 font-bold transition duration-200 bg-white hover:bg-light-blue-500 hover:text-white">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>

    <button class="w-10 py-2 font-bold transition duration-200 bg-white hover:bg-light-blue-500 hover:text-white">1</button>
    <button class="w-10 py-2 font-bold transition duration-200 bg-white hover:bg-light-blue-500 hover:text-white">2</button>
    <button class="w-10 py-2 font-bold transition duration-200 bg-white hover:bg-light-blue-500 hover:text-white">3</button>
    <span class="px-2 py-2 bg-white">...</span>
    <button class="w-10 py-2 font-bold transition duration-200 bg-white hover:bg-light-blue-500 hover:text-white">15</button>
    <button class="w-10 py-2 font-bold transition duration-200 bg-white hover:bg-light-blue-500 hover:text-white">16</button>
    <button class="w-10 py-2 font-bold transition duration-200 bg-white hover:bg-light-blue-500 hover:text-white">17</button>
    
    <button class="flex justify-center w-10 py-2 ml-1 font-bold transition duration-200 bg-white hover:bg-light-blue-500 hover:text-white">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
</div>