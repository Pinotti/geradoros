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

Route::prefix('fabricantes')->group(function () {
    Route::get('', [FabricanteController::class, 'index'])->name('fabricantes.index');
    Route::post('', [FabricanteController::class, 'store'])->name('fabicantes.store');
});

Route::fallback(function () {
    return 'Fallback';
});

Route::get('/', function () {
    return view('welcome');
});
