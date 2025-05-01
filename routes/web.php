<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokumenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\NotaDinasController;
use App\Http\Controllers\LaporanPerjalananDinasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\SuratController;
use App\Http\Middleware\CekWewenang;
use App\WewenangEnum;

Route::resource('/', HomeController::class);

//dokumen download
// Route::get('/St/download/{id}', [DokumenController::class, 'downloadSt'])->name('st.download')->middleware('auth');
// Route::get('/St-d/download/{id}', [DokumenController::class, 'downloadSpd'])->name('spd.download')->middleware('auth');

// Route::resource('Admin', AdminController::class)->middleware('auth');

// Route::resource('Pegawai', PegawaiController::class)->middleware('auth');

// Route::resource('Pimpinan', PimpinanController::class)->middleware('auth');

// Route::resource('St', SuratController::class)->middleware('auth');

// Route::resource('NotaDinas', NotaDinasController::class)->middleware('auth');

// Route::resource('LaporanPerjalananDinas', LaporanPerjalananDinasController::class)->middleware('auth');

Route::middleware(['auth'])->group(function () {
    // Route::get('/', [HomeController::class, 'index']);

    Route::middleware([CekWewenang::class . ':' . WewenangEnum::Admin->value])->group(function () {
        Route::resource('Admin', AdminController::class);
        Route::resource('Pegawai', PegawaiController::class);
        Route::resource('Pimpinan', PimpinanController::class);
        Route::resource('St', SuratController::class);
    });

    Route::middleware([CekWewenang::class . ':' . WewenangEnum::Admin->value . ',' . WewenangEnum::PimpinanSt->value . ',' . WewenangEnum::PimpinanSpd->value])->group(function () {
        Route::resource('NotaDinas', NotaDinasController::class);
    });

    Route::middleware([CekWewenang::class . ':' . implode(',', [
        WewenangEnum::Admin->value,
        WewenangEnum::PimpinanSt->value,
        WewenangEnum::PimpinanSpd->value,
        WewenangEnum::PegawaiBiasa->value,
    ])])->group(function () {
        Route::resource('St', SuratController::class);
        Route::resource('LaporanPerjalananDinas', LaporanPerjalananDinasController::class);
        Route::get('/St/download/{id}', [DokumenController::class, 'downloadSt'])->name('st.download');
        Route::get('/St-d/download/{id}', [DokumenController::class, 'downloadSpd'])->name('spd.download');
    });
});

//login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [LoginController::class, 'register'])->name('Login.store');
