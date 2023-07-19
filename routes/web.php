<?php

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
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
  ]);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Kelurahan
    Route::get('/kelurahan', [App\Http\Controllers\KelurahanController::class, 'index' ])->name('kelurahan.index');
    Route::post('/kelurahan/create', [App\Http\Controllers\KelurahanController::class, 'create' ])->name('kelurahan.create');
    Route::get('/kelurahan/edit', [App\Http\Controllers\KelurahanController::class, 'edit' ])->name('kelurahan.edit');
    Route::post('/kelurahan/update', [App\Http\Controllers\KelurahanController::class, 'update' ])->name('kelurahan.update');
    Route::delete('/kelurahan/delete', [App\Http\Controllers\KelurahanController::class, 'delete' ])->name('kelurahan.delete');

    // Pasien
    Route::get('/pasien', [App\Http\Controllers\PasienController::class, 'index' ])->name('pasien.index');
    Route::post('/pasien/create', [App\Http\Controllers\PasienController::class, 'create' ])->name('pasien.create');
    Route::get('/pasien/edit', [App\Http\Controllers\PasienController::class, 'edit' ])->name('pasien.edit');
    Route::post('/pasien/update', [App\Http\Controllers\PasienController::class, 'update' ])->name('pasien.update');
    Route::delete('/pasien/delete', [App\Http\Controllers\PasienController::class, 'delete' ])->name('pasien.delete');
    Route::get('/pasien/cetak-kartu', [App\Http\Controllers\PasienController::class, 'cetak' ])->name('pasien.cetak.kartu');
});