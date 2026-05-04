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
    <body class="font-sans text-gray-100 antialiased bg-gray-900 h-screen overflow-hidden">
        <div class="flex h-screen w-full">
            <!-- Left Side: Visual / Branding (Matches Image Left) -->
            <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-indigo-500 to-indigo-800 overflow-hidden flex-col items-center justify-center">
                <!-- Decorative Circles -->
                <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
                <div class="absolute bottom-20 right-10 w-40 h-40 bg-white/10 rounded-full blur-xl"></div>
                <div class="absolute top-1/2 left-1/4 w-10 h-10 bg-white/20 rounded-full"></div>

                <!-- Content -->
                <div class="relative z-10 text-center px-12 flex flex-col items-center">
                    <!-- Logo -->
                    <div class="w-24 h-24 rounded-full bg-white/20 flex items-center justify-center mb-6 backdrop-blur-sm border border-white/30">
                        <div class="w-12 h-12 bg-white text-indigo-600 rounded-lg flex items-center justify-center font-bold text-2xl shadow-lg">
                            SP
                        </div>
                    </div>

                    <h1 class="text-4xl font-bold text-white tracking-tight mb-4">
                        Selamat Datang
                    </h1>
                    <p class="text-base text-indigo-100 max-w-sm mx-auto mb-10 leading-relaxed">
                        Kelola infrastruktur desa dengan efisien dan terpusat dalam satu platform cerdas.
                    </p>

                    <!-- Feature Cards -->
                    <div class="flex gap-4">
                        <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 w-28 h-28 flex flex-col items-center justify-center border border-white/20 transition hover:bg-white/30">
                            <svg class="w-6 h-6 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            <span class="text-xs font-semibold text-white text-center">Manajemen<br>Aset</span>
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 w-28 h-28 flex flex-col items-center justify-center border border-white/20 transition hover:bg-white/30">
                            <svg class="w-6 h-6 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                            <span class="text-xs font-semibold text-white text-center">Jadwal<br>Pemeliharaan</span>
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 w-28 h-28 flex flex-col items-center justify-center border border-white/20 transition hover:bg-white/30">
                            <svg class="w-6 h-6 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <span class="text-xs font-semibold text-white text-center">Keamanan<br>Data</span>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-6 text-indigo-200/50 text-xs font-medium">
                    Sistem Desa, v1.0
                </div>
            </div>

            <!-- Right Side: Form Content (Matches Image Right) -->
            <div class="w-full lg:w-1/2 flex flex-col items-center justify-center bg-[#0f1117] relative p-6">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
