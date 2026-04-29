<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-transparent transition-colors duration-300">
        <div class="flex h-screen overflow-hidden bg-gray-100 dark:bg-gray-900" x-data="{ sidebarOpen: false }">
            
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-transparent">
                <!-- Mobile Header -->
                <div class="md:hidden glass sticky top-0 z-30 flex items-center justify-between p-4 border-b border-gray-200">
                    <div class="w-8 h-8 bg-indigo-600 text-white flex items-center justify-center rounded-lg font-bold text-sm shadow-md">
                        SP
                    </div>
                    <button @click="sidebarOpen = true" class="text-gray-600 hover:text-gray-900 focus:outline-none p-2 rounded-lg hover:bg-gray-100/50 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>

                <!-- Page Heading -->
                @isset($header)
                    <header class="glass mx-4 mt-6 sm:mx-6 lg:mx-8 rounded-xl fade-in px-6 py-4">
                        {{ $header }}
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-transparent">
                    {{ $slot }}
                </main>
            </div>

        </div>
    </body>
</html>
