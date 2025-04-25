<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokumenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\NotaDinasController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\LaporanPerjalananDinasController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\SuratController;

Route::resource('/', HomeController::class);
Route::resource('/suratt', DokumenController::class);

Route::resource('Admin', AdminController::class);

Route::resource('Pegawai', PegawaiController::class);

Route::resource('Pimpinan', PimpinanController::class);

Route::resource('St', SuratController::class);

Route::resource('NotaDinas', NotaDinasController::class);

Route::resource('LaporanPerjalananDinas', LaporanPerjalananDinasController::class);
