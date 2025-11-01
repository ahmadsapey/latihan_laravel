<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- BODY: Sidebar + Konten -->
            <div class="flex">
                <!-- Sidebar -->
                <aside class="w-64 bg-white border-r shadow-sm min-h-screen">
                    <nav class="p-4 space-y-1">
                        <a href="{{ route('dashboard') }}"
                           class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('dashboard') ? 'bg-gray-200 font-bold' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('mahasiswa.index') }}"
                           class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('mahasiswa.*') ? 'bg-gray-200 font-bold' : '' }}">
                            Mahasiswa
                        </a>
                        <a href="{{ route('ekyc.step1') }}"
                           class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('ekyc.*') ? 'bg-gray-200 font-bold' : '' }}">
                            Data Pribadi
                        </a>
                    </nav>
                </aside>
                <!-- Konten Utama -->
                <main class="flex-1 p-6">
                    {{ $slot ?? '' }}
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
