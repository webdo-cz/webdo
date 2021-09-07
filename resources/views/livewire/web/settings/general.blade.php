<div class="max-w-lg pt-6 mx-auto">
    <div class="flex items-center justify-between w-full px-6 py-4 bg-gray-50">
        <h2 class="text-lg font-bold">Informace o webu</h2>
        <button wire:click="submit" class="btn-primary">Uložit</button>
    </div>
    <div class="w-full px-6 pt-4 pb-8 space-y-4 bg-white">
        <x-input wire:model.defer="form.app_name" name="app_name" label="Název administrace" placeholder="Webdo stránka"/>
        <x-input wire:model.defer="form.frontend_url" name="frontend_url" label="URL adresa frontendu" placeholder="https://webdostranka.cz"/>
    </div>
</div>