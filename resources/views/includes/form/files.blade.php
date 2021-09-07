<div x-show="tab == 'files'" class="space-y-2">
    @foreach($state['files'] as $key => $file)
        @if(!($file['delete'] ?? false))
            <div class="flex items-center justify-between px-4 py-3 text-sm text-white bg-gray-800 rounded-md">
                <div class="flex items-center h-8 space-x-2">
                    {{ $file['path'] }}
                </div>
                <div class="flex items-center space-x-4">
                    <button wire:click="$set('state.files.{{ $key }}.delete', true)" type="button" class="font-medium text-red-500 hover:text-red-700">
                        Smazat
                    </button>
                </div>
            </div>
        @endif
    @endforeach
    @foreach($upload['files'] as $key => $file)
        @if($file)
            <div
                x-data="{
                    edit: false,
                    name: null,
                    setName() {
                        $wire.set('upload.files.{{ $key }}.customName', this.name);
                        this.edit = false;
                    }
                }"
                class="flex items-center justify-between px-4 py-3 text-sm text-white bg-gray-800 rounded-md"
            >
                <div class="flex items-center h-8 space-x-2">
                    <div x-show="!edit">
                        @if($file->customName ?? false)
                            {{ $file->customName . '.' . $file->getClientOriginalExtension() }}
                        @else
                            {{ $file->getClientOriginalName() }}
                        @endif
                    </div>
                    <div x-show="edit">
                        <input x-model="name" type="text" class="px-2 py-1 bg-gray-700">
                    </div>
                    <svg x-show="!edit" @click="edit = true" class="flex-none w-4 h-4 cursor-pointer text-light-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    <svg x-show="edit" @click="setName" class="flex-none w-5 h-5 cursor-pointer text-light-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <svg x-show="edit" @click="edit = false, name = null" class="flex-none w-5 h-5 cursor-pointer text-light-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <div class="flex items-center space-x-4">
                    <div>{{ $file->getSize() }} B</div>
                    <button wire:click="$set('upload.files.{{ $key }}', null)" type="button" class="font-medium text-red-500 hover:text-red-700">
                        Smazat
                    </button>
                </div>
            </div>
        @endif
    @endforeach
</div>