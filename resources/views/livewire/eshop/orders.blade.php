<div>
    @section('title')
        Objednávky
    @endsection
    <x-layout.page-title>
        <div></div>
        <div class="flex space-x-3">
            <a href="{{ url('web/product/create') }}" class="btn-primary">
                <span class="px-3 py-1">Vytvořit objednávku</span>
            </a>
        </div>
    </x-layout.page-title>
    
    <div 
        x-data="{
            modalSubmitPackage: false,
            successCopy: false,
            copy(content) {
                var aux = document.createElement('input');
                aux.setAttribute('value', content);
                document.body.appendChild(aux);
                aux.select();
                document.execCommand('copy');
                document.body.removeChild(aux);
                if(this.successCopy == true) {
                    this.successCopy = false;
                    setTimeout(() => { this.successCopy = true; }, 100);
                }else {
                    this.successCopy = true;
                }
                setTimeout(() => { this.successCopy = false; }, 4000);
            }
        }"
    >
        @if($order)
            <x-modal wireClose="closeOrder">
                <x-slot name="header">
                    <p class="font-bold">Detail objednávky</p>
                    <p class="text-sm">Informace o objednávce sloužící k odeslání zásilky.</p>
                </x-slot>
                <div class="relative flex flex-col justify-between sm:flex-row">
                    <div x-show.transition="successCopy" class="absolute inset-x-0 w-full text-sm font-bold text-center text-green-500 -top-5">
                        Údaj byl zkopírován do schránky!
                    </div>
                    <div class="text-sm leading-6">
                        <strong>Email</strong>: <span @click="copy($event.target.innerHTML)">{{ $order->email }}</span> <br>
                        <strong>Telefon</strong>: <span @click="copy($event.target.innerHTML)">{{ $order->telephone }}</span> <br>

                        <strong>Jméno</strong>: 
                        <span @click="copy($event.target.innerHTML)">{{ $order->address['order']->name }}</span> 
                        <span @click="copy($event.target.innerHTML)">{{ $order->address['order']->surname }}</span>
                        <br>
                        @if(isset($order->address['delivery']->name) && isset($order->address['delivery']->surname))
                        <strong>Doručovací jméno</strong>: 
                        <span @click="copy($event.target.innerHTML)">{{ $order->address['delivery']->name }}</span> 
                        <span @click="copy($event.target.innerHTML)">{{ $order->address['delivery']->surname }}</span>
                        <br>
                        @endif

                        <strong>Adresa</strong>: 
                        <span @click="copy($event.target.innerHTML)">{{ $order->address['order']->street }}</span> 
                        <span @click="copy($event.target.innerHTML)">{{ $order->address['order']->number }}</span>, 
                        <span @click="copy($event.target.innerHTML)">{{ $order->address['order']->post_code }}</span> 
                        <span @click="copy($event.target.innerHTML)">{{ $order->address['order']->city }}</span>
                        <br>
                        @if (isset($order->address['delivery']->street) || isset($order->address['delivery']->number) || isset($order->address['delivery']->post_code) || isset($order->address['delivery']->city))
                            <strong>Doručovací: adresa</strong>: 
                            <span @click="copy($event.target.innerHTML)">{{ $order->address['delivery']->street }}</span> 
                            <span @click="copy($event.target.innerHTML)">{{ $order->address['delivery']->number }}</span>, 
                            <span @click="copy($event.target.innerHTML)">{{ $order->address['delivery']->post_code }}</span> 
                            <span @click="copy($event.target.innerHTML)">{{ $order->address['delivery']->city }}</span>
                            <br>
                        @endif

                        <strong>Stát</strong>: {{ $order->address['order']->state }} <br>
                        @if (isset($order->address['delivery']->state))
                        <strong>Doručovací stát</strong>: {{ $order->address['delivery']->state }} <br>
                        @endif

                        <strong>Způsob doručení</strong>: {{ $order->shipment->title }} <br>
                        <strong>Způsob platby</strong>: {{ $order->payment->title }} <br>
                        <strong>ID doručení</strong>: <span @click="copy($event.target.innerHTML)">{{ $order->shipment_code }}</span>  <br>
                        <strong>Variabilní symbol</strong>: <span @click="copy($event.target.innerHTML)">{{ $order->payment_code }}</span>  <br>
                    </div>
                    <div class="flex flex-col items-end mt-2 space-y-2 text-sm leading-6 sm:text-right sm:mt-0">
                        <button @click="modalSubmitPackage = true" type="button" class="flex px-4 py-2 font-semibold text-white bg-green-500 hover:bg-green-600 rounded-xl">
                            Podat zásilku
                        </button>
                        <a href="{{ url('invoice/' . (isset($order->invoice) ? 'show/' . $order->invoice->number : 'generate/' . $order->id) ) }}" target="_blank" class="flex items-center flex-shrink px-4 py-2 font-semibold text-gray-500 bg-gray-100 hover:bg-gray-200 rounded-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                            Faktura
                        </a>
                        <button wire:click="changeStatus('canceled', 0)" class="px-4 py-2 font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl">
                            Storno
                        </button>
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
                            {{ $item->variant->price }} Kč | {{ $item->variant->price * $item->quantity }} Kč
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
                <x-slot name="footer">
                    <div class="flex items-center justify-end space-x-2 text-sm">
                        @if($status > 1)
                            <button wire:click="changeStatus('{{ $statuses[$status-1] }}',{{ $status-1 }})" class="flex items-center px-4 py-2 font-semibold text-white bg-yellow-500 hover:bg-yellow-600 rounded-xl">
                                <span>{{ __('eshop/orders.badge.' . $statuses[$status-1]) }}</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </button>
                        @endif
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center btn-transparent">
                                <span>{{ __('eshop/orders.badge.' . $statuses[$status]) }}</span>
                            </button>
                            <div @click.away="open = false" x-show="open" class="absolute z-30 flex flex-col text-sm shadow-md -right-1/2 bg-blue-gray-800 bottom-12 rounded-xl text-blue-gray-400 whitespace-nowrap">
                                @foreach ($statuses as $key => $statusSlug)
                                    <button @click="open = false" wire:click="changeStatus('{{ $statusSlug }}',{{ $key }})" class="py-2.5 text-left hover:bg-blue-gray-700 pl-6 pr-8 hover:text-white cursor-pointer {{ $loop->first ? 'rounded-t-xl' : '' }} {{ $loop->last ? 'rounded-b-xl' : '' }}">
                                        {{ __('eshop/orders.badge.' . $statusSlug) }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        @if($status < 7)
                            <button wire:click="changeStatus('{{ $statuses[$status+1] }}',{{ $status+1 }})" class="flex items-center px-4 py-2 font-semibold text-white bg-light-blue-500 hover:bg-light-blue-600 rounded-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                                <span>{{ __('eshop/orders.badge.' . $statuses[$status+1]) }}</span>
                            </button>
                        @endif
                    </div>
                </x-slot>
            </x-modal>
            <x-modal alpineVar="modalSubmitPackage" size="sm" title="Podání zísilky">
                <div class="grid grid-cols-3">
                    <div class="text-sm py-2.5 font-bold text-gray-600">Typ dopravce:</div>
                    <div x-data="{ open: false, type: 'Zasilkovna' }" class="relative col-span-2">
                        <div @click="open = !open" class="flex w-full px-4 py-2 text-sm bg-white border border-gray-300 rounded-lg">
                            <input x-model="type" disabled type="text" placeholder="Vybrat službu" class="w-full pr-3 text-black truncate disabled:bg-white"/>
                            <div class="absolute inset-0 w-full h-full bg-transparent"></div>
                            <span :class="{ 'transform rotate-180': open }" class="absolute top-3 right-4 text-blue-gray-400">
                                <svg class="w-4 h-4 mt-0 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </div>
                        <div @click.away="open = false" x-show="open" class="transition duration-200 ease-in-out">
                            <div @click="open = !open" class="absolute left-0 z-30 flex flex-col text-sm bg-white shadow-md top-10 rounded-xl text-blue-gray-600 whitespace-nowrap">
                                <span @click="type = 'Zasilkovna'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-t-xl">Zasilkovna</span>
                                <span @click="type = 'DPD'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-b-xl">DPD</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 mt-6">
                    <div class="text-sm py-2.5 font-bold text-gray-600">Váha:</div>
                    <div class="col-span-2">
                        <x-input wire:model.defer="packageDetails.weight" name="weight" endLabel="Kg"></x-input>
                    </div>
                </div>
                <button wire:click="submitPackageZasilkovna" type="button" class="flex px-4 py-2 mt-6 text-sm font-semibold text-white bg-green-500 hover:bg-green-600 rounded-xl">
                    Podat zásilku
                </button>
            </x-modal>
        @endif
    </div>
    <div 
        x-data="{
            selected: []
        }"
        class="flex flex-col"
    >
        <div class="flex justify-between">
            <div class="flex items-center px-4 pb-4 space-x-2">
                @if(!empty($select))
                    <div class="pr-2 text-sm text-gray-500">Vybrané ({{ count($select) }})</div>
                    <button class="text-red-500 bg-red-100 btn hover:text-red-700">
                        Smazat
                    </button>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" type="button" class="btn bg-light-blue-100 text-light-blue-500 hover:text-light-blue-700">
                            Změnit status
                        </button>
                        <div @click.away="open = false" x-show="open" class="absolute z-30 flex flex-col text-sm shadow-md -right-1/2 bg-blue-gray-800 top-12 rounded-xl text-blue-gray-400 whitespace-nowrap">
                            @foreach ($statuses as $key => $statusSlug)
                                <button @click="open = false" wire:click="changeMultipleStatus('{{ $statusSlug }}')" class="py-2.5 text-left hover:bg-blue-gray-700 pl-6 pr-8 hover:text-white cursor-pointer {{ $loop->first ? 'rounded-t-xl' : '' }} {{ $loop->last ? 'rounded-b-xl' : '' }}">
                                    {{ __('eshop/orders.badge.' . $statusSlug) }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="flex items-center px-4 pb-4 space-x-2">
                <div class="pr-2 text-sm text-gray-500">Filtr:</div>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="px-4 py-2 text-sm text-gray-600 bg-blue-900 rounded-lg bg-opacity-5 hover:bg-opacity-10">
                        Status
                    </button>
                    <div @click.away="open = false" x-show="open" style="display: none" class="absolute right-0 z-30 flex flex-col py-5 text-sm text-gray-800 bg-white shadow-md px-7 top-12 rounded-xl whitespace-nowrap">
                        @foreach ($statuses as $key => $statusSlug)
                            <label class="flex items-center justify-start mb-2">
                                <div class="flex items-center justify-center w-5 h-5 mr-2 bg-white border border-gray-300 rounded">
                                    <input wire:model.defer="filterForm.status" value="{{ $statusSlug }}" type="checkbox" class="absolute opacity-0 checkbox" />
                                    <svg class="w-3 h-3 transition duration-200 ease-in-out transform opacity-0 fill-current text-light-blue-500" viewBox="0 0 20 20">
                                        <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                    </svg>
                                </div>
                                {{ __('eshop/orders.badge.' . $statusSlug) }}
                            </label>
                        @endforeach
                        <button @click="open = false" wire:click="submitFilter()" type="button" class="w-full mt-2 btn-primary">
                            <span class="w-full text-center">Použít</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
                                <th scope="col" class="px-5 py-3 text-xs font-medium tracking-wider text-right text-gray-400 uppercase">
                                    Status
                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-right text-gray-400 uppercase">
                                    Vytvoření
                                </th>
                                <th scope="col" class="py-3 pr-6"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td class="py-3 pl-6 whitespace-nowrap">
                                        <label class="flex items-center justify-start mb-1">
                                            <div class="flex items-center justify-center w-5 h-5 mr-2 bg-white border border-gray-300 rounded">
                                                <input wire:model.lazy="select" value="{{ $order->id }}" type="checkbox" class="absolute opacity-0 checkbox" />
                                                <svg class="w-3 h-3 transition duration-200 ease-in-out transform opacity-0 fill-current text-light-blue-500" viewBox="0 0 20 20">
                                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                </svg>
                                            </div>
                                        </label>
                                    </td>
                                    <td class="w-full px-4 py-3 whitespace-nowrap">
                                        <button wire:click="showOrder({{ $order->id }})" type="button" class="text-sm text-left text-gray-900 hover:text-light-blue-500">
                                            <div>
                                                {{ $order->address['order']->name }} {{ $order->address['order']->surname }} - {{ $order->address['order']->city }}
                                            </div>
                                            <div class="text-gray-500">
                                                Cena: {{ $order->total }} Kč
                                            </div>
                                        </button>
                                    </td>
                                    <td class="px-4 py-3 text-right whitespace-nowrap">
                                        <span class="badge-{{ $order->status }} px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-600">
                                            {{ __('eshop/orders.badge.' . $order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-right text-gray-500 whitespace-nowrap">
                                        {{ date("H:i d.m.Y", strtotime($order->submited_at)) }}
                                    </td>
                                    <td class="py-3 pr-6 text-sm font-medium text-right whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="#" class="text-yellow-400 hover:text-yellow-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="#" class="text-light-blue-400 hover:text-light-blue-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
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
                        <style>
                            .badge-done {
                                color: #fff;
                                background: #059669;
                            }
                            .badge-delivered {
                                color: #059669;
                                background: #D1FAE5;
                            }
                            .badge-send {
                                color: #D97706;
                                background: #FEF3C7;
                            }
                            .badge-waiting-for-send {
                                color: #475569;
                                background: #F1F5F9;
                            }
                            .badge-packing {
                                color: #2563EB;
                                background: #DBEAFE;
                            }
                            .badge-waiting-for-packing {
                                color: #7C3AED;
                                background: #EDE9FE;
                            }
                            .badge-waiting-for-payment {
                                color: #DC2626;
                                background: #FEE2E2;
                            }
                            .badge-canceled {
                                color: #fff;
                                background: #DC2626;
                            }
                        </style>
                    </table>
                </div>
             </div>
        </div>
        <div class="flex items-center justify-center pt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>