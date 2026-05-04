<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\MaintenanceLog;
use Illuminate\Http\Request;
use App\Exports\MaintenanceLogsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class MaintenanceLogController extends Controller
{
    private function buildQuery(Request $request)
    {
        $query = MaintenanceLog::with('asset.category')->latest('maintenance_date');
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('maintenance_date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('maintenance_date', '<=', $request->end_date);
        }

        if ($request->has('category_id') && $request->category_id != '') {
            $query->whereHas('asset', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        return $query;
    }

    public function index(Request $request)
    {
        $query = $this->buildQuery($request);
        $logs = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.maintenance.index', compact('logs', 'categories'));
    }

    public function exportPdf(Request $request)
    {
        $logs = $this->buildQuery($request)->get();
        
        $pdf = Pdf::loadView('admin.maintenance.pdf', compact('logs'));
        
        return $pdf->download('Laporan_Pemeliharaan_' . date('Y-m-d') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $logs = $this->buildQuery($request)->get();

        return Excel::download(new MaintenanceLogsExport($logs), 'Laporan_Pemeliharaan_' . date('Y-m-d') . '.xlsx');
    }

    public function create(Request $request)
    {
        $assets = Asset::with('category')->get();
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
        $assets = Asset::with('category')->get();
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
