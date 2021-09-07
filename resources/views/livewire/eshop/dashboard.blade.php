<div>
    @section('title')
        {{ __('web/dashboard.title') }}
    @endsection

    <div class="flex space-x-4">
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
                            {{ $key }}
                        </td>
                        <td class="w-full px-6 py-3 text-right whitespace-nowrap">
                            {{ $item['total'] }} Kč
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
    
    {{-- <p>Sklad</p>
    <table class="mb-4">
        <tbody class="w-full bg-white divide-y divide-gray-100">
            @foreach ($warehouse as $key => $item)
                <tr>
                    <td class="w-full px-6 py-4 whitespace-nowrap">
                        {{ $key }}
                    </td>
                    <td class="w-full px-6 py-4 text-right whitespace-nowrap">
                        {{ $item }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
</div>
