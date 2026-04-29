<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalCategories = \App\Models\Category::count();
        $totalAssets = \App\Models\Asset::count();
        $totalMaintenance = \App\Models\MaintenanceLog::count();

        // Sample data for charts
        $assetConditionStats = \App\Models\Asset::selectRaw('`condition`, count(*) as total')->groupBy('condition')->get();

        return view('admin.dashboard', compact('totalCategories', 'totalAssets', 'totalMaintenance', 'assetConditionStats'));
    }}
