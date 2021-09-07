<div>
    @section('title')
        Košíky
    @endsection
    <x-layout.page-title/>
    
    @if($cart)
        <x-modal wireClose="closeCart">
            <x-slot name="header">
                <p class="font-bold">Detail košíku: {{ $cart->code }}</p>
                <p class="text-sm">Zatím vyplněné údaje</p>
            </x-slot>
            <div class="relative flex flex-col justify-between w-full">
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
                
                <div class="w-full mt-8 text-sm leading-6 border-t border-l border-r sm:text-right">
                    @foreach ($cart->items as $item)
                        <div class="flex justify-between px-4 py-2 border-b">
                            <div>
                            {{ $item->quantity }}x {{ $item->name }}
                            </div>
                            <div>
                                {{ $item->variant->price }} Kč | {{ $item->variant->price * $item->quantity }} Kč
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
        </x-modal>
    @endif
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-4 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 pl-6"></th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">
                                    Titulek
                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-right text-gray-400 uppercase">
                                    Vytvoření / Poslední úprava
                                </th>
                                <th scope="col" class="py-3 pr-6"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($carts as $key => $cart)
                                <tr>
                                    <td class="py-3 pl-6 whitespace-nowrap">
                                        {{ $carts->firstItem() ? $carts->firstItem()+$key : $key+1 }}
                                    </td>
                                    <td class="w-full px-4 py-3 whitespace-nowrap">
                                        <button wire:click="showCart({{ $cart->id }})" type="button" class="text-sm text-left text-gray-900 hover:text-light-blue-500">
                                            {{ $cart->code }} <span class="text-gray-500">- Cena: {{ $cart->total }} Kč</span>
                                        </button>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-right text-gray-500 whitespace-nowrap">
                                        {{ date("H:i d.m.Y", strtotime($cart->created_at)) }} 
                                        <span class="text-gray-400">/</span> 
                                        {{ date("H:i d.m.Y", strtotime($cart->updated_at)) }}
                                    </td>
                                    <td class="py-3 pr-6 text-sm font-medium text-right whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="#" class="text-yellow-400 hover:text-yellow-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            {{-- <a href="#" class="text-light-blue-400 hover:text-light-blue-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a> --}}
                                            <a href="#" class="text-red-400 hover:text-red-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
             </div>
        </div>
        <div class="flex items-center justify-center pt-4">
            {{ $carts->links() }}
        </div>
    </div>
</div>