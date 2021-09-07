<div>
    @section('title')
        {{ __('web/articles.title') }}
    @endsection
    <x-layout.page-title>
        <div></div>
        <div class="flex space-x-3">
            <a href="{{ url('web/article/create') }}" class="btn-primary">
                <span class="px-3 py-1">Vytvořit příspěvek</span>
            </a>
        </div>
    </x-layout.page-title>
    <div class="space-y-2">
        @foreach($articles as $key => $article)
            <div class="flex flex-col justify-between flex-grow w-full px-4 py-4 text-sm font-medium leading-5 bg-white md:items-center md:flex-row sm:px-6">
                <div class="pl-2">
                    {{ $article->title }}
                </div>
                <div class="flex flex-col flex-shrink-0 sm:ml-2 sm:flex-row sm:items-center sm:space-x-4">
                    <a 
                        href="{{ url('web/article/edit/' . $article->id) }}"
                        class="px-5 py-2 mr-2 font-semibold text-gray-400 transition duration-200 border rounded-xl hover:text-gray-500"
                    >
                        <span>Upravit</span>
                        <svg class="inline-block w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>