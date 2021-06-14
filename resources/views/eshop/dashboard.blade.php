<div>
    @section('title')
        {{ __('eshop/dashboard.title') }}
    @endsection
    <div class="flex mb-4 space-x-4">
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
    <div class="flex space-x-4">
        <div class="w-1/2">
            <table class="w-full mb-4 divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" colspan="2" class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">
                            Obrat ve dnech
                        </th>
                    </tr>
                </thead>
                <tbody class="w-full bg-white divide-y divide-gray-100">
                    @foreach ($totals as $key => $item)
                        <tr>
                            <td class="w-full px-6 py-3 whitespace-nowrap">
                                {{ date("d.m.Y", strtotime($key)) }}
                            </td>
                            <td class="w-full px-6 py-3 text-right whitespace-nowrap">
                                {{ $item['total'] }} Kč
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-1/2">
            <table class="w-full mb-4 divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" colspan="2" class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">
                            Obrat v měsících
                        </th>
                    </tr>
                </thead>
                <tbody class="w-full bg-white divide-y divide-gray-100">
                    @foreach ($totalsMonth as $key => $item)
                        <tr>
                            <td class="w-full px-6 py-3 whitespace-nowrap">
                                {{ $key }}.{{ $item['year'] }}
                            </td>
                            <td class="w-full px-6 py-3 text-right whitespace-nowrap">
                                {{ $item['total'] }} Kč
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <table class="min-w-full mb-4 divide-y divide-gray-200">
        <thead class="bg-gray-50 whitespace-nowrap">
            <tr>
                <th scope="col" class="px-6 py-4 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">
                    Sklad
                </th>
                <th scope="col" class="px-6 py-4 text-xs font-medium tracking-wider text-right text-gray-400 uppercase">
                    S (25)
                </th>
                <th scope="col" class="px-6 py-4 text-xs font-medium tracking-wider text-right text-gray-400 uppercase">
                    M (40)
                </th>
                <th scope="col" class="px-6 py-4 text-xs font-medium tracking-wider text-right text-gray-400 uppercase">
                    L (40)
                </th>
                <th scope="col" class="px-6 py-4 text-xs font-medium tracking-wider text-right text-gray-400 uppercase">
                    XL (40/50)
                </th>
                <th scope="col" class="px-6 py-4 text-xs font-medium tracking-wider text-right text-gray-400 uppercase">
                    2XL (15/35)
                </th>
                <th scope="col" class="px-6 py-4 text-xs font-medium tracking-wider text-right text-gray-400 uppercase">
                    3XL (10/30)
                </th>
            </tr>
        </thead>
        <tbody class="w-full bg-white divide-y divide-gray-100">
            @foreach ($products  as $key => $product)
                @if(!empty(collect($warehouse)->where('name', $product->title . ' - M')->first()))
                    <tr>
                        <td class="w-full px-6 py-4 whitespace-nowrap">
                            {{ $product->title }}
                        </td>
                        <td class="w-full px-6 py-4 text-right whitespace-nowrap">
                            {{ collect($warehouse)->where('name', $product->title . ' - S')->first()['send'] ?? '0' }}
                            ({{ collect($warehouse)->where('name', $product->title . ' - S')->first()['all'] ?? '0' }})
                        </td>
                        <td class="w-full px-6 py-4 text-right whitespace-nowrap">
                            {{ collect($warehouse)->where('name', $product->title . ' - M')->first()['send'] ?? '0' }}
                            ({{ collect($warehouse)->where('name', $product->title . ' - M')->first()['all'] ?? '0' }})
                        </td>
                        <td class="w-full px-6 py-4 text-right whitespace-nowrap">
                            {{ collect($warehouse)->where('name', $product->title . ' - L')->first()['send'] ?? '0' }}
                            ({{ collect($warehouse)->where('name', $product->title . ' - L')->first()['all'] ?? '0' }})
                        </td>
                        <td class="w-full px-6 py-4 text-right whitespace-nowrap">
                            {{ collect($warehouse)->where('name', $product->title . ' - XL')->first()['send'] ?? '0' }}
                            ({{ collect($warehouse)->where('name', $product->title . ' - XL')->first()['all'] ?? '0' }})
                        </td>
                        <td class="w-full px-6 py-4 text-right whitespace-nowrap">
                            {{ collect($warehouse)->where('name', $product->title . ' - 2XL')->first()['send'] ?? '0' }}
                            ({{ collect($warehouse)->where('name', $product->title . ' - 2XL')->first()['all'] ?? '0' }})
                        </td>
                        <td class="w-full px-6 py-4 text-right whitespace-nowrap">
                            {{ collect($warehouse)->where('name', $product->title . ' - 3XL')->first()['send'] ?? '0' }}
                            ({{ collect($warehouse)->where('name', $product->title . ' - 3XL')->first()['all'] ?? '0' }})
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    
</div>

