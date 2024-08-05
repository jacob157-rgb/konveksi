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
use App\Http\Controllers\DetailOprationalController;
use App\Http\Controllers\KainMentahController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ModelJadiController;
use App\Http\Controllers\OperationalController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\WarnaKainController;
use App\Http\Controllers\WarnaModelController;
use App\Http\Middleware\ValidateAuth;

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
    Route::post('/logout', 'logout');
});

Route::middleware(ValidateAuth::class)->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index');
        Route::get('/profil', 'getProfil');
        Route::post('/profil', 'postProfil');
    });
    Route::controller(SupplyerController::class)->group(function () {
        Route::get('/supplyer', 'index');
        Route::post('/supplyer', 'store');
        Route::get('supplyer/detail/{id}', 'detail');
    });

    // Route Crud Karyawan Jahit & Cutting
    Route::controller(KaryawanController::class)->group(function () {
        //karyawan CRUD
        Route::get('karyawan', 'index');
        Route::post('/karyawan', 'store');
        Route::get('/karyawan/edit/{id}', 'edit');
        Route::get('/karyawan/print/{id}', 'print');
        Route::post('/karyawan/update', 'update');
        Route::post('/karyawan/delete/{id}', 'destroy');
    });

    Route::controller(CuttingController::class)->group(function () {
        Route::prefix('karyawan/cutting/ambil')->group(function () {
            Route::get('/{id}', 'getAmbilCutting');
            Route::post('/{id}/store', 'postAmbilCutting');
            Route::get('/get/{id}', 'getResponseCutting');
            Route::put('/update/{id}', 'putCutting');
            Route::get('/detail/{id}', 'detailCutting');
            Route::delete('/delete/{id}', 'deleteCutting');
        });
        Route::prefix('karyawan/cutting/kembali')->group(function () {
            Route::get('/{id}', 'getKembaliCutting');
            Route::post('/{id_karyawan}/{id_warna}/store', 'postKembaliCutting');
            Route::get('/get/{id}', 'getResponseCutting');
            Route::put('/update/{id}', 'putCutting');
            Route::get('/detail/{id}', 'detailCutting');
            Route::delete('/delete/{id}', 'deleteCutting');
        });
    });

    Route::controller(JahitController::class)->group(function () {
        Route::prefix('karyawan/jahit/ambil')->group(function () {
            Route::get('/{id}', 'getAmbilJahit');
            Route::post('/{id}/store', 'postAmbilJahit');
            Route::get('/get/{id}', 'getResponseJahit');
            Route::put('/update/{id}', 'putJahit');
            Route::get('/detail/{id}', 'detailJahit');
            Route::delete('/delete/{id}', 'deleteJahit');
        });
        Route::prefix('karyawan/jahit/kembali')->group(function () {
            Route::get('/{id}', 'getKembaliJahit');
            Route::post('/{id_karyawan}/{id_warna}/store', 'postKembaliJahit');
            Route::get('/get/{id}', 'getResponseJahit');
            Route::put('/update/{id}', 'putJahit');
            Route::get('/detail/{id}', 'detailJahit');
            Route::delete('/delete/{id}', 'deleteJahit');
        });
    });

    // Route::prefix('jahit')->group(function () {
    //     Route::get('/{id}', 'getJahit');
    //     Route::post('/store', 'postJahit');
    //     Route::get('/get/{id}', 'getResponseJahit');
    //     Route::put('/update/{id}', 'putJahit');

    //     //halaman histori pengambilan
    //     Route::get('/detail/{id}', 'detailJahit');
    //     Route::delete('/delete/{id}', 'deleteJahit');
    // });

    Route::controller(BarangController::class)->group(function () {
        Route::prefix('barang')->group(function () {
            // barang mentah store
            Route::get('/mentah/{id}', 'getMentah');
            Route::post('/mentah', 'storeMentah');
            Route::get('/mentah/edit/{id}', 'editResponseMentah');
            Route::put('/mentah/update', 'updateMentah');
            Route::post('/mentah/delete/{id}', 'destroyMentah');

            // barang jadi store
            Route::get('/jadi/{id}', 'getJadi');
            Route::post('/jadi', 'storeJadi');
            Route::get('/jadi/edit/{id}', 'editResponseJadi');
            Route::put('/jadi/update', 'updateJadi');
            Route::post('/jadi/delete/{id}', 'destroyJadi');

            // Route::get('/barang/print/{id}', 'print');

            // kain jadi
            Route::controller(KainMentahController::class)->group(function () {
                Route::get('/mentah/kain/edit/{id}', 'edit');
                Route::put('/mentah/kain/update', 'update');
                Route::post('/mentah/kain/delete/{id}', 'destroy');
            });

            Route::controller(WarnaKainController::class)->group(function () {
                Route::get('/mentah/warna/edit/{id}', 'edit');
                Route::put('/mentah/warna/update', 'update');
                Route::post('/mentah/warna/delete/{id}', 'destroy');
            });

            // Jadi Controller
            Route::controller(ModelJadiController::class)->group(function () {
                Route::get('/jadi/model/edit/{id}', 'edit');
                Route::put('/jadi/model/update', 'update');
                Route::post('/jadi/model/delete/{id}', 'destroy');
            });

            Route::controller(WarnaModelController::class)->group(function () {
                Route::get('/jadi/warna/edit/{id}', 'edit');
                Route::put('/jadi/warna/update', 'update');
                Route::post('/jadi/warna/delete/{id}', 'destroy');
            });
        });
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

    Route::controller(OperationalController::class)->group(function () {
        Route::prefix('operational')->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/edit/{id}', 'edit');
            Route::post('/update', 'update');
            Route::post('/delete/{id}', 'destroy');

            Route::controller(DetailOprationalController::class)->group(function () {
                Route::prefix('pemakaian')->group(function () {
                    Route::get('/{id_operational}', 'index');
                    Route::post('/store/{id_operational}', 'store');
                    Route::get('/edit/{id_pemakaian}', 'edit');
                    Route::post('/update', 'update');
                    Route::post('/delete/{id_pemakaian}', 'destroy');
                });
            });
        });
    });
});
