<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Aset') }}
        </h2>
    </x-slot>

    <div class="py-12 fade-in">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass overflow-hidden sm:rounded-2xl p-8">
                <form method="POST" action="{{ route('admin.assets.update', $asset->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama Aset</label>
                            <input id="name" class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm" type="text" name="name" value="{{ old('name', $asset->name) }}" required autofocus />
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="category_id" class="block font-medium text-sm text-gray-700">Kategori</label>
                            <select id="category_id" name="category_id" class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $asset->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Condition -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="condition" class="block font-medium text-sm text-gray-700">Kondisi</label>
                            <select id="condition" name="condition" class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm" required>
                                <option value="baik" {{ old('condition', $asset->condition) == 'baik' ? 'selected' : '' }}>Baik</option>
                                <option value="rusak_ringan" {{ old('condition', $asset->condition) == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="rusak_berat" {{ old('condition', $asset->condition) == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                            </select>
                            @error('condition')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Acquisition Date -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="acquisition_date" class="block font-medium text-sm text-gray-700">Tanggal Perolehan</label>
                            <input id="acquisition_date" class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm" type="date" name="acquisition_date" value="{{ old('acquisition_date', $asset->acquisition_date) }}" />
                            @error('acquisition_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="col-span-2">
                            <label for="location" class="block font-medium text-sm text-gray-700">Lokasi</label>
                            <input id="location" class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm" type="text" name="location" value="{{ old('location', $asset->location) }}" />
                            @error('location')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-span-2">
                            <label for="description" class="block font-medium text-sm text-gray-700">Deskripsi Tambahan</label>
                            <textarea id="description" class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm" name="description" rows="3">{{ old('description', $asset->description) }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Photo -->
                        <div class="col-span-2">
                            <label for="photo" class="block font-medium text-sm text-gray-700">Foto Aset</label>
                            @if($asset->photo_url)
                                <div class="mt-2 mb-4">
                                    <img src="{{ Storage::url($asset->photo_url) }}" alt="Current Photo" class="w-32 h-32 rounded-lg object-cover border shadow-sm">
                                    <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                                </div>
                            @endif
                            <input id="photo" class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition" type="file" name="photo" accept="image/*" />
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto.</p>
                            @error('photo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 gap-4 border-t border-gray-200/50 pt-6">
                        <a href="{{ route('admin.assets.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition">Batal</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition shadow-md shadow-indigo-500/30">
                            Perbarui Aset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
