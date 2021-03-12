<div>
    @section('title')
        {{ __('eshop/carts.title') }}
    @endsection
    <div class="flex items-center justify-between mb-8">
        <div class="flex flex-wrap xs:space-x-2 bg-light-blue-200 rounded-xl bg-opacity-60">
            <button class="flex items-center px-4 py-2 text-sm font-semibold transition duration-200 cursor-pointer hover:bg-light-blue-300 text-light-blue-700 rounded-xl">
                <span>Vše</span>
            </button>
            <button class="flex items-center px-4 py-2 text-sm font-semibold text-white transition duration-200 cursor-pointer bg-light-blue-500 rounded-xl">
                <span>S nevyplněnými údaji</span>
            </button>
            <button class="flex items-center px-4 py-2 text-sm font-semibold transition duration-200 cursor-pointer hover:bg-light-blue-300 text-light-blue-700 rounded-xl">
                <span>S vyplněnými údaji</span>
            </button>
        </div>
    </div>
    @if($cart)
        <div class="fixed inset-0 z-50 flex items-center justify-center w-full min-h-screen px-8 py-3 bg-gray-800 bg-opacity-60 sm:bottom-auto">
            <div class="w-full sm:max-w-3xl">
                <div class="flex flex-col w-full shadow-lg bg-blue-gray-100 rounded-3xl">
                    <div class="flex items-center justify-between px-6 py-6 text-black shadow-sm sm:px-9 text-opacity-60 bg-gradient-to-r from-cyan-400 to-light-blue-400 rounded-t-3xl">
                        <div>
                        <p class="font-bold">Detail košíku: {{ $cart->code }}</p>
                        </div>
                        <button wire:click="closeCart" class="flex items-center justify-center w-10 h-10 rounded-full opacity-50 cursor-pointer hover:bg-light-blue-500 text-light-blue-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="px-6 py-6 bg-white shadow-sm sm:px-9 rounded-b-3xl">
                        <p class="mb-2 font-bold">Zatím vyplněné údaje:</p>
                        <div class="flex justify-between">
                            <div class="w-1/2 text-sm leading-6">
                                {!! isset($cart->address['order']->name) || isset($cart->address['order']->surname) ? "<strong>Jméno</strong>: " : '' !!}
                                {!! isset($cart->address['order']->name) ? $cart->address['order']->name . " " : '' !!}
                                {!! isset($cart->address['order']->surname) ? $cart->address['order']->surname : '' !!}
                                {!! isset($cart->address['order']->name) || isset($cart->address['order']->surname) ? " <br>" : '' !!}

                                {!! isset($cart->address['order']->street) ? "<strong>Ulice</strong>: " . $cart->address['order']->street . " <br>" : '' !!}
                                {!! isset($cart->address['order']->number) ? "<strong>Číslo popisné</strong>: " . $cart->address['order']->number . " <br>" : '' !!}
                                {!! isset($cart->address['order']->city) ? "<strong>Město</strong>: " . $cart->address['order']->city . " <br>" : '' !!}
                                {!! isset($cart->address['order']->post_code) ? "<strong>PSČ</strong>: " . $cart->address['order']->post_code . " <br>" : '' !!}
                                {!! isset($cart->address['order']->state) ? "<strong>Stát</strong>: " . $cart->address['order']->state . " <br>" : '' !!}
                            </div>
                            <div class="w-1/2 text-sm leading-6">
                                {!! isset($cart->email) ? "<strong>Email</strong>: " . $cart->email . " <br>" : '' !!}
                                {!! isset($cart->telephone) ? "<strong>Telefon</strong>: " . $cart->telephone . " <br>" : '' !!}
                                {!! isset($cart->shipment) ? "<strong>Způsob doručení</strong>: " . $cart->shipment->title . " <br>" : '' !!}
                                {!! isset($cart->payment) ? "<strong>Způsob platby</strong>: " . $cart->payment->title . " <br>" : '' !!}
                                {!! isset($cart->shipment) ? "<strong>ID doručení</strong>: " . $cart->shipment_code . " <br>" : '' !!}
                            </div>
                        </div>
                        
                        <div class="mt-8 text-sm leading-6 border-t border-l border-r sm:text-right">
                            @foreach ($cart->items as $item)
                            <div class="flex justify-between px-4 py-2 border-b">
                                <div>
                                {{ $item->quantity }}x {{ $item->name }}
                                </div>
                                <div>
                                    {{ $item->variant->price_include_VAT }} Kč | {{ $item->variant->price_include_VAT * $item->quantity }} Kč
                                </div>
                            </div>
                            @endforeach
                            @if (isset($cart->payment) && isset($cart->shipment))
                            <div class="flex justify-between px-4 py-2 border-b">
                                <div>
                                Doprava
                                </div>
                                <div>
                                    {{ $cart->payment->price + $cart->shipment->price }} Kč
                                </div>
                            </div>
                            @endif
                            <div class="flex justify-between px-4 py-2 font-bold border-b">
                                <div>
                                    Celkem
                                </div>
                                <div>
                                    {{ $cart->total }} Kč
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="space-y-3">
        @foreach ($carts as $key => $cart)
            <button wire:key="{{ $cart->id }}" wire:click="showCart({{ $cart->id }})" class="w-full px-4 py-4 text-gray-800 transition duration-200 bg-white sm:px-6 hover:text-light-blue-500">
                <div class="flex items-center justify-between text-sm font-medium leading-5">
                    <div class="flex items-center">
                        <div class="hidden w-4 mr-6 text-base text-center sm:block">
                            {{ $key+1 }}
                        </div>
                        <div class="truncate">
                            {{ $cart->code }} <span class="opacity-50">- Cena: {{ $cart->total }} Kč</span><br>
                        </div>
                    </div>
                    <div class="flex flex-col items-end flex-shrink-0 ml-2 space-x-4 sm:flex-row sm:items-center">
                        <div class="mb-2 text-right sm:mb-0">
                            {{ date("H:i d.m.Y", strtotime($cart->created_at)) }} <span class="opacity-50">/</span> {{ date("H:i d.m.Y", strtotime($cart->updated_at)) }}
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
