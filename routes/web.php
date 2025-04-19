<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\NotaDinasController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\PimpinanSpdController;
use App\Http\Controllers\LaporanPerjalananDinasController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/Admin', [AdminController::class, 'index']);

Route::resource('Pegawai', PegawaiController::class);

Route::get('/Pimpinan', [PimpinanSpdController::class, 'index']);

Route::resource('Surat', SuratTugasController::class);

Route::resource('NotaDinas', NotaDinasController::class);

Route::get('/LaporanPerjalananDinas', [LaporanPerjalananDinasController::class, 'index']);
