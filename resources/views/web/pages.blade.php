<div>
    <x-layout.page-title>
        <h1>{{ __('web/pages.title') }}</h1>
        <div class="flex space-x-3">
            <button class="btn-primary">
                {{ __('form.btn-add-record') }}
            </button>
        </div>
    </x-layout.page-title>
    <div class="mb-4 bg-white">
        @foreach($pages as $key => $page)
            <div class="flex {{ $loop->first ? '' : 'border-t' }}">
                <a href="{{ url('web/page/' . $page->slug) }}" class="flex flex-col justify-between flex-grow w-2/3 px-8 py-6 text-sm font-medium leading-5 transition duration-200 cursor-pointer md:items-center md:flex-row sm:px-6 hover:bg-light-blue-500 hover:text-white">
                    <div class="flex items-center">
                        <div class="truncate">
                            {{ $page->title }}<br>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
