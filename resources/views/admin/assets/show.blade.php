<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Aset') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('admin.assets.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition">Kembali</a>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.assets.edit', $asset->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-md shadow-indigo-500/30">
                        Edit Aset
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12 fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Asset Info -->
                <div class="md:col-span-1 space-y-6">
                    <div class="glass overflow-hidden rounded-2xl p-6">
                        @if($asset->photo_url)
                            <img src="{{ Storage::url($asset->photo_url) }}" alt="{{ $asset->name }}" class="w-full h-48 object-cover rounded-xl shadow-sm mb-6">
                        @else
                            <div class="w-full h-48 bg-gray-200 rounded-xl flex items-center justify-center text-gray-400 mb-6">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif

                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $asset->name }}</h3>
                        <p class="text-sm text-indigo-600 font-medium mb-4">{{ $asset->category->name }}</p>

                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Kondisi</p>
                                @php
                                    $badgeClass = match($asset->condition) {
                                        'baik' => 'bg-emerald-100 text-emerald-800 border border-emerald-200',
                                        'rusak_ringan' => 'bg-amber-100 text-amber-800 border border-amber-200',
                                        'rusak_berat' => 'bg-red-100 text-red-800 border border-red-200',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }} mt-1 inline-block">
                                    {{ ucfirst(str_replace('_', ' ', $asset->condition)) }}
                                </span>
                            </div>

                            @if($asset->location)
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Lokasi</p>
                                    <p class="text-sm text-gray-800 font-medium mt-1">{{ $asset->location }}</p>
                                </div>
                            @endif

                            @if($asset->acquisition_date)
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Tgl Perolehan</p>
                                    <p class="text-sm text-gray-800 font-medium mt-1">{{ \Carbon\Carbon::parse($asset->acquisition_date)->translatedFormat('d F Y') }}</p>
                                </div>
                            @endif

                            @if($asset->description)
                                <div class="pt-3 border-t border-gray-200/50">
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Deskripsi</p>
                                    <p class="text-sm text-gray-700 mt-1 leading-relaxed">{{ $asset->description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Maintenance Logs -->
                <div class="md:col-span-2">
                    <div class="glass overflow-hidden rounded-2xl p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-800">Riwayat Pemeliharaan</h3>
                            @if(auth()->user()->role === 'admin')
                                <a href="#" class="text-sm bg-indigo-50 hover:bg-indigo-100 text-indigo-700 px-3 py-1.5 rounded-lg font-medium transition">
                                    + Catat Pemeliharaan
                                </a>
                            @endif
                        </div>

                        <div class="space-y-4">
                            @forelse($asset->maintenanceLogs as $log)
                                <div class="bg-white/50 border border-gray-100 rounded-xl p-4 transition hover:bg-white/80">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($log->maintenance_date)->translatedFormat('d F Y') }}</p>
                                            <p class="text-sm text-gray-600 mt-1">{{ $log->description }}</p>
                                            <p class="text-xs font-semibold text-gray-800 mt-2 bg-gray-100 inline-block px-2 py-1 rounded">Biaya: Rp {{ number_format($log->cost, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            @php
                                                $statusClass = match($log->status) {
                                                    'planned' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                    'ongoing' => 'bg-amber-100 text-amber-800 border-amber-200',
                                                    'completed' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                                    default => 'bg-gray-100 text-gray-800'
                                                };
                                            @endphp
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $statusClass }}">
                                                {{ ucfirst($log->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    </div>
                                    <p class="text-gray-500 text-sm">Belum ada riwayat pemeliharaan.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
