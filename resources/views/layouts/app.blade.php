<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Webdo</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/cs.js"></script>
        <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 sm:flex sm:flex-row">
            @if(!isset($hideSidebar))
                <x-layout.sidebar/>
            @endif

            <main class="w-full">
                {{-- <div class="flex items-center justify-between w-full max-w-5xl px-6 mx-auto my-10 sm:py-6">
                    
                </div> --}}
                <div class="w-full max-w-5xl p-6 mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <livewire:flash-messages />

        <!-- Scripts -->
        @livewireScripts
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>