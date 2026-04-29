<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\MaintenanceLog;
use Illuminate\Http\Request;

class MaintenanceLogController extends Controller
{
    public function index(Request $request)
    {
        $query = MaintenanceLog::with('asset')->latest('maintenance_date');
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $logs = $query->paginate(10);

        return view('admin.maintenance.index', compact('logs'));
    }

    public function create(Request $request)
    {
        $assets = Asset::all();
        $selectedAsset = $request->query('asset_id');
        return view('admin.maintenance.create', compact('assets', 'selectedAsset'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'maintenance_date' => 'required|date',
            'cost' => 'required|numeric|min:0',
            'description' => 'required|string',
            'status' => 'required|in:planned,ongoing,completed',
        ]);

        MaintenanceLog::create($validated);

        return redirect()->route('admin.maintenance.index')->with('success', 'Log pemeliharaan berhasil ditambahkan.');
    }

    public function show(MaintenanceLog $maintenance)
    {
        return view('admin.maintenance.show', compact('maintenance'));
    }

    public function edit(MaintenanceLog $maintenance)
    {
        $assets = Asset::all();
        return view('admin.maintenance.edit', compact('maintenance', 'assets'));
    }

    public function update(Request $request, MaintenanceLog $maintenance)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'maintenance_date' => 'required|date',
            'cost' => 'required|numeric|min:0',
            'description' => 'required|string',
            'status' => 'required|in:planned,ongoing,completed',
        ]);

        $maintenance->update($validated);

        return redirect()->route('admin.maintenance.index')->with('success', 'Log pemeliharaan berhasil diperbarui.');
    }

    public function destroy(MaintenanceLog $maintenance)
    {
        $maintenance->delete();

        return redirect()->route('admin.maintenance.index')->with('success', 'Log pemeliharaan berhasil dihapus.');
    }
}
