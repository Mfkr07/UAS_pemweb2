<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pemeliharaan') }}
        </h2>
    </x-slot>

    <div class="py-12 fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Filter & Action Bar -->
            <div class="mb-6 glass p-4 rounded-xl flex items-center justify-between">
                <form action="{{ route('admin.maintenance.index') }}" method="GET" class="flex items-center gap-4">
                    <select name="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm text-sm" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="planned" {{ request('status') == 'planned' ? 'selected' : '' }}>Planned</option>
                        <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </form>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.maintenance.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-md shadow-indigo-500/30">
                        + Catat Pemeliharaan
                    </a>
                @endif
            </div>

            <div class="glass overflow-hidden sm:rounded-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200/50 bg-gray-50/50">
                                <th class="p-4 text-sm font-medium text-gray-500">Tanggal</th>
                                <th class="p-4 text-sm font-medium text-gray-500">Aset</th>
                                <th class="p-4 text-sm font-medium text-gray-500">Deskripsi</th>
                                <th class="p-4 text-sm font-medium text-gray-500">Biaya</th>
                                <th class="p-4 text-sm font-medium text-gray-500">Status</th>
                                <th class="p-4 text-sm font-medium text-gray-500 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200/50 bg-white/30">
                            @forelse($logs as $log)
                                <tr class="hover:bg-white/50 transition duration-150">
                                    <td class="p-4 text-sm text-gray-800 font-medium">{{ \Carbon\Carbon::parse($log->maintenance_date)->translatedFormat('d F Y') }}</td>
                                    <td class="p-4 text-sm text-indigo-600 font-medium">
                                        <a href="{{ route('admin.assets.show', $log->asset_id) }}" class="hover:underline">
                                            {{ $log->asset->name }}
                                        </a>
                                    </td>
                                    <td class="p-4 text-sm text-gray-600">{{ Str::limit($log->description, 50) }}</td>
                                    <td class="p-4 text-sm text-gray-800 font-medium">Rp {{ number_format($log->cost, 0, ',', '.') }}</td>
                                    <td class="p-4 text-sm">
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
                                    </td>
                                    <td class="p-4 text-sm text-right space-x-2">
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('admin.maintenance.edit', $log->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium transition">Edit</a>
                                            <form action="{{ route('admin.maintenance.destroy', $log->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus log pemeliharaan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium transition">Hapus</button>
                                            </form>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-4 text-center text-sm text-gray-500">Data riwayat pemeliharaan tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($logs->hasPages())
                    <div class="p-4 border-t border-gray-200/50">
                        {{ $logs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
