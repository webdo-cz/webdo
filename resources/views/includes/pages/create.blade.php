@if(isset($create['type']))
    <x-modal 
        wire="create" 
        title="Vytvořit {{ $create['type'] == 'page' ? 'stránku' : 'komponentu' }}"
        description="Vytvořením nové {{ $create['type'] == 'page' ? 'stránky' : 'komponenty' }} vytvoříte i novou verzi s názvem Hlavní verze (main)."
    >
        <div class="space-y-4">
            <x-input wire:model.defer="create.title" name="title" label="Název"/>
            <x-input wire:model.defer="create.slug" name="slug" label="Slug"/>
            <button wire:click="create" class="mt-2 btn-primary">
                <span class="px-3 py-1">Vytvořit</span>
                <x-loading-spin size="6" target="create" />
            </button>
        </div>
    </x-modal>
@endif