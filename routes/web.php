<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\NotaDinasController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\PimpinanSpdController;
use App\Http\Controllers\SuratPerjalananDinasController;
use App\Http\Controllers\LaporanPerjalananDinasController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/Admin', [PegawaiController::class, 'index']);

Route::get('/Pegawai', [PegawaiController::class, 'index']);

Route::get('/Pimpinan', [PimpinanSpdController::class, 'index']);

Route::get('/SuratTugas', [SuratTugasController::class, 'index']);

Route::get('/SuratPerjalananDinas', [SuratPerjalananDinasController::class, 'index']);

Route::get('/NotaDinas', [NotaDinasController::class, 'index']);

Route::get('/LaporanPerjalananDinas', [LaporanPerjalananDinasController::class, 'index']);
