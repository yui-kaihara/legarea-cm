<?php

use App\Http\Controllers\CashManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SesDataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    //CM表
    Route::resource('cm', CashManagementController::class);
    
    //SES
    Route::resource('ses', SesDataController::class);
});

require __DIR__.'/auth.php';
