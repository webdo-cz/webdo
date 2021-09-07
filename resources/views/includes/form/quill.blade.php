<div 
    x-data="{
        show: false,
        value: null,
        open() {
            this.value = document.querySelector('#quill > div').innerHTML;
            this.show = true;
        },
        submit() {
            document.querySelector('#quill > div').innerHTML = this.value;
            this.show = false;
        }
    }" 
    class="relative"
>
    @include('includes.form.html-editor')
    <div wire:ignore>
        <div id="quill">{!! $state['body'][$lang] ?? null !!}</div>
    </div>
</div>