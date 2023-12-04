<?php

use App\Http\Controllers\CommandeController;
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

Route::get('/commandes', [CommandeController::class, "index"]);
Route::post('/commandes', [CommandeController::class, 'store'])->name('commande.store');
// Update the specified commande in the database
Route::put('/commandes/{commande}', [CommandeController::class, 'update'])->name('commande.update');
Route::delete('/commandes/{commande}', [CommandeController::class, 'destroy'])->name('commande.destroy');
