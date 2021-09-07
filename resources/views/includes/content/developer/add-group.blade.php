<div 
    x-data="{
        open: false,
        form: {},
        submit() {
            var response = $wire.createGroup(this.form);
            if(response == 'done') this.open = false;
        },
    }"
>
    @forelse($errors->all() as $key => $error)
        <div
            wire:key="error{{ date('His') . $key }}" 
            x-data="{ }" 
            x-init="
                $dispatch('flashadded', { 
                    title: 'Chyba ve formuláři',
                    message: '{{ $error }}',
                    type: 'error'
                })
            "
        ></div>
    @endforeach
    <button @click="open = true" type="button" class="w-full px-4 py-3 text-sm font-semibold text-white rounded-md cursor-pointer bg-light-blue-400">
        Přidat další skupinu
    </button>
    <x-modal 
        alpineVar="open" 
        title="Přidat další skupinu" 
        description="Přidat další skupinu do aktualně zobrazeného listu skupin."
    >
        <p class="mb-4 text-sm text-gray-500">
            Pro použití hodnoty z elementu použijte 
            <span class="px-2 py-1 font-mono text-xs text-gray-600 bg-gray-100 rounded-lg">#selektor</span> 
            a 
            <span class="px-2 py-1 font-mono text-xs text-gray-600 bg-gray-100 rounded-lg">!#selektor</span> 
            pro zobrazení s pořadovým číslem.
        </p>
        <div class="w-full mb-4 text-sm">
            <label for="addElement-label" class="pl-4 mb-1 text-sm font-medium text-gray-500">
                Label
            </label>
            <div class="relative">
                <input
                    id="addElement-label" 
                    name="label" 
                    type="text"
                    x-model="form.label"
                    placeholder="Zadejte label..." 
                    class="w-full px-4 py-2 bg-white border-2 rounded-lg placeholder form focus:outline-none border-blue-gray-400 border-opacity-20">
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <button @click="submit" type="button" class="flex items-center px-4 py-2 text-sm font-semibold text-white bg-light-blue-500 rounded-xl">
                <span class="px-3 py-1">Přidat</span>
            </button>
        </div>
    </x-modal>
</div>