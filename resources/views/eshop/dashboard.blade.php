<div>
    @section('title')
        {{ __('eshop/dashboard.title') }}
    @endsection
    <div class="flex space-x-4">
        <div class="flex w-1/4 p-4 bg-white">
            <div class="relative text-light-blue-200">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <div class="absolute bottom-0 right-0 flex items-center justify-center w-6 h-6 text-sm text-black border-2 rounded-full opacity-50 bg-gray-50">
                    1
                </div>
            </div>
            <div class="pl-4 text-sm">
                <p class="text-xl font-bold">Objednávky</p>
                <p>{{ $ordersDay }} za tento den</p>
            </div>
        </div>
        <div class="flex w-1/4 p-4 bg-white">
            <div class="relative text-yellow-200">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <div class="absolute bottom-0 right-0 flex items-center justify-center w-6 h-6 text-sm text-black border-2 rounded-full opacity-50 bg-gray-50">
                    7
                </div>
            </div>
            <div class="pl-4 text-sm">
                <p class="text-xl font-bold">Objednávky</p>
                <p>{{ $ordersWeek }} za tento týden</p>
            </div>
        </div>
        <div class="flex w-1/4 p-4 bg-white">
            <div class="relative text-red-200">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <div class="absolute bottom-0 right-0 flex items-center justify-center w-6 h-6 text-sm text-black border-2 rounded-full opacity-50 bg-gray-50">
                    30
                </div>
            </div>
            <div class="pl-4 text-sm">
                <p class="text-xl font-bold">Objednávky</p>
                <p>{{ $ordersMonth }} za tento měsíc</p>
            </div>
        </div>
        <div class="flex w-1/4 p-4 bg-white">
            <div class="text-green-200">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
            </div>
            <div class="pl-4 text-sm">
                <p class="mb-1 text-base font-bold">Avg objednávka</p>
                <p>{{ $valueWeek ? $valueWeek : '0' }}Kč tento týden</p>
            </div>
        </div>
    </div>
    
</div>
