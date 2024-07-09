<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KainController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\SupplyerController;
use App\Http\Controllers\WarnaController;
use App\Http\Controllers\Auth\AuthController;

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
