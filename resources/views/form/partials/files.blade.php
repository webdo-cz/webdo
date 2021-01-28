<div class="flex w-full px-4 py-2 mt-6 space-x-2 font-bold bg-blue-gray-200 text-blue-gray-600">
    Soubory
</div>
<div class="p-6 text-sm bg-white sm:p-4">
    <div class="flex flex-col">
        @foreach($this->state['files']['prev'] as $key => $file)
        <div class="justify-between py-2 sm:flex {{ $loop->first ? '' : 'border-t' }}">
            <div class="flex mb-2 sm:mb-0"">
                <span class="pb-1 truncate border-b border-transparent">{{ $file['name'] }}</span>
            </div>
            <div class="flex justify-center">
                <span class="pr-4"></span>
                <button wire:click="removeFrom({{ $key }}, 'prevFiles')" wire:loading.attr="disabled" class="relative right-0 flex items-center justify-center text-xs leading-none transition duration-200 ease-in-out rounded-full -top-6 sm:top-0 text-blue-gray-500 hover:text-blue-gray-800" type="button" name="button">
                    <svg class="w-5 h-5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        @endforeach
        @foreach($this->state['files']['new'] as $key => $file)
        <div class="justify-between py-2 border-t sm:flex">
            <div class="flex justify-center mb-2 sm:mb-0" x-data="{ editName: false, name }">
                <span x-show="!editName" class="pb-1 truncate border-b border-transparent">{{ $this->state['files']['info'][$key]['name'] }}</span>
                <input x-show="editName" x-model="name" class="w-32 pb-1 border-b outline-none xs:w-56 sm:w-64 md:w-80">
                <div class="flex flex-none cursor-pointer text-light-blue-500">
                    <svg x-show="!editName" @click="editName = !editName" class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path x-show="!editName" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    <svg x-show="editName" @click="$wire.updateFileName({{ $key }}, name); editName = !editName" class="w-5 h-5 ml-2 text-green-500"  fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <svg x-show="editName" @click="editName = !editName" class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <span class="pl-4">{{ $this->state['files']['info'][$key]['size'] }}</span>
            </div>
            <div class="flex justify-center">
                <span class="pr-4"></span>
                <button wire:click="removeFrom({{ $key }}, 'files')" wire:loading.attr="disabled" class="relative right-0 flex items-center justify-center text-xs leading-none transition duration-200 ease-in-out rounded-full -top-6 sm:top-0 text-blue-gray-500 hover:text-blue-gray-800" type="button" name="button">
                    <svg class="w-5 h-5 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        @endforeach
        <div class="flex justify-center mt-4">
            <label for="filesUpload" class="flex items-center px-6 py-3 font-bold text-center transition duration-200 ease-in-out rounded-lg cursor-pointer bg-blue-gray-300 text-blue-gray-500 hover:bg-blue-gray-200">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                </svg>
                Přidat soubor
            </label>
            <input id="filesUpload" type="file" wire:model="filesUpload" hidden>
        </div>
    </div>
  </div>