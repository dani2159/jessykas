<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Akuncontroller;
use App\Http\Controllers\Penerimaancontroller;
use App\Http\Controllers\Pengeluarancontroller;
use App\Http\Controllers\DatapenggunaController
;use App\Http\Controllers\LaporanController;
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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'Userauth'], function () {
    // Route::group(['roles'=>'admin'], function (){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


        Route::prefix('/data-penerimaan')->group(function () {
            Route::get('/', [Penerimaancontroller::class, 'index'])->name('penerimaan.index');
            Route::post('/insert', [Penerimaancontroller::class, 'store'])->name('penerimaan.insert');
            Route::put('/update', [Penerimaancontroller::class, 'update'])->name('penerimaan.update');
            Route::delete('/delete', [Penerimaancontroller::class, 'destroy'])->name('penerimaan.delete');

        });
        Route::prefix('/data-pengeluaran')->group(function () {
            Route::get('/', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
            Route::post('/insert', [pengeluaranController::class, 'store'])->name('pengeluaran.insert');
            Route::put('/update', [pengeluaranController::class, 'update'])->name('pengeluaran.update');
            Route::delete('/delete', [PengeluaranController::class, 'destroy'])->name('pengeluaran.delete');

        });

        Route::prefix('data-pengguna')->group(function () {
            Route::get('/', [Datapenggunacontroller::class, 'index'])->name('pengguna.index');
            Route::post('/insert', [Datapenggunacontroller::class, 'store'])->name('pengguna.insert');
            Route::put('/update', [Datapenggunacontroller::class, 'update'])->name('pengguna.update');
            Route::delete('/delete', [Datapenggunacontroller::class, 'destroy'])->name('pengguna.delete');
        });

        Route::prefix('/data-akun')->group(function () {
            Route::get('/', [AkunController::class, 'index'])->name('akun.index');
            Route::post('/insert', [AkunController::class, 'store'])->name('akun.insert');
            Route::put('/update', [AkunController::class, 'update'])->name('akun.update');
            Route::delete('/delete', [AkunController::class, 'destroy'])->name('akun.delete');
        });


        Route::group(['prefix' => 'laporan'], function(){
            Route::get('/laporan-kas', [LaporanController::class, 'index'])->name('laporan.index ');
            Route::get('/laporan-kas/list', [LaporanController::class, 'laporanList'])->name('laporan.list');

        });
    // });


});
