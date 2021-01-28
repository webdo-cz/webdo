<div class="flex-shrink-0 block w-full group">
    <div class="flex items-center">
        <span class="inline-flex items-center justify-center w-12 h-12 rounded-full sm:h-9 sm:w-9 bg-light-blue-300">
            <span class="text-xl font-medium leading-none text-white sm:text-base">OŠ</span>
        </span>
        <div class="ml-3">
            <p class="text-sm font-medium leading-5 text-gray-700 group-hover:text-gray-900">
                Ondřej Štěpán
            </p>
            <form method="POST" action="{{ url('logout') }}" class="flex text-xs leading-4 text-gray-500 transition duration-150 ease-in-out">
                @csrf
                <a href="#" class="pr-2 font-medium hover:text-gray-700">{{ __('layout.userpanel.settings') }}</a>
                <button class="font-medium hover:text-gray-700" onclick="event.preventDefault();this.closest('form').submit();">{{ __('layout.userpanel.logout') }}</button>
            </form>
        </div>
    </div>
</div>