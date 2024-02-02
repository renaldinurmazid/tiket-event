<?php

use App\Http\Controllers\api\CategoryAPiC;
use App\Http\Controllers\api\ProductAPiC;
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

Route::get('/categories',[ CategoryAPiC::class, 'index']);
Route::get('/products',[ ProductAPiC::class, 'index']);
Route::post('/products/store',[ ProductAPiC::class, 'store']);
Route::get('/products/show/{id}',[ ProductAPiC::class, 'show']);
Route::put('/products/update/{id}',[ ProductAPiC::class, 'update']);
Route::delete('/products/destroy/{id}',[ ProductAPiC::class, 'destroy']);
