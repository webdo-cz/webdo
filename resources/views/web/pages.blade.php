<div>
    @section('title')
        {{ __('web/pages.title') }}
    @endsection
    <x-layout.page-title>
        <div></div>
        <div class="flex space-x-3">
            <button class="btn-primary">
                Vytvořit stránku
            </button>
        </div>
    </x-layout.page-title>
    <div class="space-y-3">
        @foreach($pages as $key => $page)
            <div wire:key="{{ $page->id }}" class="flex">
                <div class="flex flex-col justify-between flex-grow w-2/3 px-4 py-4 text-sm font-medium leading-5 bg-white md:items-center md:flex-row sm:px-6">
                    <div class="flex items-center pl-2">
                        <div class="text-gray-800 truncate">
                            {{ $page->title }}
                        </div>
                    </div>
                    <div class="flex flex-col flex-shrink-0 sm:ml-2 sm:flex-row sm:items-center sm:space-x-4">
                        <a href="{{ url('web/page/' . $page->slug) }}" class="transition duration-200 bg-blue-gray-100 text-blue-gray-500 hover:text-light-blue-500 btn">
                            Upravit
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
