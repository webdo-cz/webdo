<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('option.app_name', 'Webdo stránka') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet">
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/cs.js"></script>
        <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        @livewireScripts
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <livewire:flash-messages />
        @if(isset($fullscreen))
            {{ $slot }}
        @else
            <div class="min-h-screen md:flex md:flex-row">
                <aside class="flex-none w-full bg-white md:w-64 md:min-h-screen" x-data="{ open: false }">
                    <div class="fixed inset-x-0 top-0 z-50 flex items-center justify-between px-6 py-6 text-xl font-bold bg-white md:relative text-blue-gray-700">
                        <div>
                            {{ config('option.app_name', 'Webdo stránka') }}
                        </div>
                        <button class="md:hidden" type="button" @click="open = !open">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="fixed inset-0 z-40 pt-24 pb-6 mx-auto bg-black bg-opacity-50 md:relative md:py-0 md:bg-white" :class="{ 'hidden md:block': open == false }">
                        @include('layouts.partials.navbar')
                    </div>
                </aside>
                <main class="w-full">
                    <div class="flex items-center justify-between px-6 py-3 mt-20 md:px-12 md:bg-gray-50 md:mt-0">
                        <h1 class="py-2 text-xl font-bold text-blue-gray-900">
                            @yield('title')
                        </h1>
                        <div class="hidden md:block">
                            @include('layouts.partials.userpanel')
                        </div>
                    </div>
                    <div class="w-full max-w-5xl p-6 mx-auto">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        @endif




        {{-- <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts --}}
    </body>
</html>
