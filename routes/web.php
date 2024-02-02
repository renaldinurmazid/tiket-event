<?php

use App\Http\Controllers\CategoryC;
use App\Http\Controllers\DashboardC;
use App\Http\Controllers\ProductC;
use App\Http\Controllers\TransaksiC;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[DashboardC::class, 'index'])->name('dashboard');
Route::get('/category',[CategoryC::class, 'index'])->name('category');
Route::get('/category/create',[CategoryC::class, 'create'])->name('category.create');
Route::post('/category/post',[CategoryC::class, 'store'])->name('category.store');

Route::get('/products',[ProductC::class, 'index'])->name('products');
Route::get('/products/create',[ProductC::class, 'create'])->name('products.create');
Route::post('/products/post',[ProductC::class, 'store'])->name('products.store');

Route::get('/transactions',[TransaksiC::class, 'index'])->name('transactions');
Route::get('/transactions/create',[TransaksiC::class, 'create'])->name('transactions.create');
Route::get('/transactions/show/{id}',[TransaksiC::class, 'show'])->name('transactions.show');
Route::post('/transactions/post',[TransaksiC::class, 'store'])->name('transactions.store');
Route::delete('/transactions/delete/{id}',[TransaksiC::class, 'destroy'])->name('transaction.destroy');
Route::put('/transactions/update/{id}',[TransaksiC::class, 'update'])->name('transaction.update');
