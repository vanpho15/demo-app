<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin/login',[LoginController::class, 'index'])->name('login');
Route::post('/admin/store',[LoginController::class, 'store'])->name('admin.store');
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/',[MainController::class, 'index'])->name('admin.index');
        Route::get('/main',[MainController::class, 'index']);
        #category
        Route::prefix('/categories')->group(function () {
            Route::get('/add',[CategoryController::class, 'create'])->name('categories.create');
            Route::post('/add/store',[CategoryController::class, 'store'])->name('categories.store');
            Route::get('/list',[CategoryController::class, 'index'])->name('categories.index');
            Route::get('/edit/{category}',[CategoryController::class, 'show']);
            Route::post('/edit/{category}',[CategoryController::class, 'update']);
            Route::delete('/destroy',[CategoryController::class, 'destroy']);
        });
        Route::prefix('/products')->group(function () {
            Route::get('/add',[ProductController::class, 'create'])->name('products.create');
            Route::post('/add/store',[ProductController::class, 'store'])->name('products.store');

        });
        #upload
        Route::post('upload/services', [\App\Http\Controllers\Admin\UploadController::class, 'store']);
    });
    
    
});
