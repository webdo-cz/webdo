<div>
    @section('title')
        {{ __('web/contacts.title') }}
    @endsection
    <x-layout.page-title>
        <div></div>
        <div class="flex space-x-3">
            <a href="{{ url('eshop/product/create') }}" class="btn-primary">
                <span class="px-3 py-1">Vytvořit příspěvek</span>
            </a>
        </div>
    </x-layout.page-title>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-4 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 pl-6"></th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">
                                    Email - jméno
                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">
                                    Typ
                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-400 uppercase">
                                    Kampaň
                                </th>
                                <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-right text-gray-400 uppercase">
                                    Vytvoření / Poslední úprava
                                </th>
                                <th scope="col" class="py-3 pr-6"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($contacts as $key => $contact)
                                <tr>
                                    <td class="py-3 pl-6 whitespace-nowrap">
                                        {{ $contacts->firstItem()+$key }}
                                    </td>
                                    <td class="w-full px-4 py-3 whitespace-nowrap">
                                        <div>
                                            {{ $contact->email }}
                                        </div>
                                        <div class="text-gray-500">
                                            {{ $contact->name }}
                                        </div>
                                    </td>
                                    <td class="w-full px-4 py-3 whitespace-nowrap">
                                        {{ $contact->type }}
                                    </td>
                                    <td class="w-full px-4 py-3 whitespace-nowrap">
                                        {{ $contact->campaign }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-right text-gray-500 whitespace-nowrap">
                                        {{ date("H:i d.m.Y", strtotime($contact->created_at)) }} 
                                        <span class="text-gray-400">/</span> 
                                        {{ date("H:i d.m.Y", strtotime($contact->updated_at)) }}
                                    </td>
                                    <td class="py-3 pr-6 text-sm font-medium text-right whitespace-nowrap">
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
             </div>
        </div>
        <div class="flex items-center justify-center pt-4">
            {{ $contacts->links() }}
        </div>
    </div>
</div>