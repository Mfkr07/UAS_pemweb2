<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Redirect /dashboard based on role
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('viewer.dashboard');
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        // Write operations only for admin
        Route::resource('categories', CategoryController::class)->except(['index', 'show']);
        Route::resource('assets', \App\Http\Controllers\AssetController::class)->except(['index', 'show']);
        Route::resource('maintenance', \App\Http\Controllers\MaintenanceLogController::class)->except(['index', 'show']);
    });

    // Read operations for all authenticated users (Admin & Viewer)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', CategoryController::class)->only(['index', 'show']);
        Route::resource('assets', \App\Http\Controllers\AssetController::class)->only(['index', 'show']);
        Route::resource('maintenance', \App\Http\Controllers\MaintenanceLogController::class)->only(['index', 'show']);
    });

    // Viewer Routes
    Route::middleware(['role:viewer'])->prefix('viewer')->name('viewer.')->group(function () {
        Route::get('/dashboard', function () {
            $totalCategories = \App\Models\Category::count();
            $totalAssets = \App\Models\Asset::count();
            $recentMaintenance = \App\Models\MaintenanceLog::with('asset')->latest('maintenance_date')->take(5)->get();
            $assetConditionStats = \App\Models\Asset::selectRaw('`condition`, count(*) as total')->groupBy('condition')->get();

            return view('viewer.dashboard', compact('totalCategories', 'totalAssets', 'recentMaintenance', 'assetConditionStats'));
        })->name('dashboard');
    });

    // Profile Routes (Common)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
