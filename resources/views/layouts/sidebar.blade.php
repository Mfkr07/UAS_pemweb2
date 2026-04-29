@php
    $dashboardRoute   = auth()->user()->role === 'admin' ? route('admin.dashboard') : route('viewer.dashboard');
    $isDashboardActive = request()->routeIs('admin.dashboard') || request()->routeIs('viewer.dashboard');
@endphp

<!-- ============================================================ -->
<!-- Desktop Sidebar                                              -->
<!-- ============================================================ -->
<aside class="hidden md:flex flex-col w-64 h-screen bg-gray-900/95 backdrop-blur-xl border-r border-gray-800 shadow-2xl flex-shrink-0">

    <!-- App Logo -->
    <div class="flex items-center justify-center h-20 border-b border-gray-800 flex-shrink-0">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-indigo-600 text-white flex items-center justify-center rounded-xl font-bold text-xl shadow-lg shadow-indigo-500/30">
                SP
            </div>
            <span class="font-bold text-lg text-white tracking-wide">Sistem Desa</span>
        </div>
    </div>

    <!-- User Card -->
    <div class="flex items-center gap-3 px-4 py-4 border-b border-gray-800 flex-shrink-0">
        <div class="w-10 h-10 bg-indigo-500 text-white flex items-center justify-center rounded-full font-bold text-base flex-shrink-0 shadow-md shadow-indigo-500/30">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <div class="min-w-0">
            <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-400 capitalize">{{ Auth::user()->role }}</p>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex-1 overflow-y-auto py-4 px-4">
        <ul class="space-y-1">
            <li>
                <a href="{{ $dashboardRoute }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ $isDashboardActive ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="font-medium text-sm">Dashboard</span>
                </a>
            </li>

            @if(auth()->user()->role === 'admin')
                <li class="pt-4 pb-1">
                    <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Master Data</p>
                </li>
            @endif

            <li>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <span class="font-medium text-sm">Kategori</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.assets.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.assets.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="font-medium text-sm">Manajemen Aset</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.maintenance.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.maintenance.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="font-medium text-sm">Pemeliharaan</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Footer: Profile & Logout -->
    <div class="border-t border-gray-800 py-4 px-4 space-y-1 flex-shrink-0">
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('profile.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            <span class="font-medium text-sm">Profil Saya</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-gray-400 hover:bg-gray-800 hover:text-red-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="font-medium text-sm">Keluar</span>
            </button>
        </form>
    </div>
</aside>


<!-- ============================================================ -->
<!-- Mobile Sidebar & Overlay                                     -->
<!-- ============================================================ -->
<div class="md:hidden">
    <!-- Overlay -->
    <div x-show="sidebarOpen" class="fixed inset-0 bg-gray-900/80 z-40 backdrop-blur-sm" @click="sidebarOpen = false"
         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>

    <!-- Sidebar -->
    <aside x-show="sidebarOpen" class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900/95 backdrop-blur-xl shadow-2xl flex flex-col"
           x-transition:enter="ease-out duration-300" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
           x-transition:leave="ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">

        <!-- App Logo -->
        <div class="flex items-center justify-between h-20 border-b border-gray-800 px-4 flex-shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-600 text-white flex items-center justify-center rounded-xl font-bold text-xl shadow-lg shadow-indigo-500/30">SP</div>
                <span class="font-bold text-lg text-white tracking-wide">Sistem Desa</span>
            </div>
            <button @click="sidebarOpen = false" class="text-gray-400 hover:text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- User Card -->
        <div class="flex items-center gap-3 px-4 py-4 border-b border-gray-800 flex-shrink-0">
            <div class="w-10 h-10 bg-indigo-500 text-white flex items-center justify-center rounded-full font-bold text-base flex-shrink-0 shadow-md shadow-indigo-500/30">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-400 capitalize">{{ Auth::user()->role }}</p>
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto py-4 px-4">
            <ul class="space-y-1">
                <li>
                    <a href="{{ $dashboardRoute }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ $isDashboardActive ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span class="font-medium text-sm">Dashboard</span>
                    </a>
                </li>

                @if(auth()->user()->role === 'admin')
                    <li class="pt-4 pb-1">
                        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Master Data</p>
                    </li>
                @endif

                <li>
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span class="font-medium text-sm">Kategori</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.assets.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.assets.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        <span class="font-medium text-sm">Manajemen Aset</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.maintenance.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.maintenance.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="font-medium text-sm">Pemeliharaan</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Footer: Profile & Logout -->
        <div class="border-t border-gray-800 py-4 px-4 space-y-1 flex-shrink-0">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('profile.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span class="font-medium text-sm">Profil Saya</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 text-gray-400 hover:bg-gray-800 hover:text-red-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="font-medium text-sm">Keluar</span>
                </button>
            </form>
        </div>
    </aside>
</div>
