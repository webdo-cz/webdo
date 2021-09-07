<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Webdo</title>

        <!-- Styles -->
        <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <livewire:flash-messages />
        {{ $slot }}
    </body>
</html>
