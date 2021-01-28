<div>
    <x-layout.page-title>
        <h1>{{ __('web/dashboard.title') }}</h1>
    </x-layout.page-title>
    
    <div class="flex space-x-4">
        @if(config('option.module_articles') == 'true') 
        <div class="flex w-1/4 p-4 bg-white">
            <div class="text-light-blue-200">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <div class="pl-4 text-sm">
                <p class="text-xl font-bold">Příspěvky</p>
                <p>{{ $posts }} příspěvků</p>
            </div>
        </div>
        @endif
        @if(config('option.module_pages') == 'true') 
        <div class="flex w-1/4 p-4 bg-white">
            <div class="text-yellow-200">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                </svg>
            </div>
            <div class="pl-4 text-sm">
                <p class="text-xl font-bold">Stránky</p>
                <p>{{ $pages }} stránek</p>
            </div>
        </div>
        @endif
        @if(config('option.module_events') == 'true') 
        <div class="flex w-1/4 p-4 bg-white">
            <div class="text-red-200">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div class="pl-4 text-sm">
                <p class="text-xl font-bold">Události</p>
                <p>{{ $events }} události</p>
            </div>
        </div>
        @endif
        <div class="flex w-1/4 p-4 bg-white rounded-lg shadow-sm">
            <div class="text-green-200">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
            </div>
            <div class="pl-4 text-sm">
                <p class="mb-1 text-base font-bold">Poslední úprava</p>
                <p>{{ date("H:i d.m.Y", strtotime($lastEdit)) }}</p>
            </div>
        </div>
    </div>
    
</div>
