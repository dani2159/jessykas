<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Penerimaancontroller;
use App\Http\Controllers\Pengeluarancontroller;
use App\Http\Controllers\Datapenggunacontroller;
use App\Http\Controllers\BebanController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\LaporanController;
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
            Route::get('/', [PenerimaanController::class, 'index'])->name('penerimaan.index');
            Route::post('/insert', [PenerimaanController::class, 'store'])->name('penerimaan.insert');
            Route::put('/update', [PenerimaanController::class, 'update'])->name('penerimaan.update');
            Route::delete('/delete', [PenerimaanController::class, 'destroy'])->name('penerimaan.delete');

        });
        Route::prefix('/data-pengeluaran')->group(function () {
            Route::get('/', [Pengeluarancontroller::class, 'index'])->name('pengeluaran.index');
            Route::post('/insert', [Pengeluarancontroller::class, 'store'])->name('pengeluaran.insert');
            Route::put('/update', [Pengeluarancontroller::class, 'update'])->name('pengeluaran.update');
            Route::delete('/delete', [Pengeluarancontroller::class, 'destroy'])->name('pengeluaran.delete');

        });

        Route::prefix('data-pengguna')->group(function () {
            Route::get('/', [Datapenggunacontroller::class, 'index'])->name('pengguna.index');
            Route::post('/insert', [Datapenggunacontroller::class, 'store'])->name('pengguna.insert');
            Route::put('/update', [Datapenggunacontroller::class, 'update'])->name('pengguna.update');
            Route::delete('/delete', [Datapenggunacontroller::class, 'destroy'])->name('pengguna.delete');
        });

        Route::prefix('/data-beban')->group(function () {
            Route::get('/', [BebanController::class, 'index'])->name('beban.index');
            Route::post('/insert', [BebanController::class, 'store'])->name('beban.insert');
            Route::put('/update', [BebanController::class, 'update'])->name('beban.update');
            Route::delete('/delete', [BebanController::class, 'destroy'])->name('beban.delete');
        });

        Route::prefix('/data-pendapatan')->group(function () {
            Route::get('/', [PendapatanController::class, 'index'])->name('pendapatan.index');
            Route::post('/insert', [PendapatanController::class, 'store'])->name('pendapatan.insert');
            Route::put('/update', [PendapatanController::class, 'update'])->name('pendapatan.update');
            Route::delete('/delete', [PendapatanController::class, 'destroy'])->name('pendapatan.delete');
        });


        Route::group(['prefix' => 'laporan'], function(){
            Route::get('/laporan-penerimaan', [LaporanController::class, 'laporanPenerimaan'])->name('laporan.penerimaan');
            Route::get('/laporan-penerimaan/list', [LaporanController::class, 'laporanPenerimaanList'])->name('laporan.penerimaan.list');
            Route::get('/laporan-pengeluaran', [LaporanController::class, 'laporanPengeluaran'])->name('laporan.pengeluaran');
            Route::get('/laporan-pengeluaran/list', [LaporanController::class, 'laporanPengeluaranList'])->name('laporan.pengeluaran.list');

        });
    // });


});
