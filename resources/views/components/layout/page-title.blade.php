<div class="relative flex items-center justify-between py-12 text-2xl font-bold">
    @include('components.layout.loading')
    @if ($errors->any())
    <div class="absolute inset-0 z-50 py-3 sm:max-w-xl sm:mx-auto" x-data={}>
        @foreach ($errors->all() as $key => $error)
        <div class="relative flex items-center px-6 py-3 mb-2 bg-white shadow-lg sm:rounded-3xl" x-ref="notif{{$key}}">
            <div class="mr-5">
                {{-- <div class="flex items-center justify-center w-8 h-8 text-green-500 bg-green-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div> --}}
                <div class="flex items-center justify-center w-10 h-10 text-red-500 bg-red-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
            <div class="flex-grow text-gray-700">
                <p class="text-base font-bold">Nastala chyba</p>
                <p class="text-sm font-normal">{{ $error }}</p>
            </div>
            <div class="ml-5">
                <div @click="$refs.notif{{$key}}.outerHTML = ''" class="flex items-center justify-center w-8 h-8 rounded-full cursor-pointer hover:bg-light-blue-100 text-light-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    {{ $slot }}
</div>