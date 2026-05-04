<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pemeliharaan') }}
        </h2>
    </x-slot>

    <div class="py-8 fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl relative shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Actions Bar (Buttons Only) -->
            <div class="mb-6 flex flex-wrap justify-start gap-3">
                <a href="{{ route('admin.maintenance.export_excel', request()->query()) }}" class="flex items-center gap-2 px-4 py-2 rounded-lg border border-emerald-500 text-emerald-600 bg-emerald-50/50 hover:bg-emerald-50 font-semibold text-xs tracking-wider uppercase transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export Excel
                </a>
                <a href="{{ route('admin.maintenance.export_pdf', request()->query()) }}" target="_blank" class="flex items-center gap-2 px-4 py-2 rounded-lg border border-red-500 text-red-600 bg-red-50/50 hover:bg-red-50 font-semibold text-xs tracking-wider uppercase transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export PDF
                </a>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.maintenance.create') }}" class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-semibold text-xs tracking-wider uppercase transition shadow-md shadow-indigo-500/30">
                        + Catat Baru
                    </a>
                @endif
            </div>

            <!-- Filter Bar (Matches Image Layout: Vertically Stacked with Generous Padding) -->
            <div class="mb-8 glass p-6 sm:p-8 rounded-2xl border border-gray-200/50 shadow-sm">
                <form action="{{ route('admin.maintenance.index') }}" method="GET" class="flex flex-col gap-6">
                    
                    <!-- Date Range Filter -->
                    <div class="w-full">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Rentang Tanggal</label>
                        <div class="flex items-center gap-3">
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="flex-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm bg-white/70 text-sm py-2.5">
                            <span class="text-gray-400 font-medium flex-shrink-0">-</span>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="flex-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm bg-white/70 text-sm py-2.5">
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="w-full">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kategori Aset</label>
                        <select name="category_id" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm bg-white/70 text-sm py-2.5">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div class="w-full">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Status</label>
                        <select name="status" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm bg-white/70 text-sm py-2.5">
                            <option value="">Semua Status</option>
                            <option value="planned" {{ request('status') == 'planned' ? 'selected' : '' }}>Planned</option>
                            <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="w-full mt-2">
                        <button type="submit" class="w-full bg-indigo-100 hover:bg-indigo-200 text-indigo-700 px-6 py-3 rounded-xl text-xs font-bold tracking-wider uppercase transition shadow-sm border border-indigo-200 text-center">
                            Terapkan Filter
                        </button>
                        @if(request()->anyFilled(['start_date', 'end_date', 'category_id', 'status']))
                            <div class="mt-3 text-center">
                                <a href="{{ route('admin.maintenance.index') }}" class="text-xs font-medium text-red-500 hover:text-red-700 underline uppercase tracking-wider">Reset Filter</a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Table Section (Matches Image Layout with floating rows) -->
            <div class="w-full">
                <div class="hidden md:grid grid-cols-12 gap-4 px-6 pb-3 border-b border-gray-300/50 text-xs font-bold text-gray-500 uppercase tracking-wider">
                    <div class="col-span-1">ID Log</div>
                    <div class="col-span-3">Aset & Kategori</div>
                    <div class="col-span-3">Biaya & Deskripsi</div>
                    <div class="col-span-3">Tanggal</div>
                    <div class="col-span-2 text-right">Status / Aksi</div>
                </div>

                <div class="flex flex-col gap-2 mt-3">
                    @forelse($logs as $log)
                        <div class="glass px-6 py-4 rounded-xl flex flex-col md:grid md:grid-cols-12 gap-4 items-center hover:bg-white/80 transition duration-200 border border-white/40 shadow-sm">
                            
                            <!-- ID -->
                            <div class="col-span-1 text-sm font-semibold text-gray-600 w-full md:w-auto">
                                #MN-{{ str_pad($log->id, 4, '0', STR_PAD_LEFT) }}
                            </div>

                            <!-- Asset & Category (Like Avatar + Name in image) -->
                            <div class="col-span-3 flex items-center gap-3 w-full md:w-auto">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-sm flex-shrink-0">
                                    {{ strtoupper(substr($log->asset->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-bold text-gray-900 truncate"><a href="{{ route('admin.assets.show', $log->asset_id) }}" class="hover:underline">{{ $log->asset->name }}</a></p>
                                    <p class="text-xs text-gray-500">{{ $log->asset->category->name ?? 'Tanpa Kategori' }}</p>
                                </div>
                            </div>

                            <!-- Cost & Description (Like Rig/PC and Tarif in image) -->
                            <div class="col-span-3 w-full md:w-auto">
                                <p class="text-sm font-bold text-emerald-600">Rp {{ number_format($log->cost, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500 truncate" title="{{ $log->description }}">{{ Str::limit($log->description, 40) }}</p>
                            </div>

                            <!-- Date (Like Waktu in image) -->
                            <div class="col-span-3 w-full md:w-auto">
                                <p class="text-sm font-medium text-gray-800">{{ \Carbon\Carbon::parse($log->maintenance_date)->translatedFormat('d M Y') }}</p>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($log->maintenance_date)->diffForHumans() }}</p>
                            </div>

                            <!-- Status & Actions (Like Aksi badge in image) -->
                            <div class="col-span-2 flex items-center justify-start md:justify-end gap-3 w-full md:w-auto">
                                @php
                                    $statusClass = match($log->status) {
                                        'planned' => 'border-blue-500 text-blue-700 bg-blue-50',
                                        'ongoing' => 'border-amber-500 text-amber-700 bg-amber-50',
                                        'completed' => 'border-emerald-500 text-emerald-700 bg-emerald-50',
                                        default => 'border-gray-500 text-gray-700 bg-gray-50'
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-md text-[10px] font-bold border uppercase tracking-wider {{ $statusClass }}">
                                    {{ $log->status }}
                                </span>

                                @if(auth()->user()->role === 'admin')
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.maintenance.edit', $log->id) }}" class="p-1.5 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.maintenance.destroy', $log->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus log pemeliharaan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="glass p-8 text-center rounded-xl border border-gray-200/50">
                            <p class="text-sm text-gray-500">Data riwayat pemeliharaan tidak ditemukan.</p>
                        </div>
                    @endforelse
                </div>

                @if($logs->hasPages())
                    <div class="mt-6">
                        {{ $logs->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
