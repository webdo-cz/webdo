<div>
    <x-layout.page-title>
        <h1>Nastavení - <span class="text-light-blue-500">{{ $user->name }}</span></h1>
    </x-layout.page-title>
    <div>
        <div class="max-w-lg mx-auto">
            <h2 class="px-4 mb-2 text-lg font-bold">Změna hesla</h2>
            <div class="w-full p-4 space-y-4 bg-white">
                <x-input wire:model.defer="changePassword.old_password" name="old_password" label="Aktualní heslo" type="password"/>
                <x-input wire:model.defer="changePassword.password" name="password" label="Nové heslo" type="password"/>
                <x-input wire:model.defer="changePassword.password_confirmation" name="passowrd_confirmation" label="Nové heslo znovu" type="password"/>
                <button wire:click="changePassword" class="btn-primary">Změnit</button>
            </div>
        </div>
    </div>
</div>