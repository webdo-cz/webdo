<div class="mt-4">
    @section('title')
        {{ __('web/pages.title') }}
    @endsection
    <x-layout.page-title>
        <div>Stránky</div>
        <div class="flex space-x-3">
            <button wire:click="$set('create.type', 'page')" class="btn-primary">
                <span class="px-3 py-1">Vytvořit stránku</span>
            </button>
        </div>
    </x-layout.page-title>
    <div class="mb-12">
        <div>
            @if($page)
                @include('includes.pages.seo')
            @endif
        </div>
        @include('includes.pages.list')
    </div>
    <x-layout.page-title>
        <div>Komponenty</div>
        <div class="flex space-x-3">
            <button wire:click="$set('create.type', 'component')" type="button" class="btn-primary">
                <span class="px-3 py-1">Vytvořit komponentu</span>
            </button>
        </div>
    </x-layout.page-title>
    <div class="mb-12">
        @include('includes.pages.components.list')
    </div>
    <div>
        @include('includes.pages.create')
    </div>
</div>
