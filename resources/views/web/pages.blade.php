<x-layout.page-title>
    <h1>{{ __('web/pages.title') }}</h1>
    <div class="flex space-x-3">
        <a href="{{ url('web/pages/add-record') }}" class="btn-primary">
            {{ __('form.btn-add-record') }}
        </a>
    </div>
</x-layout.page-title>