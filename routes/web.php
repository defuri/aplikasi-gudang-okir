<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\suplier;
use App\Http\Middleware\CheckAdminGudang;
use App\Http\Middleware\CheckAdminProduksi;
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckOwner;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hakController;
use App\Http\Controllers\akunController;
use App\Http\Controllers\packController;
use App\Http\Controllers\rasaController;
use App\Http\Controllers\stokController;
use App\Http\Controllers\loginController;
// use App\Http\Controllers\divisiController;
use App\Http\Controllers\gudangController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\satuanController;
// use App\Http\Controllers\jabatanController;
// use App\Http\Controllers\karyawanController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\bahanBakuController;
// use App\Http\Controllers\CreateTransaksiBahanBakuController;
use App\Http\Controllers\ngetes;
// use App\Http\Controllers\PelangganController;
// use App\Http\Controllers\penjualanController;
// use App\Http\Controllers\penggajianController;
// use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\ProdukKeluarController;
use App\Http\Controllers\ProdukMasukController;
use App\Http\Controllers\ProduksiController;
// use App\Http\Controllers\RiwayatPengirimanController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\transaksiBahanBakuController;
use App\Http\Middleware\ResetSessionTimeout;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/login/auth', [loginController::class, 'authenticate']);
Route::post('/logout', [loginController::class, 'logout']);
Route::get('/results', [SearchController::class, 'index'])->name('search');

// API
Route::group(['middleware' => CheckLoginMiddleware::class], function () {
    Route::get('/get-products', [produkController::class, 'getProducts']);
    Route::get('/api/bahan-baku', [bahanBakuController::class, 'get']);
    Route::get('/get-gudang', [gudangController::class, 'getGudang']);
    Route::get('/get-stok-{idGudang}-{rentang}', [stokController::class, 'getStok']);
    Route::get('/get-produk-masuk/{rentang}/{idGudang}/{produkId}', [ProdukMasukController::class, 'getProdukMasuk']);
    Route::get('/get-produk-keluar/{rentang}/{idGudang}/{produkId}', [ProdukKeluarController::class, 'getProdukKeluar']);
});

// index
Route::get('/owner', [OwnerController::class, 'index'])->middleware([ResetSessionTimeout::class, CheckOwner::class])->name('ownerHome');
Route::get('/produksi', [ProduksiController::class, 'index'])->middleware([ResetSessionTimeout::class, CheckAdminProduksi::class])->name('produksiHome');
Route::get('/gudang-home', [gudangController::class, 'dashboard'])->middleware([ResetSessionTimeout::class, CheckAdminGudang::class])->name('gudangHome');

Route::middleware([CheckLoginMiddleware::class, ResetSessionTimeout::class])->group(function () {
    Route::resource('/activity', ActivityController::class);
    Route::resource('/satuan', satuanController::class);
    Route::resource('/suplier', suplier::class);
    Route::resource('/bahan-baku', bahanBakuController::class);
    Route::resource('/transaksi-bahan-baku', transaksiBahanBakuController::class);
    Route::get('/create-transaksi-bahan-baku', [transaksiBahanBakuController::class, 'create']);
    Route::post('/cetak-transaksi-bahan-baku', [transaksiBahanBakuController::class, 'cetak']);
    Route::resource('/rasa', rasaController::class);
    Route::resource('/kategori', kategoriController::class);
    Route::resource('/pack', packController::class);
    Route::resource('/produk', produkController::class);
    Route::resource('/gudang', gudangController::class);
    Route::resource('/produk-masuk', ProdukMasukController::class);
    Route::post('/cetak-produk-masuk', [ProdukMasukController::class, 'cetak']);
    Route::resource('/produk-keluar', ProdukKeluarController::class);
    Route::post('/cetak-produk-keluar', [ProdukKeluarController::class, 'cetak']);
    Route::resource('/stok', stokController::class);
    Route::post('cetak-stok', [stokController::class, 'cetak']);
    Route::resource('/hak', hakController::class);
    Route::resource('/akun', akunController::class);
});

