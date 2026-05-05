<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Aset') }}
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
                <form action="{{ route('admin.assets.index') }}" method="GET" class="flex items-center gap-4">
                    <select name="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm text-sm" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </form>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.assets.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-md shadow-indigo-500/30">
                        + Aset Baru
                    </a>
                @endif
            </div>

            <div class="glass overflow-hidden sm:rounded-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200/50 bg-gray-50/50">
                                <th class="p-4 text-sm font-medium text-gray-500">Foto</th>
                                <th class="p-4 text-sm font-medium text-gray-500">Nama Aset</th>
                                <th class="p-4 text-sm font-medium text-gray-500">Kategori</th>
                                <th class="p-4 text-sm font-medium text-gray-500">Kondisi</th>
                                <th class="p-4 text-sm font-medium text-gray-500 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200/50 bg-white/30">
                            @forelse($assets as $asset)
                                <tr class="hover:bg-white/50 transition duration-150">
                                    <td class="p-4">
                                        @if($asset->photo_url)
                                            @if(Str::startsWith($asset->photo_url, 'data:image'))
                                                <img src="{{ $asset->photo_url }}" alt="{{ $asset->name }}" class="w-12 h-12 rounded-lg object-cover shadow-sm">
                                            @else
                                                <img src="{{ Storage::url($asset->photo_url) }}" alt="{{ $asset->name }}" class="w-12 h-12 rounded-lg object-cover shadow-sm">
                                            @endif
                                        @else
                                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-4 text-sm font-medium text-gray-800">{{ $asset->name }}</td>
                                    <td class="p-4 text-sm text-gray-600">{{ $asset->category->name }}</td>
                                    <td class="p-4 text-sm">
                                        @php
                                            $badgeClass = match($asset->condition) {
                                                'baik' => 'bg-emerald-100 text-emerald-800 border border-emerald-200',
                                                'rusak_ringan' => 'bg-amber-100 text-amber-800 border border-amber-200',
                                                'rusak_berat' => 'bg-red-100 text-red-800 border border-red-200',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $asset->condition)) }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-sm text-right space-x-2">
                                        <a href="{{ route('admin.assets.show', $asset->id) }}" class="text-blue-600 hover:text-blue-900 font-medium transition">Detail</a>
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('admin.assets.edit', $asset->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium transition">Edit</a>
                                            <form action="{{ route('admin.assets.destroy', $asset->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aset ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium transition">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-4 text-center text-sm text-gray-500">Data aset tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($assets->hasPages())
                    <div class="p-4 border-t border-gray-200/50">
                        {{ $assets->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
