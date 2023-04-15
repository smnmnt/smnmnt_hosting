<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [\App\Http\Controllers\ProductController::class, 'main'])->name('products.main');

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/show/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/products/create/', [\App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
Route::get('/products/edit/{id}', [\App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');

Route::post('/products/store', [\App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
Route::patch('/products/show/{id}', [\App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');




Route::get('/bands', [\App\Http\Controllers\BandController::class, 'index'])->name('bands.index');
Route::get('/bands/show/{id}', [\App\Http\Controllers\BandController::class, 'show'])->name('bands.show');
Route::get('/bands/create/', [\App\Http\Controllers\BandController::class, 'create'])->name('bands.create');
Route::get('/bands/edit/{id}', [\App\Http\Controllers\BandController::class, 'edit'])->name('bands.edit');

Route::post('/bands/store', [\App\Http\Controllers\BandController::class, 'store'])->name('bands.store');
Route::patch('/bands/show/{id}', [\App\Http\Controllers\BandController::class, 'update'])->name('bands.update');
Route::delete('/bands/{id}', [\App\Http\Controllers\BandController::class, 'destroy'])->name('bands.destroy');




Route::get('/genres', [\App\Http\Controllers\GenreController::class, 'index'])->name('genres.index');
Route::get('/genres/show/{id}', [\App\Http\Controllers\GenreController::class, 'show'])->name('genres.show');
Route::get('/genres/create/', [\App\Http\Controllers\GenreController::class, 'create'])->name('genres.create');
Route::get('/genres/edit/{id}', [\App\Http\Controllers\GenreController::class, 'edit'])->name('genres.edit');

Route::post('/genres/store', [\App\Http\Controllers\GenreController::class, 'store'])->name('genres.store');
Route::patch('/genres/show/{id}', [\App\Http\Controllers\GenreController::class, 'update'])->name('genres.update');
Route::delete('/genres/{id}', [\App\Http\Controllers\GenreController::class, 'destroy'])->name('genres.destroy');



Route::get('/collections', [\App\Http\Controllers\CollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/show/{id}', [\App\Http\Controllers\CollectionController::class, 'show'])->name('collections.show');
Route::get('/collections/create', [\App\Http\Controllers\CollectionController::class, 'create'])->name('collections.create');
Route::get('/collections/edit/{id}', [\App\Http\Controllers\CollectionController::class, 'edit'])->name('collections.edit');


Route::post('/collections/store', [\App\Http\Controllers\CollectionController::class, 'store'])->name('collections.store');
Route::patch('/collections/show/{id}', [\App\Http\Controllers\CollectionController::class, 'update'])->name('collections.update');
Route::delete('/collections/{id}', [\App\Http\Controllers\CollectionController::class, 'destroy'])->name('collections.destroy');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
