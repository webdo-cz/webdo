<nav class="flex-none w-full bg-white sm:w-64 sm:min-h-screen sm:mr-6" x-data="{ open: false }">
    <div class="fixed flex flex-col justify-between w-full h-full sm:w-64">
        <div class="w-full sm:w-64">
            <div class="flex items-center justify-between px-6 py-6 text-xl font-bold sm:px-4 text-blue-gray-800">
                <p>{{ config('option.app_name', 'Webdo stránka') }}</p>
                <button class=" sm:hidden" @click="open = !open">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            <div class="" :class="{ 'hidden sm:block': open == false }">
                <x-layout.navbar/>
            </div>
        </div>
        <div class="fixed bottom-0 z-50 flex w-full px-6 py-4 border-t border-gray-200 sm:px-4 sm:relative" :class="{ 'hidden sm:block': open == false }">
            <x-layout.userpanel/>
        </div>
    </div>
</nav>