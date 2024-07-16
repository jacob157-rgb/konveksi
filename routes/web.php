<?php

use App\Http\Controllers\JahitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KainController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\SupplyerController;
use App\Http\Controllers\WarnaController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CuttingController;
use App\Http\Controllers\KaryawanController;

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

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index');
});
Route::controller(SupplyerController::class)->group(function () {
    Route::get('/supplyer', 'index');
    Route::post('/supplyer', 'store');
    Route::get('/supplyer/edit/{id}', 'edit');
    Route::post('/supplyer/update', 'update');
    Route::post('/supplyer/delete/{id}', 'destroy');
});
Route::controller(KainController::class)->group(function () {
    Route::get('/kain', 'index');
    Route::post('/kain', 'store');
    Route::get('/kain/edit/{id}', 'edit');
    Route::post('/kain/update', 'update');
    Route::post('/kain/delete/{id}', 'destroy');
});
Route::controller(ModelController::class)->group(function () {
    Route::get('/model', 'index');
    Route::post('/model', 'store');
    Route::get('/model/edit/{id}', 'edit');
    Route::post('/model/update', 'update');
    Route::post('/model/delete/{id}', 'destroy');
});
Route::controller(WarnaController::class)->group(function () {
    Route::get('/warna', 'index');
    Route::post('/warna', 'store');
    Route::get('/warna/edit/{id}', 'edit');
    Route::post('/warna/update', 'update');
    Route::post('/warna/delete/{id}', 'destroy');
});
Route::controller(KaryawanController::class)->group(function () {
    Route::get('/karyawan', 'index');
    Route::post('/karyawan', 'store');
    Route::get('/karyawan/edit/{id}', 'edit');
    Route::post('/karyawan/update', 'update');
    Route::post('/karyawan/delete/{id}', 'destroy');
});
Route::controller(BarangController::class)->group(function () {
    Route::get('/barang', 'index');
    Route::post('/barang', 'store');
    Route::get('/barang/create', 'create');
    Route::get('/barang/edit/{id}', 'edit');
    Route::get('/barang/show/{id}', 'show');
    Route::post('/barang/update/{id}', 'update');

    Route::post('/barang/selesai/{id}', 'selesai');

    //pengembalian
    Route::get('/barang/pengembalian/cutting/detail/{id_barang}/{id_cutting}', 'getDetailPengembalianCutting');
    Route::get('/barang/pengembalian/cutting/{id_barang}/{id_cutting}', 'getPengembalianCutting');
    Route::post('/barang/pengembalian/cutting/update/{id_barang}/{id_cutting}', 'postPengembalianCutting');

    Route::get('/barang/pengembalian/jahit/detail/{id_barang}/{id_jahit}', 'getDetailPengembalianJahit');
    Route::get('/barang/pengembalian/jahit/{id_barang}/{id_jahit}', 'getPengembalianJahit');
    Route::post('/barang/pengembalian/jahit/update/{id_barang}/{id_jahit}', 'postPengembalianJahit');

    Route::post('/barang/delete/{id}', 'destroy');
});
Route::controller(CuttingController::class)->group(function () {
    Route::get('/cutting', 'index');
    Route::get('/cutting/create/{id}', 'create');
    Route::post('/cutting', 'store');
    Route::post('/cutting/delete/{id}', 'destroy');
});
Route::controller(JahitController::class)->group(function () {
    Route::get('/jahit', 'index');
    Route::get('/jahit/create/{id}', 'create');
    Route::post('/jahit', 'store');
    Route::post('/jahit/delete/{id}', 'destroy');
});
