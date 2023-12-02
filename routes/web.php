<?php

use App\Http\Controllers\ClientController;
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
Route::get('/clients', [ClientController::class, 'index']);
Route::post('/clients', [ClientController::class, 'store'])->name('client.store');
Route::get('/clients/{id}', [ClientController::class, 'show'])->name('client.show');
Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('client.destroy');
Route::put('/clients/{id}', [ClientController::class, 'update'])->name('client.update');

