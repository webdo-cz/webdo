<div class="max-w-lg pt-6 mx-auto">
    <div class="flex items-center justify-between w-full px-6 py-4 bg-gray-50">
        <h2 class="text-lg font-bold">GoPay</h2>
        <button wire:click="submit" class="btn-primary">Uložit</button>
    </div>
    <div class="w-full px-6 pt-4 pb-8 space-y-4 bg-white">
        <x-input wire:model.defer="form.gp_goid" name="gp_goid" label="Goid" placeholder=""/>
        <x-input wire:model.defer="form.gp_ClientID" name="ClientID" label="ClientID" placeholder=""/>
        <x-input wire:model.defer="form.gp_ClientSecret" name="ClientSecret" label="ClientSecret" placeholder=""/>
        <x-input wire:model.defer="form.gp_return_url" name="return_url" label="return_url" placeholder=""/>
        <x-input wire:model.defer="form.gp_test" name="test" label="Testovací režim" placeholder="true/false"/>
    </div>
</div>