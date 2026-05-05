<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $query = Asset::with('category')->latest();
        
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $assets = $query->paginate(10);
        $categories = Category::all();

        return view('admin.assets.index', compact('assets', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.assets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'condition' => 'required|in:baik,rusak_ringan,rusak_berat',
            'acquisition_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $base64 = 'data:image/' . $file->extension() . ';base64,' . base64_encode(file_get_contents($file));
            $validated['photo_url'] = $base64;
        }

        Asset::create($validated);

        return redirect()->route('admin.assets.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    public function show(Asset $asset)
    {
        $asset->load(['category', 'maintenanceLogs' => function($q) {
            $q->latest('maintenance_date');
        }]);
        return view('admin.assets.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        $categories = Category::all();
        return view('admin.assets.edit', compact('asset', 'categories'));
    }

    public function update(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'condition' => 'required|in:baik,rusak_ringan,rusak_berat',
            'acquisition_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $base64 = 'data:image/' . $file->extension() . ';base64,' . base64_encode(file_get_contents($file));
            $validated['photo_url'] = $base64;
        }

        $asset->update($validated);

        return redirect()->route('admin.assets.index')->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy(Asset $asset)
    {
        // No need to delete file from disk since it's stored as base64 in the database
        
        $asset->delete();

        return redirect()->route('admin.assets.index')->with('success', 'Aset berhasil dihapus.');
    }
}
