<div 
    x-data="{ 
        open: null,
        toggle(id) {
            if(this.open == id) {
                this.open = null;
            }else {
                this.open = id;
            }
        }
    }" 
    class="mb-4 space-y-3"
>
    @foreach($components as $key => $component)
        <div class="flex flex-col">
            <div class="flex flex-col justify-between flex-grow w-full px-4 py-4 text-sm font-medium leading-5 bg-white md:items-center md:flex-row sm:px-6">
                <div @click="toggle('{{ $component->id }}')" class="flex items-center py-2 pl-2 space-x-2 cursor-pointer group">
                    <div class="text-gray-500 truncate group-hover:text-light-blue-500">
                        {{ $component->title }}
                    </div>
                    <svg :class="{ 'rotate-180': open == '{{ $component->id }}' }" class="w-4 h-4 text-gray-400 transform group-hover:text-light-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div class="flex flex-col flex-shrink-0 sm:ml-2 sm:flex-row sm:items-center sm:space-x-4">
                    @if($component->contentVersions->where('type', 'main')->count() == 1)
                        <a 
                            href="{{ url('content/' . $component->id . '/' . $component->contentVersions->where('type', 'main')->pluck('id')->first()) }}"
                            class="px-5 py-2 mr-2 font-semibold text-gray-400 transition duration-200 border rounded-xl hover:text-gray-500"
                        >
                            <span>Upravit</span>
                            <svg class="inline-block w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
            @include('includes.pages.components.versions')
        </div>
    @endforeach
</div>