<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OnSiteFormController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

// Redirect root: if logged in go to dashboard, otherwise go to login
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Auth Routes (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected Routes (Auth)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Change Password
    Route::get('/ubah-password', [AuthController::class, 'showChangePassword'])->name('password.change');
    Route::post('/ubah-password', [AuthController::class, 'changePassword'])->name('password.update');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // On-Site Form Routes
    Route::resource('forms', OnSiteFormController::class);

    // API Routes for Autocomplete
    Route::get('/api/search/customers', [OnSiteFormController::class, 'searchCustomers'])->name('api.search.customers');
    Route::get('/api/search/users', [OnSiteFormController::class, 'searchUsers'])->name('api.search.users');

    // PDF Export Route
    Route::get('/forms/{form}/pdf', [OnSiteFormController::class, 'exportPdf'])->name('forms.pdf');

    // Report Routes
    Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/laporan/export', [ReportController::class, 'export'])->name('reports.export');
    Route::get('/laporan/print', [ReportController::class, 'print'])->name('reports.print');

    // Admin Only Routes - Manajemen Petugas
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });
});
