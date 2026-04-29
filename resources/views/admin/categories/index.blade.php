<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12 fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Action Bar -->
            @if(auth()->user()->role === 'admin')
                <div class="mb-6 flex justify-end">
                    <a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-md shadow-indigo-500/30">
                        + Kategori Baru
                    </a>
                </div>
            @endif

            <div class="glass overflow-hidden sm:rounded-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200/50 bg-gray-50/50">
                                <th class="p-4 text-sm font-medium text-gray-500">No</th>
                                <th class="p-4 text-sm font-medium text-gray-500">Nama Kategori</th>
                                <th class="p-4 text-sm font-medium text-gray-500">Deskripsi</th>
                                <th class="p-4 text-sm font-medium text-gray-500 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200/50 bg-white/30">
                            @forelse($categories as $category)
                                <tr class="hover:bg-white/50 transition duration-150">
                                    <td class="p-4 text-sm text-gray-600">{{ $loop->iteration + $categories->firstItem() - 1 }}</td>
                                    <td class="p-4 text-sm font-medium text-gray-800">{{ $category->name }}</td>
                                    <td class="p-4 text-sm text-gray-600">{{ $category->description ?? '-' }}</td>
                                    <td class="p-4 text-sm text-right space-x-2">
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium transition">Edit</a>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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
                                    <td colspan="4" class="p-4 text-center text-sm text-gray-500">Data kategori tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($categories->hasPages())
                    <div class="p-4 border-t border-gray-200/50">
                        {{ $categories->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
