<div x-show="tab == 'variants'">
    <div 
        x-data="{ 
            VAT_open: false, 
            availability_open: false, 
            availability: false, 
            availabilityE_open: false,
            oneVariant: @entangle('oneVariant').defer,
            formOneVariant: {{ json_encode($state['variant'] ?? []) }},
            form: {},
            open(id) {
                var form = $wire.get('state.variants.' + id);
                form = JSON.stringify(form);
                form = JSON.parse(form);
                this.form = form;
                this.form.key = id;
            },
            submit() {
                console.log(this.form);
                $wire.addVariant(this.form).then(result => { 
                    if(result == 'added') {
                        this.form.name = null;
                    }
                    if(result == 'edited') {
                        this.form = {};
                    }
                });
            }
        }"
    >
        <div class="px-4 py-2">
            <label class="flex items-center justify-start">
                <div class="flex items-center h-6 px-1 mr-2 bg-white border-2 border-gray-300 rounded-full outline-none w-11">
                    <input x-model="oneVariant" type="checkbox" class="absolute opacity-0 switch" />
                    <div class="w-4 h-4 transition duration-200 ease-in-out transform bg-gray-300 rounded-full"></div>
                </div>
                <div class="text-gray-500">Produkt má jednu variantu</div>
            </label>
        </div>
        <div>
            <div x-show="oneVariant" class="px-6 py-4 bg-white rounded-xl">
                <div class="grid grid-cols-8 gap-4 pt-4">
                    <div class="pt-1.5 col-span-4 text-right">Dostupnost:</div>
                    <div class="flex col-span-2">
                        <div class="relative">
                            <div @click="availability_open = !availability_open" class="flex w-full px-4 py-1 bg-white border rounded-md border-blue-gray-300">
                                <input x-model="formOneVariant.availability" disabled type="text" placeholder="Dostupnost" class="w-full pr-3 text-black truncate disabled:bg-white"/>
                                <div class="absolute inset-0 w-full h-full bg-transparent"></div>
                                <span :class="{ 'transform rotate-180': availability_open }" class="absolute top-2 right-2 text-blue-gray-400">
                                    <svg class="w-4 h-4 mt-0 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </div>
                            <div @click.away="availability_open = false" x-show="availability_open" class="transition duration-200 ease-in-out">
                                <div @click="availability_open = !availability_open" class="absolute left-0 z-30 flex flex-col text-sm bg-white shadow-md top-10 rounded-xl text-blue-gray-600 whitespace-nowrap">
                                    <span @click="formOneVariant.availability = 'Skladem'; @this.set('state.variant.availability', 'Skladem', true)" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-t-xl">Skladem</span>
                                    <span @click="formOneVariant.availability = 'U dodaVATele'; @this.set('state.variant.availability', 'U dodaVATele', true)" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">U dodaVATele</span>
                                    <span @click="formOneVariant.availability = 'Nedostupne'; @this.set('state.variant.availability', 'Nedostupne', true)" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">Nedostupne</span>
                                    <span @click="formOneVariant.availability = 'Vyprodáno'; @this.set('state.variant.availability', 'Vyprodáno', true)" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-b-xl">Vyprodáno</span>
                                </div>
                            </div>
                        </div>
                        <p class="pl-4 pt-1.5 text-gray-700">/</p>
                    </div>
                    <div class="col-span-2">
                        <div class="relative">
                            <div @click="availabilityE_open = !availabilityE_open" class="flex w-full px-4 py-1 bg-white border rounded-md border-blue-gray-300">
                                <input x-model="formOneVariant.availability_empty" disabled type="text" placeholder="Při vyprodání" class="w-full pr-3 text-black truncate disabled:bg-white"/>
                                <div class="absolute inset-0 w-full h-full bg-transparent"></div>
                                <span :class="{ 'transform rotate-180': availabilityE_open }" class="absolute top-2 right-2 text-blue-gray-400">
                                    <svg class="w-4 h-4 mt-0 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </div>
                            <div @click.away="availabilityE_open = false" x-show="availabilityE_open" class="transition duration-200 ease-in-out">
                                <div @click="availabilityE_open = !availabilityE_open" class="absolute left-0 z-30 flex flex-col text-sm bg-white shadow-md top-10 rounded-xl text-blue-gray-600 whitespace-nowrap">
                                    <span @click="formOneVariant.availability_empty = 'Skladem'; @this.set('state.variant.availability_empty', 'Skladem', true)" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-t-xl">Skladem</span>
                                    <span @click="formOneVariant.availability_empty = 'U dodaVATele'; @this.set('state.variant.availability_empty', 'U dodaVATele', true)" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">U dodaVATele</span>
                                    <span @click="formOneVariant.availability_empty = 'Nedostupne'; @this.set('state.variant.availability_empty', 'Nedostupne', true)" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">Nedostupne</span>
                                    <span @click="formOneVariant.availability_empty = 'Vyprodáno'; @this.set('state.variant.availability_empty', 'Vyprodáno', true)" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-b-xl">Vyprodáno</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-4 pt-4">
                    <div class="flex col-span-3">
                        <input x-model="formOneVariant.price" wire:model.defer="state.variant.price" type="text" class="w-full px-3 py-1 text-right border rounded-md form border-blue-gray-300" placeholder="Cena">
                        <p class="pl-2 pt-1.5 text-gray-700">Kč</p>
                    </div>
                    <div class="flex col-span-2">
                        <div class="relative">
                            <div @click="VAT_open = !VAT_open" class="flex w-full px-4 py-1 bg-white border rounded-md border-blue-gray-300">
                                <input x-model="formOneVariant.VAT" disabled type="text" placeholder="DPH" class="w-12 pr-3 text-black truncate disabled:bg-white"/>
                                <div class="absolute inset-0 w-full h-full bg-transparent"></div>
                                <span :class="{ 'transform rotate-180': VAT_open }" class="absolute top-2 right-2 text-blue-gray-400">
                                    <svg class="w-4 h-4 mt-0 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </div>
                            <div @click.away="VAT_open = false" x-show="VAT_open" class="transition duration-200 ease-in-out">
                                <div @click="VAT_open = !VAT_open" class="absolute left-0 z-30 flex flex-col text-sm bg-white shadow-md top-10 rounded-xl text-blue-gray-600 whitespace-nowrap">
                                    <span @click="formOneVariant.VAT = '0'; @this.set('state.variant.VAT', '0', true)" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-t-xl">0%</span>
                                    <span @click="formOneVariant.VAT = '10'; @this.set('state.variant.VAT', '10', true)" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">10%</span>
                                    <span @click="formOneVariant.VAT = '15'; @this.set('state.variant.VAT', '15', true)" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">15%</span>
                                    <span @click="formOneVariant.VAT = '21'; @this.set('state.variant.VAT', '21', true)" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-b-xl">21%</span>
                                </div>
                            </div>
                        </div>
                        <p class="pl-2 pt-1.5 text-gray-700">%</p>
                    </div>
                    <div class="flex col-span-3">
                        <input x-model="formOneVariant.buy_price" wire:model.defer="state.variant.buy_price" type="text" class="w-full px-3 py-1 text-right border rounded-md form border-blue-gray-300" placeholder="Nákupní cena">
                        <p class="pl-2 pt-1.5 text-gray-700">Kč</p>
                    </div>
                </div>
                <div class="flex items-center pt-4">
                    <div x-show="!isNaN((formOneVariant.price - formOneVariant.buy_price) - ((formOneVariant.price - formOneVariant.buy_price) * (formOneVariant.VAT/100)))" class="text-gray-700">
                        Cena bez DPH: <span x-text="formOneVariant.price - (formOneVariant.price * (formOneVariant.VAT/100)).toFixed(2)"></span> Kč,
                        Marže: <span x-text="(formOneVariant.price - formOneVariant.buy_price) - ((formOneVariant.price - formOneVariant.buy_price) * (formOneVariant.VAT/100)).toFixed(2)"></span> Kč,
                    </div>
                </div>
            </div>
            <div x-show="!oneVariant" class="px-6 py-4 bg-white rounded-xl">
                <div class="grid grid-cols-4 gap-4 pt-4">
                    <div class="flex items-center col-span-2 flex-nowrap">
                        <input x-model="form.name" type="text" class="w-full px-4 py-1 border rounded-md form border-blue-gray-300" placeholder="Název">
                    </div>
                    <div class="flex">
                        <div class="relative">
                            <div @click="availability_open = !availability_open" class="flex w-full px-4 py-1 bg-white border rounded-md border-blue-gray-300">
                                <input disabled x-model="form.availability" disabled type="text" placeholder="Dostupnost" class="w-full pr-3 text-black truncate disabled:bg-white"/>
                                <div class="absolute inset-0 w-full h-full bg-transparent"></div>
                                <span :class="{ 'transform rotate-180': availability_open }" class="absolute top-2 right-2 text-blue-gray-400">
                                    <svg class="w-4 h-4 mt-0 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </div>
                            <div @click.away="availability_open = false" x-show="availability_open" class="transition duration-200 ease-in-out">
                                <div @click="availability_open = !availability_open" class="absolute left-0 z-30 flex flex-col text-sm bg-white shadow-md top-10 rounded-xl text-blue-gray-600 whitespace-nowrap">
                                    <span @click="form.availability = 'Skladem'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-t-xl">Skladem</span>
                                    <span @click="form.availability = 'U dodaVATele'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">U dodaVATele</span>
                                    <span @click="form.availability = 'Nedostupne'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">Nedostupne</span>
                                    <span @click="form.availability = 'Vyprodáno'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-b-xl">Vyprodáno</span>
                                </div>
                            </div>
                        </div>
                        <p class="pl-4 pt-1.5 text-gray-700">/</p>
                    </div>
                    <div>
                        <div class="relative">
                            <div @click="availabilityE_open = !availabilityE_open" class="flex w-full px-4 py-1 bg-white border rounded-md border-blue-gray-300">
                                <input x-model="form.availability_empty" disabled type="text" placeholder="Při vyprodání" class="w-full pr-3 text-black truncate disabled:bg-white"/>
                                <div class="absolute inset-0 w-full h-full bg-transparent"></div>
                                <span :class="{ 'transform rotate-180': availabilityE_open }" class="absolute top-2 right-2 text-blue-gray-400">
                                    <svg class="w-4 h-4 mt-0 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </div>
                            <div @click.away="availabilityE_open = false" x-show="availabilityE_open" class="transition duration-200 ease-in-out">
                                <div @click="availabilityE_open = !availabilityE_open" class="absolute left-0 z-30 flex flex-col text-sm bg-white shadow-md top-10 rounded-xl text-blue-gray-600 whitespace-nowrap">
                                    <span @click="form.availability_empty = 'Skladem'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-t-xl">Skladem</span>
                                    <span @click="form.availability_empty = 'U dodaVATele'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">U dodaVATele</span>
                                    <span @click="form.availability_empty = 'Nedostupne'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">Nedostupne</span>
                                    <span @click="form.availability_empty = 'Vyprodáno'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-b-xl">Vyprodáno</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-4 pt-4">
                    <div class="flex col-span-3">
                        <input x-model="form.price" type="text" class="w-full px-3 py-1 text-right border rounded-md form border-blue-gray-300" placeholder="Cena">
                        <p class="pl-2 pt-1.5 text-gray-700">Kč</p>
                    </div>
                    <div class="flex col-span-2">
                        <div class="relative">
                            <div @click="VAT_open = !VAT_open" class="flex w-full px-4 py-1 bg-white border rounded-md border-blue-gray-300">
                                <input x-model="form.VAT" disabled type="text" placeholder="DPH" class="w-12 pr-3 text-black truncate disabled:bg-white"/>
                                <div class="absolute inset-0 w-full h-full bg-transparent"></div>
                                <span :class="{ 'transform rotate-180': VAT_open }" class="absolute top-2 right-2 text-blue-gray-400">
                                    <svg class="w-4 h-4 mt-0 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </div>
                            <div @click.away="VAT_open = false" x-show="VAT_open" class="transition duration-200 ease-in-out">
                                <div @click="VAT_open = !VAT_open" class="absolute left-0 z-30 flex flex-col text-sm bg-white shadow-md top-10 rounded-xl text-blue-gray-600 whitespace-nowrap">
                                    <span @click="form.VAT = '0'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-t-xl">0%</span>
                                    <span @click="form.VAT = '10'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">10%</span>
                                    <span @click="form.VAT = '15'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white">15%</span>
                                    <span @click="form.VAT = '21'" class="py-2 pl-5 pr-12 cursor-pointer hover:bg-light-blue-500 hover:text-white rounded-b-xl">21%</span>
                                </div>
                            </div>
                        </div>
                        <p class="pl-2 pt-1.5 text-gray-700">%</p>
                    </div>
                    <div class="flex col-span-3">
                        <input x-model="form.buy_price" type="text" class="w-full px-3 py-1 text-right border rounded-md form border-blue-gray-300" placeholder="Nákupní cena">
                        <p class="pl-2 pt-1.5 text-gray-700">Kč</p>
                    </div>
                    <div x-show="typeof form.key == 'undefined'" class="flex items-start justify-end col-span-4">
                        <button @click="submit" class="btn-primary">
                            <span class="px-2">Přidat</span>
                        </button>
                    </div>
                    <div x-show="typeof form.key !== 'undefined'" class="flex items-start justify-end col-span-4">
                        <button @click="form = {}" class="btn-transparent">
                            <span class="px-2">Zrušit</span>
                        </button>
                        <button @click="submit" class="btn-primary">
                            <span class="px-2">Upravit</span>
                        </button>
                    </div>
                </div>
                <div class="flex items-center pt-4">
                    <div x-show="!isNaN((form.price - form.buy_price) - ((form.price - form.buy_price) * (form.VAT/100)))" class="text-gray-700">
                        Cena bez DPH: <span x-text="form.price - (form.price * (form.VAT/100)).toFixed(2)"></span> Kč,
                        Marže: <span x-text="(form.price - form.buy_price) - ((form.price - form.buy_price) * (form.VAT/100)).toFixed(2)"></span> Kč,
                    </div>
                </div>
            </div>
            <div x-show="!oneVariant" class="mt-6 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-4 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase whitespace-nowrap">
                                        Název
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase whitespace-nowrap">
                                        Nakupní cena
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase whitespace-nowrap">
                                        Cena
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-right text-gray-400 uppercase whitespace-nowrap">
                                        Dostupnost / Při vyprodání
                                    </th>
                                    <th scope="col" class="px-4 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach($state['variants'] as $key => $variant)   
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            {{ $variant['name'] }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            {{ $variant['buy_price'] }} Kč
                                        </td>
                                        <td class="w-full px-4 py-3 whitespace-nowrap">
                                            {{ $variant['price'] }} ({{ $variant['VAT'] }}% DPH)
                                        </td>
                                        <td class="px-4 py-3 text-right whitespace-nowrap">
                                            {{ $variant['availability'] }} / {{ $variant['availability_empty'] }}
                                        </td>
                                        <td class="px-4 py-3 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex justify-end space-x-2">
                                                <button @click="open({{ $key }})" type="button" class="text-light-blue-400 hover:text-light-blue-500">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="text-red-400 hover:text-red-500">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @empty($state['variants'])
                            <div class="w-full py-3 text-sm text-center text-gray-500 bg-white">
                                Není vytvořená žádná varianta
                            </div>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>