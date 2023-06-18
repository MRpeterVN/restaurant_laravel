<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/list', [AdminController::class, 'list'])->name('dashboard.list');
Route::get('/dashboard/create', [AdminController::class, 'create'])->name('dashboard.create');
Route::post('/dashboard/store', [AdminController::class, 'store'])->name('dashboard.store');
Route::get('/dashboard/edit/{id}', [AdminController::class, 'edit'])->name('dashboard.edit');
Route::put('/dashboard/update/{id}', [AdminController::class, 'update'])->name('dashboard.update');
Route::delete('/dashboard/destroy/{id}', [AdminController::class, 'destroy'])->name('dashboard.destroy');



Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/home/list', [HomeController::class, 'list'])->name('home.list');
Route::get('/home/create', [HomeController::class, 'create'])->name('home.create');
Route::post('/home/store', [HomeController::class, 'store'])->name('home.store');
Route::get('/home/edit/{id}', [HomeController::class, 'edit'])->name('home.edit');
Route::put('/home/update/{id}', [HomeController::class, 'update'])->name('home.update');
Route::delete('/home/destroy/{id}', [HomeController::class, 'destroy'])->name('home.destroy');








Route::get('/db', function () {
    return view('dashboard.dbcon');
});