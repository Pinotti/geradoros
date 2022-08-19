<?php

use App\Http\Controllers\FabricanteController;
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

Route::prefix('fabricante')->group(function () {
    Route::get('', [FabricanteController::class, 'index'])->name('fabricante.index');
    Route::post('/store', [FabricanteController::class, 'store'])->name('fabicante.store');
    Route::post('/{id}/update', [FabricanteController::class, 'update'])->name('fabricante.upate');
    Route::delete('/{id}', [FabricanteController::class, 'destroy'])->name('fabricante.destroy');
});

Route::fallback(function () {
    return 'Fallback';
});

Route::get('/', function () {
    return view('welcome');
});
