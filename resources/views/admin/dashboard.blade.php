<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Stat Card 1 -->
                <div class="glass p-6 rounded-2xl flex items-center justify-between transition-transform duration-300 hover:-translate-y-1">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Kategori</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalCategories }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="glass p-6 rounded-2xl flex items-center justify-between transition-transform duration-300 hover:-translate-y-1">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Aset</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalAssets }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="glass p-6 rounded-2xl flex items-center justify-between transition-transform duration-300 hover:-translate-y-1">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Log Pemeliharaan</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalMaintenance }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Charts & Content -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Condition Overview -->
                <div class="glass p-6 rounded-2xl">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Kondisi Aset</h3>
                    <div class="space-y-4">
                        @foreach($assetConditionStats as $stat)
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="font-medium text-gray-700">{{ ucfirst(str_replace('_', ' ', $stat->condition)) }}</span>
                                    <span class="text-gray-500">{{ $stat->total }} Aset</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    @php
                                        $color = match($stat->condition) {
                                            'baik' => 'bg-emerald-500',
                                            'rusak_ringan' => 'bg-amber-500',
                                            'rusak_berat' => 'bg-red-500',
                                            default => 'bg-indigo-500'
                                        };
                                        $percentage = $totalAssets > 0 ? ($stat->total / $totalAssets) * 100 : 0;
                                    @endphp
                                    <div class="{{ $color }} h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                        @endforeach
                        @if($assetConditionStats->isEmpty())
                            <p class="text-gray-500 text-sm">Belum ada data aset.</p>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="glass p-6 rounded-2xl">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Akses Cepat</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('admin.categories.index') }}" class="flex flex-col items-center justify-center p-4 bg-white/50 hover:bg-white rounded-xl transition shadow-sm border border-white/50">
                            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Kategori Baru</span>
                        </a>
                        <a href="{{ route('admin.assets.create') }}" class="flex flex-col items-center justify-center p-4 bg-white/50 hover:bg-white rounded-xl transition shadow-sm border border-white/50">
                            <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Aset Baru</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
