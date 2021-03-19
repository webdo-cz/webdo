<div>
    @section('title')
        {{ __('eshop/settings.title') }}
    @endsection
    <div class="w-full">
        <nav class="flex flex-col py-3 pl-5 pr-6 mx-auto mb-6 space-x-3 text-sm font-medium leading-5 bg-white w-max lg:flex-row text-blue-gray-500">
            <x-layout.subnav-item url="eshop/settings/general">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span>Obecné nastavení</span>
            </x-layout.subnav-item>
            <x-layout.subnav-item url="eshop/settings/marketing">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 5c7.18 0 13 5.82 13 13M6 11a7 7 0 017 7m-6 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                </svg>
                <span>Marketing</span>
            </x-layout.subnav-item>
        </nav>
        @livewire('eshop.settings.' . $page)
    </div>
</div>
