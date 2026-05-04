@php
    /** @var \App\Models\MaintenanceLog $maintenance */
    /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Asset> $assets */
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pemeliharaan') }}
        </h2>
    </x-slot>

    <div class="py-12 fade-in">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass overflow-hidden sm:rounded-2xl p-8">
                <form method="POST" action="{{ route('admin.maintenance.update', $maintenance->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Asset -->
                        <div>
                            <label for="asset_id" class="block font-medium text-sm text-gray-700">Aset</label>
                            <select id="asset_id" name="asset_id" class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm" required>
                                <option value="">Pilih Aset</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}" {{ old('asset_id', $maintenance->asset_id) == $asset->id ? 'selected' : '' }}>
                                        {{ $asset->name }} ({{ $asset->category?->name ?? 'Tanpa Kategori' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('asset_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div>
                            <label for="maintenance_date" class="block font-medium text-sm text-gray-700">Tanggal Pemeliharaan</label>
                            <input id="maintenance_date" class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm" type="date" name="maintenance_date" value="{{ old('maintenance_date', $maintenance->maintenance_date) }}" required />
                            @error('maintenance_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cost -->
                        <div>
                            <label for="cost" class="block font-medium text-sm text-gray-700">Biaya (Rp)</label>
                            <input id="cost" class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm" type="number" min="0" step="1000" name="cost" value="{{ old('cost', floor($maintenance->cost)) }}" required />
                            @error('cost')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                            <select id="status" name="status" class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm" required>
                                <option value="planned" {{ old('status', $maintenance->status) == 'planned' ? 'selected' : '' }}>Planned (Direncanakan)</option>
                                <option value="ongoing" {{ old('status', $maintenance->status) == 'ongoing' ? 'selected' : '' }}>Ongoing (Sedang Berjalan)</option>
                                <option value="completed" {{ old('status', $maintenance->status) == 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                            </select>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block font-medium text-sm text-gray-700">Deskripsi Pemeliharaan</label>
                            <textarea id="description" class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm" name="description" rows="4" required>{{ old('description', $maintenance->description) }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 gap-4 border-t border-gray-200/50 pt-6">
                        <a href="{{ route('admin.maintenance.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition">Batal</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition shadow-md shadow-indigo-500/30">
                            Perbarui Log Pemeliharaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
