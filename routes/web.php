<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class,'index']);


Route::prefix('/admin')->group(function(){
    Route::get('/login',[AuthenticatedSessionController::class,'create'])->name('admin.auth.create');
    Route::post('/login',[AuthenticatedSessionController::class,'store'])->name('admin.auth.store');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');


    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/create',[AdminController::class,'create'])->name('admin.admin.create');
    Route::post('/admin/store',[AdminController::class,'store'])->name('admin.admin.store');
    Route::get('/admin/{user}/edit',[AdminController::class,'edit'])->name('admin.admin.edit');
    Route::post('/admin/{user}/update',[AdminController::class,'update'])->name('admin.admin.update');
    Route::get('/admin/{user}/destroy',[AdminController::class,'destroy'])->name('admin.admin.destroy');

    Route::get('/product/create',[ProductController::class,'create'])->name('admin.product.create');
    Route::post('/product/store',[ProductController::class,'store'])->name('admin.product.store');
    Route::get('/product/{product}/edit',[ProductController::class,'edit'])->name('admin.product.edit');
    Route::post('/product/{product}/update',[ProductController::class,'update'])->name('admin.product.update');
    Route::get('/product/{product}/destroy',[ProductController::class,'destroy'])->name('admin.product.destroy');

});




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
