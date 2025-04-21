<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\NotaDinasController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\LaporanPerjalananDinasController;
use App\Http\Controllers\PimpinanController;

Route::resource('/', HomeController::class);

Route::resource('Pegawai', PegawaiController::class);

//route custom pimpinan
Route::get('Pimpinan/createspd', [PimpinanController::class, 'createSpd'])->name('Pimpinan.createSpd');
Route::post('Pimpinan/storespd', [PimpinanController::class, 'storeSpd'])->name('Pimpinan.storeSpd');
Route::delete('Pimpinan/delete-spd/{id}', [PimpinanController::class, 'destroySpd'])->name('Pimpinan.destroySpd');
Route::get('/pimpinan/spd/{id}/edit', [PimpinanController::class, 'editSpd'])->name('Pimpinan.editSpd');
Route::put('/pimpinan/spd/{id}', [PimpinanController::class, 'updateSpd'])->name('Pimpinan.updateSpd');

//route default pimpinan
Route::resource('Pimpinan', PimpinanController::class);

Route::resource('St', SuratTugasController::class);

Route::resource('NotaDinas', NotaDinasController::class);

Route::resource('LaporanPerjalananDinas', LaporanPerjalananDinasController::class);
