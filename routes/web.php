<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ibu\DashboardController as IbuDashboardController;
use App\Http\Controllers\ibu\DataanakController as IbuDataanakController;
use App\Http\Controllers\DataBidanController;
use App\Http\Controllers\DatapetugasController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\TimbanganController;
use App\Http\Controllers\VaksinController;
use App\Http\Controllers\VitaminController;
use App\Http\Controllers\LaporanController;

use App\Http\Controllers\Databebancontroller;
use App\Http\Controllers\Datapenggunacontroller;
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
    Route::group(['roles'=>'admin'], function (){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('/data-beban')->group(function () {
            Route::get('/', [DatabebanController::class, 'index'])->name('beban.index');
            Route::post('/insert', [DatabebanController::class, 'store'])->name('beban.insert');
            Route::put('/update', [DatabebanController::class, 'update'])->name('beban.update');
            Route::delete('/delete', [DatabebanController::class, 'destroy'])->name('beban.delete');

        });

        Route::prefix('data-pengguna')->group(function () {
            Route::get('/', [Datapenggunacontroller::class, 'index'])->name('pengguna.index');
            Route::post('/insert', [Datapenggunacontroller::class, 'store'])->name('pengguna.insert');
            Route::put('/update', [Datapenggunacontroller::class, 'update'])->name('pengguna.update');
            Route::delete('/delete', [Datapenggunacontroller::class, 'destroy'])->name('pengguna.delete');
        });





        Route::group(['prefix' => 'timbangan'], function () {
            Route::get('/', [TimbanganController::class, 'index'])->name('admin.timbangan.index');
            Route::get('/create', [TimbanganController::class, 'createtimbangan'])->name('admin.timbangan.create');
            Route::post('/insert', [TimbanganController::class, 'insert'])->name('admin.timbangan.insert');
            Route::put('/update', [TimbanganController::class, 'update'])->name('admin.timbangan.update');
            Route::delete('/delete', [TimbanganController::class, 'delete'])->name('admin.timbangan.delete');
        });

        Route::group(['prefix' => 'data-vaksin'], function () {
            Route::get('/', [VaksinController::class, 'index'])->name('admin.vaksin.index');
            Route::post('/insert', [VaksinController::class, 'insert'])->name('admin.vaksin.insert');
            Route::put('/update', [VaksinController::class, 'update'])->name('admin.vaksin.update');
            Route::delete('/delete', [VaksinController::class, 'delete'])->name('admin.vaksin.delete');
        });
        Route::group(['prefix' => 'imunisasi'], function () {
            Route::get('/', [ImunisasiController::class, 'index'])->name('admin.imunisasi.index');
            Route::post('/insert', [ImunisasiController::class, 'insert'])->name('admin.imunisasi.insert');
            Route::put('/update', [ImunisasiController::class, 'update'])->name('admin.imunisasi.update');
            Route::delete('/delete', [ImunisasiController::class, 'delete'])->name('admin.imunisasi.delete');
        });
        Route::group(['prefix' => 'vitamin'], function () {
            Route::get('/', [VitaminController::class, 'index'])->name('admin.vitamin.index');
            Route::put('/update', [VitaminController::class, 'update'])->name('admin.vitamin.update');
        });

        Route::group(['prefix' => 'data-bidan'], function () {
            Route::get('/', [DataBidanController::class, 'index'])->name('admin.databidan.index');
            Route::post('/insert', [DataBidanController::class, 'insert'])->name('admin.databidan.insert');
            Route::put('/update', [DataBidanController::class, 'update'])->name('admin.databidan.update');
            Route::delete('/delete', [DataBidanController::class, 'delete'])->name('admin.databidan.delete');
        });
        Route::group(['prefix' => 'data-petugas'], function () {
            Route::get('/', [DatapetugasController::class, 'index'])->name('admin.datapetugas.index');
            Route::post('/insert', [DatapetugasController::class, 'insert'])->name('admin.datapetugas.insert');
            Route::put('/update', [DatapetugasController::class, 'update'])->name('admin.datapetugas.update');
            Route::delete('/delete', [DatapetugasController::class, 'delete'])->name('admin.datapetugas.delete');
        });
        Route::group(['prefix' => 'laporan'], function(){
            Route::get('/', [LaporanController::class, 'index'])->name('admin.laporan.index');
        });
    });

    Route::group(['roles'=>'ibu'], function (){
        Route::group(['prefix' => 'ibu'], function () {
            Route::get('/dashboard', [IbuDashboardController::class, 'index'])->name('ibu.dashboard');
            Route::get('/profile', [IbuDashboardController::class, 'detail'])->name('ibu.dataibu.detailibu');
            Route::get('/update-profile', [IbuDashboardController::class, 'update'])->name('ibu.dataibu.update');
            Route::post('/update-profile', [IbuDashboardController::class, 'updateprofile'])->name('ibu.dataibu.updateprofile');

            Route::group(['prefix' => 'data-anak'], function () {
                Route::get('/', [IbuDataanakController::class, 'index'])->name('ibu.dataanak.index');
                Route::post('/insert', [IbuDataanakController::class, 'insert'])->name('ibu.dataanak.insert');
                Route::put('/update', [IbuDataanakController::class, 'update'])->name('ibu.dataanak.update');
                Route::get('/detail-anak/{id}', [IbuDataanakController::class, 'getdata'])->name('ibu.dataanak.detailanak');

            });

        });
    });

});
