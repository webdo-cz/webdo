<div class="min-h-screen font-sans antialiased bg-gray-100">
    @include('components.layout.loading')
    <div class="absolute inset-0 h-screen overflow-auto">
        <iframe src="{{ config('option.frontend_url') }}" class="w-full h-full p-0 m-0 overflow-hidden bg-white border-0" scrolling="yes">
            Your browser doesn't support iframes
        </iframe>
    </div>
    
    <form 
        wire:submit.prevent="submit" 
        class="fixed top-0 left-0 z-50 h-full px-4 py-6 overflow-auto bg-white border-r w-80"
    >
        
        @include('web.content.header')

        @php
            if ($group) {
                $prefix = 'groups.' . $group . '.' . $groupName . '.';
            }else {
                $prefix = 'base.';
            }
        @endphp
        <script>
            function closeModal(name, prefix, source) {
                var value = null;
                if(source == 'html') {
                    value = document.querySelector("#html-" + name).value;
                }
                if(source == 'markdown') {
                    value = document.querySelector("#editor-" + name + " > div").innerHTML;
                }
                @this.set('form.' + name + '.value', value, true);
                @this.set(prefix + name + '.value', value, true);
                @this.set(prefix + name + '.edited', true);
            }
            function setHTML(name) {
                document.querySelector("#html-" + name).value = document.querySelector("#editor-" + name + " > div").innerHTML;
            }
            function setEditor(name) {
                document.querySelector("#editor-" + name + " > div").innerHTML = document.querySelector("#html-" + name).value;
            }
            var toolbarOptions = [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons

                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                [{ 'align': [] }],
            ];
        </script>
        @foreach($form as $key => $item)
            @switch($item['type'])
                @case('html')
                    @include('web.content._html')
                    @break
                @case('richtext')
                    @include('web.content._richtext')
                    @break
                @case('textarea')
                    @include('web.content._textarea')
                    @break
                @case('image')
                    @include('web.content._image')
                    @break
                @case('group')
                    @include('web.content._group')
                    @break
                @default
                    @include('web.content._text')
            @endswitch
        @endforeach
    </form>
</div>
  