<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);


//for customer
Route::get('/allproducts',[ProductController::class, 'index'])->middleware('role:customer')->name('allProduct');;


//for mainAdmin
Route::get('/products',[ProductController::class, 'index'])->middleware('role:admin');
Route::post('/products',[ProductController::class, 'store']);
Route::get('/products/create',[ProductController::class, 'create']);
Route::get('/products/{product}',[ProductController::class, 'show'])->name('singleProduct');
Route::get('/products/{product}/edit',[ProductController::class, 'edit'])->name('editProduct');
Route::put('/products/{product}',[ProductController::class, 'update'])->name('updateProduct');
Route::delete('/products/{product}',[ProductController::class, 'destroy']);


//for CdAdmin
Route::get('/cdproducts',[ProductController::class, 'index'])->middleware('role:cdAdmin');
Route::post('/cdproducts',[ProductController::class, 'store']);
Route::get('/cdproducts/create',[ProductController::class, 'create']);
Route::get('/cdproducts/{product}',[ProductController::class, 'show'])->name('singleCdProduct');
Route::get('/cdproducts/{product}/edit',[ProductController::class, 'edit'])->name('editCdProduct');
Route::put('/cdproducts/{product}',[ProductController::class, 'update'])->name('updateCdProduct');
Route::delete('/cdproducts/{product}',[ProductController::class, 'destroy']);

//for BookAdmin
Route::get('/bookproducts',[ProductController::class, 'index'])->middleware('role:bookAdmin');
Route::post('/bookproducts',[ProductController::class, 'store']);
Route::get('/bookproducts/create',[ProductController::class, 'create']);
Route::get('/bookproducts/{product}',[ProductController::class, 'show'])->name('singleBookProduct');
Route::get('/bookproducts/{product}/edit',[ProductController::class, 'edit'])->name('editBookProduct');
Route::put('/bookproducts/{product}',[ProductController::class, 'update'])->name('updateBookProduct');
Route::delete('/bookproducts/{product}',[ProductController::class, 'destroy']);

