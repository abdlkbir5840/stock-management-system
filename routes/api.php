<?php

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
Route::get('produits/{id}', [PrduitController::class, 'show']);
Route::put('produits/{id}', [PrduitController::class, 'update']);
Route::delete('produits/{id}', [PrduitController::class, 'destroy']);


