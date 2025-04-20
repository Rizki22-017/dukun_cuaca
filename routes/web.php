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

Route::get('/Admin', [AdminController::class, 'index']);

Route::resource('Pegawai', PegawaiController::class);


Route::get('Pimpinan/createspd', [PimpinanController::class, 'createSpd'])->name('Pimpinan.createSpd');
Route::post('Pimpinan/storespd', [PimpinanController::class, 'storeSpd'])->name('Pimpinan.storeSpd');
Route::resource('Pimpinan', PimpinanController::class);

Route::resource('Surat', SuratTugasController::class);

Route::resource('NotaDinas', NotaDinasController::class);

Route::resource('LaporanPerjalananDinas', LaporanPerjalananDinasController::class);
