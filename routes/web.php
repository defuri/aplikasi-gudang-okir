<?php

use App\Http\Controllers\PesananController;
use App\Http\Controllers\suplier;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hakController;
use App\Http\Controllers\akunController;
use App\Http\Controllers\packController;
use App\Http\Controllers\rasaController;
use App\Http\Controllers\stokController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\divisiController;
use App\Http\Controllers\gudangController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\satuanController;
use App\Http\Controllers\jabatanController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\bahanBakuController;
use App\Http\Controllers\ngetes;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\penjualanController;
use App\Http\Controllers\penggajianController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\ProdukKeluarController;
use App\Http\Controllers\ProdukMasukController;
use App\Http\Controllers\RiwayatPengirimanController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\transaksiBahanBakuController;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/login/auth', [loginController::class, 'authenticate']);
Route::post('/logout', [loginController::class, 'logout']);

// * owner

Route::get('/owner', function () {
    return view('owner.dashboard');
});

Route::get('/results', [SearchController::class, 'index'])->name('search');
Route::resource('/admin/satuan', satuanController::class);
Route::resource('/owner/suplier', suplier::class);
Route::resource('/owner/bahanBaku', bahanBakuController::class);
Route::resource('/owner/transaksiBahanBaku', transaksiBahanBakuController::class);
Route::post('/cetakTransaksiBahanBaku', [transaksiBahanBakuController::class, 'cetak']);
Route::resource('/owner/rasa', rasaController::class);
Route::resource('/owner/kategori', kategoriController::class);
Route::resource('/owner/pack', packController::class);
Route::resource('/owner/produk', produkController::class);
Route::resource('/owner/gudang', gudangController::class);
Route::resource('/owner/stok', stokController::class);
Route::resource('/owner/penjualan', penjualanController::class);
Route::resource('/owner/divisi', divisiController::class);
Route::resource('/owner/jabatan', jabatanController::class);
Route::resource('/owner/karyawan', karyawanController::class);
Route::resource('/owner/penggajian', penggajianController::class);
Route::resource('/owner/hak', hakController::class);
Route::resource('/owner/akun', akunController::class);
Route::resource('/owner/ProdukMasuk', ProdukMasukController::class);
Route::resource('/owner/ProdukKeluar', ProdukKeluarController::class);
Route::resource('/owner/pelanggan', PelangganController::class);
Route::resource('/owner/pesanan', PesananController::class);
Route::resource('/owner/pengiriman', PengirimanController::class);
Route::resource('/owner/riwayat-pengiriman', RiwayatPengirimanController::class);
Route::post('/owner/riwayat-pengiriman/{id}/selesai', [RiwayatPengirimanController::class, 'selesai']);

Route::get('/gudang', function () {
    return view('gudang.index');
});

Route::resource('/gudang/info', gudangController::class);
Route::resource('/gudang/stok', stokController::class);
Route::resource('/gudang/ProdukMasuk', ProdukMasukController::class);
Route::resource('/gudang/ProdukKeluar', ProdukKeluarController::class);

Route::get('/produksi', function () {
    return view('produksi.index');
});

Route::resource('/produksi/satuan', satuanController::class);
Route::resource('/produksi/suplier', suplier::class);
Route::resource('/produksi/bahanBaku', bahanBakuController::class);
Route::resource('/produksi/transaksiBahanBaku', transaksiBahanBakuController::class);
Route::resource('/produksi/rasa', rasaController::class);
Route::resource('/produksi/kategori', kategoriController::class);
Route::resource('/produksi/pack', packController::class);
Route::resource('/produksi/produk', produkController::class);

Route::get('/lapangan', function () {
    return view('lapangan.index');
});

// * ajax
Route::get('/get-products', [produkController::class, 'getProducts']);

Route::resource('/tes', ngetes::class);
