<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12 fade-in">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass overflow-hidden sm:rounded-2xl p-8">
                <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <!-- Name -->
                    <div class="mb-6">
                        <label for="name" class="block font-medium text-sm text-gray-700">Nama Kategori</label>
                        <input id="name" class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm" type="text" name="name" value="{{ old('name', $category->name) }}" required autofocus />
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block font-medium text-sm text-gray-700">Deskripsi</label>
                        <textarea id="description" class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm bg-white/50 backdrop-blur-sm" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4 gap-4">
                        <a href="{{ route('admin.categories.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition">Batal</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition shadow-md shadow-indigo-500/30">
                            Perbarui Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
