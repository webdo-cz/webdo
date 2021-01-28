<div class="overflow-x-auto overflow-y-none md:overflow-visible">
    <label class="flex items-center justify-start my-4">
        <div class="flex items-center h-6 px-1 mr-2 bg-white border-2 border-gray-300 rounded-full outline-none w-11">
            <input wire:model="oneVariant" type="checkbox" class="absolute opacity-0 switch" />
            <div class="w-4 h-4 transition duration-200 ease-in-out transform bg-gray-300 rounded-full"></div>
        </div>
        <div class="text-blue-gray-500">Produkt má jen jednu variantu</div>
    </label>
    <table class="w-full mt-6 text-sm">
        <tr class="text-left bg-blue-gray-200 text-blue-gray-600">
            @if(!$oneVariant)
            <th class="px-4 py-2">Název</th>
            @endif
            <th class="px-4 py-2">Cena</th>
            <th class="px-4 py-2">DPH</th>
            <th class="px-4 py-2">Hmotnost</th>
            @if(!$oneVariant)
            <th class="px-4 py-2">Kód</th>
            <th class="px-4 py-2 text-right">Dostupnost</th>
            @else
            <th class="px-4 py-2 text-right" colspan="2">
                Dostupnost
                @if($oneVariant)
                &nbsp;/&nbsp;
                Dostupnost při vyprodání
                @endif
            </th>
            @endif
            @if(!$oneVariant)
            <th class="px-4 py-2 text-right"></th>
            @endif
        </tr>
        @if(!$oneVariant)
        @foreach($state['variants']['prev'] as $key => $variant)
        <tr class="bg-white border-b">
            <td class="px-4 py-3">{{ $variant['name'] }}</td>
            <td class="px-4 py-3">{{ $variant['price_include_VAT'] }} Kč</td>
            <td class="px-4 py-3">{{ $variant['VAT_rate'] }}</td>
            <td class="px-4 py-3">{{ $variant['weight'] }}</td>
            <td class="px-4 py-3">{{ $state['id'] }}/{{ $variant['name'] }}</td>
            <td class="px-4 py-3 text-right">{{ $variant['availability'] }} / {{ $variant['availability_empty'] }}</td>
            <td class="px-4 py-3 space-x-2 text-right">
                <span wire:click.prevent="editVariant({{ $key }})" class="font-bold cursor-pointer text-light-blue-500">Upravit</span>
                <span wire:click.prevent="removeFrom({{ $key }}, 'prevVariants')" wire:loading.attr="disabled" class="font-bold text-red-500 cursor-pointer">Odstranit</span>
            </td>
        </tr>
        @endforeach
        @foreach($state['variants']['new'] as $key => $variant)
        <tr class="bg-white border-b">
            <td class="px-4 py-3">{{ $variant['name'] }}</td>
            <td class="px-4 py-3">{{ $variant['price'] }} Kč</td>
            <td class="px-4 py-3">{{ $variant['vat'] }}</td>
            <td class="px-4 py-3">{{ $variant['weight'] }} Kg</td>
            <td class="px-4 py-3">{{ $variant['code'] }}</td>
            <td class="px-4 py-3 text-right">{{ $variant['availability'] }} / {{ $variant['availabilityE'] }}</td>
            <td class="px-4 py-3 space-x-2 text-right">
                <span wire:click.prevent="editVariant({{ $key }})" class="font-bold cursor-pointer text-light-blue-500">Upravit</span>
                <span wire:click.prevent="removeFrom({{ $key }}, 'variants')" wire:loading.attr="disabled" class="font-bold text-red-500 cursor-pointer">Odstranit</span>
            </td>
        </tr>
        @endforeach
        @endif
        <tr class="bg-white" x-data="{ vat_open: false, availability_open: false, availability: false, availabilityE_open: false}">
            @if(!$oneVariant)
            <td class="px-4 py-3">
                <input wire:model.defer="variantForm.name" type="text" class="w-16 px-2 py-1 border rounded-md form border-blue-gray-300" placeholder="Název">
            </td>
            @endif
            <td class="flex items-center px-4 py-4 flex-nowrap">
                <input wire:model.defer="variantForm.price" type="text" class="w-20 px-2 py-1 border rounded-md form border-blue-gray-300" placeholder="Cena">
                <p class="pl-1">Kč</p>
            </td>
            <td class="px-4 py-3">
                <div class="relative flex-none inline-block">
                    <div @click="vat_open = !vat_open" class="flex w-full px-3 py-1 text-sm bg-white border rounded-lg border-blue-gray-300">
                        <input wire:model="variantForm.vat" type="text" placeholder="DPH" class="w-12 pr-3 text-black truncate"/>
                        <div class="absolute inset-0 w-full h-full bg-transparent"></div>
                        <span :class="{ 'transform rotate-180': vat_open }" class="absolute top-2 right-2 text-blue-gray-400">
                            <svg class="w-4 h-4 mt-0 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                    </div>
                    <div @click.away="vat_open = false" x-show="vat_open" class="transition duration-200 ease-in-out">
                        <div @click="vat_open = !vat_open" class="absolute left-0 z-30 flex flex-col text-sm bg-white shadow-md top-10 rounded-xl text-blue-gray-600 whitespace-nowrap">
                            <span wire:click="$set('variantForm.vat', '0%')" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-t-xl">0%</span>
                            <span wire:click="$set('variantForm.vat', '10%')" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">10%</span>
                            <span wire:click="$set('variantForm.vat', '15%')" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">15%</span>
                            <span wire:click="$set('variantForm.vat', '21%')" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-b-xl">21%</span>
                        </div>
                    </div>
                </div>
            </td>
            <td class="flex items-center px-4 py-4 flex-nowrap">
                <input wire:model.defer="variantForm.weight" type="text" class="w-20 px-2 py-1 border rounded-md form border-blue-gray-300" placeholder="Hmotnost">
                <p class="pl-1">Kg</p>
            </td>
            <td class="px-4 py-3" colspan="2">
                <div class="flex justify-end">
                    <div class="relative flex-none inline-block">
                        <div @click="availability_open = !availability_open" class="flex w-full px-3 py-1 text-sm bg-white border rounded-lg border-blue-gray-300">
                        <input wire:model="variantForm.availability" @click="availability_open = !availability_open" type="text" placeholder="Dostupnost" class="w-32 pr-3 text-black truncate"/>
                        <div class="absolute inset-0 w-full h-full bg-transparent"></div>
                        <span :class="{ 'transform rotate-180': availability_open }" class="absolute top-2 right-2 text-blue-gray-400">
                            <svg class="w-4 h-4 mt-0 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                    </div>
                    <div @click.away="availability_open = false" x-show="availability_open" class="transition duration-200 ease-in-out">
                        <div @click="availability_open = !availability_open" class="absolute left-0 z-30 flex flex-col text-sm bg-white shadow-md top-10 rounded-xl text-blue-gray-600 whitespace-nowrap">
                            <span wire:click="$set('variantForm.availability', 'Skladem')" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-t-xl">Skladem</span>
                            <span wire:click="$set('variantForm.availability', 'U dodavatele')" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">U dodavatele</span>
                            <span wire:click="$set('variantForm.availability', 'Nedostupne')" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">Nedostupne</span>
                            <span wire:click="$set('variantForm.availability', 'Vyprodáno')" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-b-xl">Vyprodáno</span>
                        </div>
                    </div>
                </div>
                <span class="px-2">/</span>
                <div class="relative flex-none inline-block">
                    <div @click="availabilityE_open = !availabilityE_open" class="flex w-full px-3 py-1 text-sm bg-white border rounded-lg border-blue-gray-300">
                        <input wire:model="variantForm.availabilityE" @click="availabilityE_open = !availabilityE_open" type="text" placeholder="Při vyprodání" class="w-32 pr-3 text-black truncate"/>
                        <div class="absolute inset-0 w-full h-full bg-transparent"></div>
                        <span :class="{ 'transform rotate-180': availabilityE_open }" class="absolute top-2 right-2 text-blue-gray-400">
                            <svg class="w-4 h-4 mt-0 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                    </div>
                    <div @click.away="availabilityE_open = false" x-show="availabilityE_open" class="transition duration-200 ease-in-out">
                        <div @click="availabilityE_open = !availabilityE_open" class="absolute left-0 z-30 flex flex-col text-sm bg-white shadow-md top-10 rounded-xl text-blue-gray-600 whitespace-nowrap">
                            <span wire:click="$set('variantForm.availabilityE', 'Skladem')" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-t-xl">Skladem</span>
                            <span wire:click="$set('variantForm.availabilityE', 'U dodavatele')" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">U dodavatele</span>
                            <span wire:click="$set('variantForm.availabilityE', 'Nedostupne')" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">Nedostupne</span>
                            <span wire:click="$set('variantForm.availabilityE', 'Vyprodáno')" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-b-xl">Vyprodáno</span>
                        </div>
                    </div>
                </div>
              </div>
            </td>
            @if(!$oneVariant)
            <td class="px-4 py-3 space-x-2 text-right">
                @if(isset($variantForm['key']))
                <button wire:click="updateVariants('{{ $variantForm['key'] }}')" type="button" class="px-4 py-2 text-sm font-semibold text-white bg-light-blue-500 hover:bg-light-blue-600 rounded-xl">
                    <span>Upravit</span>
                </button>
                @else
                <button wire:click="updateVariants('add')" type="button" class="px-4 py-2 text-sm font-semibold text-white bg-light-blue-500 hover:bg-light-blue-600 rounded-xl">
                    <span>Přidat</span>
                </button>
                @endif
            </td>
            @endif
        </tr>
    </table>
</div>