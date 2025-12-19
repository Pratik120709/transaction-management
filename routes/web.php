<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/transactions', [PageController::class, 'transactions'])->name('transactions');
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

// Dashboard API routes
Route::get('/api/dashboard-data', [DashboardController::class, 'index']);
Route::post('/api/calculate-yesterday', [DashboardController::class, 'calculateYesterdayTotal']);
