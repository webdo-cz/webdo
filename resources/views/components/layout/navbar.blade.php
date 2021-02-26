<div
    x-data="{
        menuSection: '{{ explode('/',$_SERVER['REQUEST_URI'])[1] ?? 'web' }}',
        urlSection: '{{ explode('/',$_SERVER['REQUEST_URI'])[1] ?? 'web' }}',
        urlParent: '{{ explode('/',$_SERVER['REQUEST_URI'])[2] ?? '' }}',
        urlChild: '{{ explode('/',$_SERVER['REQUEST_URI'])[3] ?? '' }}',
    }"
    class="fixed inset-x-0 bottom-0 z-50 bg-white sm:z-0 sm:relative top-20 sm:top-0"
">
    @if(config('option.module_eshop') == 'true')
    <div class="flex justify-center mt-6 mb-4 sm:mt-0">
        <div class="flex text-xs font-bold bg-white border-2 text-blue-gray-400 border-light-blue-100 rounded-xl">
            <span
                @click="menuSection = 'web'"
                class="flex items-center w-full px-4 py-2 -ml-px cursor-pointer rounded-l-xl"
                :class="{ 'bg-light-blue-100 text-light-blue-500': menuSection == 'web', 'hover:text-blue-gray-700': menuSection != 'web' }"
            >
                WEB
            </span>
            <span
                @click="menuSection = 'eshop'"
                class="flex items-center w-full px-4 py-2 -mr-px cursor-pointer rounded-r-xl"
                :class="{ 'bg-light-blue-100 text-light-blue-500': menuSection == 'eshop', 'hover:text-blue-gray-700': menuSection != 'eshop' }"
            >
                ESHOP
            </span>
        </div>
    </div>
    <div class="flex-col text-sm font-medium sm:flex text-blue-gray-500" x-show="menuSection == 'eshop'" style="display:none">
        <x-layout.nav-item url="eshop/dashboard">
            <svg class="w-6 mr-2 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            {{ __('layout.navbar.eshop-dashboard') }}
        </x-layout.nav-item>
        <x-layout.nav-item url="eshop/orders">
            <svg class="w-6 mr-2 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            {{ __('layout.navbar.eshop-orders') }}
        </x-layout.nav-item>
        <x-layout.nav-item url="eshop/products">
            <svg class="w-6 mr-2 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
            </svg>
            {{ __('layout.navbar.eshop-products') }}
        </x-layout.nav-item>
        <x-layout.nav-item url="eshop/carts">
            <svg class="w-6 mr-2 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            {{ __('layout.navbar.eshop-carts') }}
        </x-layout.nav-item>
        <x-layout.nav-item url="eshop/settings/general">
            <svg class="w-6 mr-2 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            {{ __('layout.navbar.eshop-settings') }}
        </x-layout.nav-item>
    </div>
    @endif

    <div class="flex-col text-sm font-medium sm:flex text-blue-gray-500" x-show="menuSection == 'web'" style="display:none">
        <x-layout.nav-item url="web/dashboard">
            <svg class="w-6 mr-2 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            {{ __('layout.navbar.web-dashboard') }}
        </x-layout.nav-item>
        @if(config('option.module_articles') == 'true')
        <x-layout.nav-item url="web/articles">
            <svg class="w-6 mr-2 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            {{ __('layout.navbar.web-articles') }}
        </x-layout.nav-item>
        @endif
        @if(config('option.module_pages') == 'true')
        <x-layout.nav-item url="web/pages">
            <svg class="w-6 mr-2 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
            </svg>
            {{ __('layout.navbar.web-pages') }}
        </x-layout.nav-item>
        @endif
        @if(config('option.module_events') == 'true')
        <x-layout.nav-item url="web/events">
            <svg class="w-6 mr-2 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            {{ __('layout.navbar.web-events') }}
        </x-layout.nav-item>
        @endif
        <x-layout.nav-item url="web/users">
            <svg class="w-6 mr-2 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            {{ __('layout.navbar.web-users') }}
        </x-layout.nav-item>
        <x-layout.nav-item url="web/settings/general">
            <svg class="w-6 mr-2 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            {{ __('layout.navbar.web-settings') }}
        </x-layout.nav-item>
    </div>
</div>
