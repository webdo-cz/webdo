<div>
    @section('title')
        {{ __('eshop/orders.title') }}
    @endsection
    <div class="flex items-center justify-between mb-8">
        <div class="flex flex-wrap xs:space-x-2 bg-light-blue-200 rounded-xl bg-opacity-60">
            <button class="flex items-center px-4 py-2 text-sm font-semibold transition duration-200 cursor-pointer hover:bg-light-blue-300 text-light-blue-700 rounded-xl">
                <span>Vše</span>
            </button>
            <button class="flex items-center px-4 py-2 text-sm font-semibold text-white transition duration-200 cursor-pointer bg-light-blue-500 rounded-xl">
                <span>Nevyřízené</span>
            </button>
            <button class="flex items-center px-4 py-2 text-sm font-semibold transition duration-200 cursor-pointer hover:bg-light-blue-300 text-light-blue-700 rounded-xl">
                <span>Vyřízené</span>
            </button>
            <button class="flex items-center px-4 py-2 text-sm font-semibold transition duration-200 cursor-pointer hover:bg-light-blue-300 text-light-blue-700 rounded-xl">
                <span>Stornované</span>
            </button>
        </div>
    </div>
    @if($order)
        <div class="fixed inset-0 z-50 flex items-center justify-center w-full max-h-full min-h-screen px-8 py-3 overflow-y-scroll bg-gray-800 bg-opacity-60 sm:bottom-auto">
            <div class="w-full max-h-full sm:max-w-3xl">
                <div class="flex flex-col w-full max-h-full shadow-lg bg-blue-gray-100 rounded-3xl">
                    <div class="flex items-center justify-between px-6 py-6 text-black shadow-sm sm:px-9 text-opacity-60 bg-gradient-to-r from-cyan-400 to-light-blue-400 rounded-t-3xl">
                        <div>
                            <p class="font-bold">Detail objednávky</p>
                        </div>
                        <button wire:click="closeOrder" class="flex items-center justify-center w-10 h-10 rounded-full opacity-50 cursor-pointer hover:bg-light-blue-500 text-light-blue-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="max-h-full px-6 py-6 bg-white shadow-sm sm:px-9 rounded-b-3xl">
                        <div class="flex flex-col justify-between sm:flex-row">
                            <div class="text-sm leading-6">
                                <strong>Email</strong>: {{ $order->email }} <br>
                                <strong>Telefon</strong>: {{ $order->telephone }} <br>

                                <strong>Jméno</strong>: {{ $order->address['order']->name }} {{ $order->address['order']->surname }}
                                @if (isset($order->address['delivery']->name) && isset($order->address['delivery']->surname))
                                , <strong>Doručovací jméno</strong>: {{ $order->address['delivery']->name }} {{ $order->address['delivery']->surname }}
                                @endif
                                <br>

                                <strong>Adresa</strong>: {{ $order->address['order']->street }} {{ $order->address['order']->number }}, {{ $order->address['order']->post_code }} {{ $order->address['order']->city }}
                                @if (isset($order->address['delivery']->street) || isset($order->address['delivery']->number) || isset($order->address['delivery']->post_code) || isset($order->address['delivery']->city))
                                    , <strong>Doručovací: adresa</strong>: 
                                    {{ $order->address['delivery']->street }} 
                                    {{ $order->address['delivery']->number }}, 
                                    {{ $order->address['delivery']->post_code }} 
                                    {{ $order->address['delivery']->city }}
                                @endif
                                <br>

                                <strong>Stát</strong>: {{ $order->address['order']->state }}
                                @if (isset($order->address['delivery']->state))
                                , <strong>Doručovací stát</strong>: {{ $order->address['delivery']->state }}
                                @endif
                                <br>

                                <strong>Způsob doručení</strong>: {{ $order->shipment->title }} <br>
                                <strong>Způsob platby</strong>: {{ $order->payment->title }} <br>
                                <strong>ID doručení</strong>: {{ $order->shipment_code }}  <br>
                                <strong>Variabilní symbol</strong>: {{ $order->payment_code }}  <br>
                            </div>
                            <div class="mt-2 space-y-2 text-sm leading-6 sm:text-right sm:mt-0">
                                <a href="{{ url('invoice/' . (isset($order->invoice) ? 'show/' . $order->invoice->number : 'generate/' . $order->id) ) }}" target="_blank" class="flex items-center px-4 py-2 font-semibold text-gray-500 bg-gray-100 hover:bg-gray-200 rounded-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                    Faktura
                                </a>
                                <button wire:click="changeStatus('canceled', 0)" class="px-4 py-2 font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl">Storno</button>
                            </div>
                        </div>
                        @if ($order->note)
                            <div class="relative pt-3 mt-4">
                                <div class="absolute top-0 px-2 pt-1 text-sm font-bold bg-white left-2">Poznámka</div>
                                <div class="p-4 text-sm leading-6 border">
                                    {{ $order->note }}
                                </div>
                            </div>
                        @endif
                        <div class="mt-8 text-sm leading-6 border-t border-l border-r sm:text-right">
                            @foreach ($cart as $item)
                            <div class="flex justify-between px-4 py-2 border-b">
                                <div>
                                {{ $item->quantity }}x {{ $item->name }}
                                </div>
                                <div>
                                    {{ $item->variant->price_include_VAT }} Kč | {{ $item->variant->price_include_VAT * $item->quantity }} Kč
                                </div>
                            </div>
                            @endforeach
                            @if (isset($order->payment) && isset($order->shipment))
                            <div class="flex justify-between px-4 py-2 border-b">
                                <div>
                                Doprava
                                </div>
                                <div>
                                    {{ $order->payment->price + $order->shipment->price }} Kč
                                </div>
                            </div>
                            @endif
                            <div class="flex justify-between px-4 py-2 font-bold border-b">
                                <div>
                                    Celkem
                                </div>
                                <div>
                                    {{ $order->total }} Kč
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-6 py-2 space-x-2 text-sm">
                        @if($status > 1)
                            <button wire:click="changeStatus('{{ $statuses[$status-1] }}',{{ $status-1 }})" class="flex items-center px-4 py-2 font-semibold text-white bg-yellow-500 hover:bg-yellow-600 rounded-xl">
                                <span>{{ $statuses[$status-1] }}</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </button>
                        @endif
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center btn-transparent">
                                <span>{{ $statuses[$status] }}</span>
                            </button>
                            <div @click.away="open = false" x-show="open" class="absolute z-30 flex flex-col text-sm shadow-md -right-1/2 bg-blue-gray-800 bottom-12 rounded-xl text-blue-gray-400 whitespace-nowrap">
                                @foreach ($statuses as $key => $statusSlug)
                                    <button @click="open = false" wire:click="changeStatus('{{ $statusSlug }}',{{ $key }})" class="py-2 hover:bg-blue-gray-700 pl-5 pr-12 hover:text-white cursor-pointer {{ $loop->first ? 'rounded-t-xl' : '' }} {{ $loop->last ? 'rounded-b-xl' : '' }}">
                                        {{ $statusSlug }}
                                    </button>
                                @endforeach
                              </div>
                        </div>
                        @if($status < 7)
                            <button wire:click="changeStatus('{{ $statuses[$status+1] }}',{{ $status+1 }})" class="flex items-center px-4 py-2 font-semibold text-white bg-light-blue-500 hover:bg-light-blue-600 rounded-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                                <span>{{ $statuses[$status+1] }}</span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="space-y-3">
        @foreach ($orders as $key => $order)
            <button  wire:key="{{ $order->id }}" wire:click="showOrder({{ $order->id }})" class="w-full px-4 py-4 bg-white sm:px-6 hover:text-light-blue-500">
                <div class="flex items-center justify-between text-sm font-medium leading-5">
                    <div class="flex items-center">
                        <div class="hidden w-4 mr-6 text-base text-center sm:block">
                            {{ $key+1 }}
                        </div>
                        <div class="text-left truncate">
                            {{ $order->address['order']->name }} {{ $order->address['order']->surname }} <span class="hidden xs:inline-block">-  {{ $order->address['order']->city }}</span>
                            <br><span class="opacity-50">Cena: {{ $order->total }} Kč</span>
                        </div>
                    </div>
                    <div class="flex flex-col items-end flex-shrink-0 ml-2 space-x-4 sm:flex-row sm:items-center">
                        <div class="mb-2 text-right sm:mb-0">
                            <span class="hidden opacity-50 md:inline-block">Vytvořeno:</span> {{ date("H:i d.m.Y", strtotime($order->created_at)) }}
                        </div>
                        @if ($order->status == "done")
                        <div class="inline-flex px-3 py-1 text-xs font-semibold leading-5 text-green-600 bg-green-100 rounded-full">
                        @elseif($order->status == "canceled")
                        <div class="inline-flex px-3 py-1 text-xs font-semibold leading-5 text-red-600 bg-red-100 rounded-full">
                        @else()
                        <div class="inline-flex px-3 py-1 text-xs font-semibold leading-5 text-yellow-600 bg-yellow-100 rounded-full">
                        @endif
                            {{ $order->status }}
                        </div>
                    </div>
                </div>
            </button>
        @endforeach
    </div>
    {{-- <div class="flex items-center justify-center mb-4 text-sm text-blue-gray-400">
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
    </div> --}}
</div>
