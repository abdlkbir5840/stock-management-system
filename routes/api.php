<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\PrduitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('produits', [PrduitController::class, 'index']);
Route::post('produits', [PrduitController::class, 'store']);
Route::get('produits/{column}/{param}', [PrduitController::class, 'show']);
Route::put('produits/{id}', [PrduitController::class, 'update']);
Route::delete('produits/{id}', [PrduitController::class, 'destroy']);


Route::get('clients', [ClientController::class, 'index']);
Route::post('clients', [ClientController::class, 'store']);
Route::get('clients/{id}', [ClientController::class, 'show']);
Route::delete('clients/{id}', [ClientController::class, 'destroy']);
Route::put('clients/{id}', [ClientController::class, 'update']);


Route::get('fournisseurs', [FournisseurController::class, 'index']);
Route::post('fournisseurs', [FournisseurController::class, 'store']);
Route::get('fournisseurs/{column}/{param}', [FournisseurController::class, 'show']);
Route::put('fournisseurs/{id}', [FournisseurController::class, 'update']);
Route::delete('fournisseurs/{id}', [FournisseurController::class, 'destroy']);
