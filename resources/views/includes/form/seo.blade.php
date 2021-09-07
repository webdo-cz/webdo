<div x-show="tab == 'seo'">
    <div class="space-y-4">
        <p class="text-sm text-gray-600">
            Pokud není nadpis stránky vyplněn je použit nadpis příspěvku.
        </p>
        <x-input wire:model.defer="state.page_title.{{ $lang }}" name="page_title" label="Nadpis stránky" placeholder=""/>
        <x-input wire:model.defer="state.meta_title.{{ $lang }}" name="meta_title" label="Meta nadpis (og:title, twitter:title)" placeholder=""/>
        <x-textarea wire:model.defer="state.meta_description.{{ $lang }}" name="meta_description" label="Meta popis (og:description, twitter:description)" placeholder=""/>
        <x-textarea wire:model.defer="state.meta_keywords.{{ $lang }}" name="meta_keywords" label="Meta klíčové slova (slova oddělte čárkou)" placeholder=""/>
    </div>
</div>
<style>
    .filepond--drop-label, .filepond--panel-root {
        background-color: white !important;
    }
</style>