<?php

use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// route for admin
Route::prefix('/admin')->name('admin.')->middleware(['auth', 'role:administrator'])->group(function () {
    // users feature
    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('index');
        Route::get('/create', [UserManagementController::class, 'create'])->name('create');
        Route::post('/', [UserManagementController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserManagementController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserManagementController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserManagementController::class, 'destroy'])->name('destroy');
    });
});


Route::prefix('/bendahara')->name('bendahara.')->middleware(['auth', 'role:bendahara'])->group(function () {
    // users feature
    // bendahara index
    Route::get('/', function () {

        return view('pages.bendahara.index');
    })->name('index');
});

Route::prefix('/wajib-pajak')->name('wajib-pajak.')->middleware(['auth', 'role:wajib pajak'])->group(function () {
    // users feature
    // bendahara index
    Route::get('/', function () {

        return view('pages.wajib-pajak.index');
    })->name('index');
});

Route::prefix('/pemungut-pajak')->name('pemungut-pajak.')->middleware(['auth', 'role:pemungut pajak'])->group(function () {
    // users feature
    // bendahara index
    Route::get('/', function () {

        return view('pages.pemungut-pajak.index');
    })->name('index');
});

require __DIR__ . '/auth.php';
