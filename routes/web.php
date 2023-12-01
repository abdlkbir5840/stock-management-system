<?php

use App\Http\Controllers\PrduitController;
use Illuminate\Support\Facades\Route;

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
});

Route::get('/produits', [PrduitController::class, 'index']);
Route::post('produits', [PrduitController::class, 'store'])->name('produit.store');
Route::delete('/produits/{id}', [PrduitController::class, 'destroy'])->name('produit.destroy');
Route::get('/produits/{id}', [PrduitController::class, 'edit'])->name('produit.edit');
Route::put('/produits/{id}', [PrduitController::class, 'update'])->name('produit.update');
Route::post('/produit/search', [PrduitController::class, 'search'])->name('produit.search');
