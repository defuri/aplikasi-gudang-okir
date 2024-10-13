<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\suplier;
use App\Models\hakModel;
use App\Models\akunModel;
use App\Models\packModel;
use App\Models\pelanggan;
use App\Models\rasaModel;
use App\Models\stokModel;
use App\Models\Pengiriman;
use App\Models\divisiModel;
use App\Models\gudangModel;
use App\Models\produkModel;
use App\Models\satuanModel;
use App\Models\jabatanModel;
use Illuminate\Http\Request;
use App\Models\DetailPesanan;
use App\Models\karyawanModel;
use App\Models\kategoriModel;
use App\Models\bahanBakuModel;
use App\Models\penjualanModel;
use App\Models\penggajianModel;
use App\Models\ProdukMasukModel;
use App\Models\ProdukKeluarModel;
use App\Models\RiwayatPengiriman;
use App\Models\transaksiBahanBakuModel;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        try {
            $request->validate([
                'cari' => 'string|nullable',
                'tabel' => 'string|required',
            ]);

            $query = $request->cari;
            $satuan = satuanModel::all();
            $pack = packModel::all();
            $gudang = gudangModel::all();
            $produk = produkModel::all();
            $pelanggan = pelanggan::all();

            switch ($request->tabel) {
                case 'satuan':
                    $dataSatuan = satuanModel::where('nama', 'LIKE', "%{$query}%")->orderBy('id')->paginate(10);
                    return view('owner.satuan', compact('query', 'dataSatuan'));

                case 'suplier':
                    $suplier = suplier::where('nama', 'LIKE', "%{$query}%")->orderBy('id')->paginate(10);
                    return view('owner.suplier', compact('query', 'suplier'));

                case 'bahanBaku':
                    $bahanBaku = bahanBakuModel::where('nama', 'LIKE', "%{$query}%")->orderBy('id')->paginate(10);
                    $suppliers = suplier::get();
                    return view('owner.bahanBaku', compact('query', 'bahanBaku', 'suppliers'));

                case 'transaksiBahanBaku':
                    $IDbahanBaku = bahanBakuModel::where('nama', 'LIKE', "%{$query}%")->first()->id;
                    $transaksiBahanBaku = transaksiBahanBakuModel::where('id_bahan_baku', $IDbahanBaku)->orderBy('id')->paginate(10);
                    $total = $transaksiBahanBaku->total();
                    $bahanBaku = bahanBakuModel::all();

                    if ($query == null) {
                        $transaksiBahanBaku = transaksiBahanBakuModel::orderBy('id')->paginate(10);

                        return view('owner.transaksiBahanBaku', compact('transaksiBahanBaku', 'total', 'bahanBaku', 'satuan'));
                    }

                    return view('owner.transaksiBahanBaku', compact('query', 'bahanBaku', 'transaksiBahanBaku', 'total', 'satuan'));

                case 'rasa':
                    $rasa = rasaModel::where('nama', 'LIKE', "%{$query}%")->orderBy('id')->paginate(10);
                    return view('owner.rasa', compact('query', 'rasa'));

                case 'kategori':
                    $kategori = kategoriModel::where('nama', 'LIKE', "%{$query}%")->orderBy('id')->paginate(10);
                    return view('owner.kategori', compact('query', 'kategori'));

                case 'pack':
                    $pack = packModel::where('nama', 'LIKE', "%{$query}%")->orderBy('id')->paginate(10);

                    return view('owner.pack', compact('query', 'pack', 'satuan'));

                case 'produk':
                    $produk = produkModel::where('nama', 'LIKE', "%{$query}%")->orderBy('id')->paginate(10);
                    $rasa = rasaModel::all();
                    $kategori = kategoriModel::all();
                    $total = $produk->total();

                    return view('owner.produk', compact('query', 'pack', 'kategori', 'rasa', 'produk', 'satuan', 'total'));

                case 'stok':
                    $gudang = gudangModel::where('nama', 'LIKE', "%{$query}%")->first()->id;
                    $stok = stokModel::where('id_gudang',  "{$gudang}")->orderBy('id')->paginate(10);

                    return view('owner.stok', compact('query', 'stok', 'satuan', 'pack'));

                case 'produkMasuk':
                    $IDproduk = produkModel::where('nama', 'LIKE', "%{$query}%")->first()->id;
                    $ProdukMasuk = ProdukMasukModel::where('id_produk',  "{$IDproduk}")->orderBy('id')->paginate(10);

                    if ($query == null) {
                        $ProdukMasuk = ProdukMasukModel::orderBy('id')->paginate(10);

                        return view('owner.produkMasuk', compact('ProdukMasuk', 'gudang', 'produk'));
                    }

                    return view('owner.produkMasuk', compact('query', 'IDproduk', 'ProdukMasuk', 'gudang', 'produk'));

                case 'produkKeluar':
                    $gudang = gudangModel::all();
                    $produk = produkModel::all();
                    $IDproduk = produkModel::where('nama', 'LIKE', "%{$query}%")->first()->id;
                    $ProdukKeluar = ProdukKeluarModel::where('id_produk', $IDproduk)->orderBy('id')->paginate(10);

                    if ($query == null) {
                        $ProdukKeluar = ProdukKeluarModel::orderBy('id')->paginate(10);

                        return view('owner.ProdukKeluar', compact('ProdukKeluar', 'gudang', 'produk'));
                    }

                    return view('owner.ProdukKeluar', compact('ProdukKeluar', 'gudang', 'produk', 'query'));

                case 'gudang':
                    $gudang = gudangModel::where('nama', 'LIKE', "%{$query}%")->orderBy('id')->paginate(10);

                    return view('owner.gudang', compact('query', 'gudang'));

                case 'pesanan':
                    // Mencari pelanggan berdasarkan nama
                    $pelanggan = pelanggan::where('nama', 'LIKE', "%{$query}%")->first();

                    if ($pelanggan == null) {
                        $DetailPesanan = collect(); // Data kosong
                        $pesanan = collect(); // Data kosong untuk pesanan juga
                        $produk = produkModel::all();
                        $pelanggan = pelanggan::all();

                        // Membuat pagination manual dengan data kosong
                        $perPage = 10;
                        $page = request()->get('page', 1); // Mendapatkan halaman saat ini, default halaman 1
                        $DetailPesananPaginated = $DetailPesanan->forPage($page, $perPage);

                        $DetailPesanan = new \Illuminate\Pagination\LengthAwarePaginator(
                            $DetailPesananPaginated,
                            $DetailPesanan->count(),
                            $perPage,
                            $page,
                            ['path' => request()->url(), 'query' => request()->query()]
                        );

                        return view('owner.pesanan', compact('query', 'DetailPesanan', 'pesanan', 'pelanggan', 'produk'))
                            ->with('error', 'Pelanggan tidak ditemukan.');
                    }

                    // Jika query tidak ada, ambil semua detail pesanan dengan pagination
                    if ($query == null) {
                        $pesanan = Pesanan::with('pelanggan')->get();
                        $produk = produkModel::all();
                        $DetailPesanan = DetailPesanan::orderBy('pesanan_id', 'desc')->paginate(10);
                        $pelanggan = pelanggan::all();

                        return view('owner.pesanan', compact('pesanan', 'pelanggan', 'produk', 'DetailPesanan'));
                    }

                    if ($pelanggan) {
                        $IDPelanggan = $pelanggan->id;

                        // Mengambil semua pesanan milik pelanggan
                        $pesanan = Pesanan::where('pelanggan_id', $IDPelanggan)->get();

                        // Menyiapkan collection untuk menampung detail pesanan
                        $DetailPesanan = collect();

                        // Loop untuk mengambil detail pesanan dari setiap pesanan
                        foreach ($pesanan as $currentPesanan) {
                            $detail = DetailPesanan::where('pesanan_id', $currentPesanan->id)->get();
                            // Menggabungkan detail pesanan ke dalam collection
                            $DetailPesanan = $DetailPesanan->merge($detail);
                        }

                        // Mengurutkan hasil berdasarkan ID secara descending
                        $DetailPesanan = $DetailPesanan->sortByDesc('id');

                        // Melakukan pagination manual
                        $perPage = 10;
                        $page = request()->get('page', 1); // Mendapatkan halaman saat ini, default halaman 1
                        $DetailPesananPaginated = $DetailPesanan->forPage($page, $perPage);

                        // Membuat LengthAwarePaginator untuk pagination manual
                        $DetailPesanan = new \Illuminate\Pagination\LengthAwarePaginator(
                            $DetailPesananPaginated,
                            $DetailPesanan->count(),
                            $perPage,
                            $page,
                            ['path' => request()->url(), 'query' => request()->query()]
                        );

                        $pelanggan = pelanggan::all();
                        $produk = produkModel::all();

                        // Mengembalikan view dengan data yang dikompak
                        return view('owner.pesanan', compact('query', 'DetailPesanan', 'pelanggan', 'produk', 'pesanan'));
                    }

                    $pesanan = Pesanan::with('pelanggan')->get();
                    $produk = produkModel::all();
                    $DetailPesanan = DetailPesanan::orderBy('pesanan_id', 'desc')->paginate(10);
                    $pelanggan = pelanggan::all();

                    // Jika pelanggan tidak ditemukan
                    return view('owner.pesanan', compact('query', 'pelanggan', 'produk', 'DetailPesanan', 'pesanan'))->with('error', 'Pelanggan tidak ditemukan.');

                case 'pelanggan':
                    $pelanggan = pelanggan::where('nama', 'LIKE', "%{$query}%")->orderBy('id')->paginate(10);

                    return view('owner.pelanggan', compact('query', 'pelanggan'));

                case 'penjualan':
                    // * variabel awal
                    $produk = produkModel::all();
                    $penjualan = penjualanModel::orderBy('id', 'desc')->paginate(10);

                    if ($query == null) {
                        return view('owner.penjualan', compact('penjualan', 'produk'));
                    }

                    $produkCari = produkModel::where('nama', 'LIKE', "%{$query}%")->first();

                    if ($produkCari) {
                        $IDProduk = $produkCari->id;
                        $penjualan = penjualanModel::where('id_produk', $IDProduk)->orderBy('id', 'desc')->paginate(10);
                    } else {
                        $penjualan = new LengthAwarePaginator([], 0, 10);
                    }

                    return view('owner.penjualan', compact('query', 'penjualan', 'produk'));

                case 'pengiriman':
                    $pengirimanIDs = Pengiriman::pluck('pesanan_id')->toArray();
                    $pesanans = Pesanan::whereNotIn('id', $pengirimanIDs)->orderBy('id', 'desc')->get();

                    $pengirimans = pengiriman::where('pesanan_id', 'LIKE', "%$query%")->orderBy('id', 'desc')->paginate(10);

                    return view('owner.pengiriman', compact('pengirimans', 'pesanans', 'query'));

                case 'riwayatPengiriman':
                    $riwayatPengiriman = RiwayatPengiriman::where('pengiriman_id', 'LIKE', "%$query%")->orderBy('id', 'desc')->paginate(10);

                    return view('owner.riwayat_pengiriman', compact('riwayatPengiriman', 'query'));

                case 'divisi':
                    $divisi = divisiModel::where('nama', 'LIKE', "%{$query}")->orderBy('id', 'asc')->paginate(10);

                    return view('owner.divisi', compact('divisi', 'query'));

                case 'jabatan':
                    $jabatan = jabatanModel::where('nama', 'LIKE', "%{$query}%")->orderBy('id', 'asc')->paginate(10);

                    return view('owner.jabatan', compact('jabatan', 'query'));

                case 'karyawan':
                    $jabatan = jabatanModel::all();
                    $divisi = divisiModel::all();
                    $karyawan = karyawanModel::where('nama', 'LIKE', "%{$query}%")->orderBy('id', 'asc')->paginate(10);

                    return view('owner.karyawan', compact('jabatan', 'divisi', 'karyawan', 'query'));

                case 'penggajian':
                    if ($query == null) {

                        $karyawan = karyawanModel::all();
                        $jabatan = jabatanModel::all();
                        $penggajian = penggajianModel::orderBy('id')->paginate(10);

                        return view('owner.penggajian', compact('karyawan', 'jabatan', 'penggajian', 'query'));
                    }

                    $IDKaryawan = karyawanModel::where('nama', 'LIKE', "%{$query}%")->first()->id;
                    $karyawan = karyawanModel::where('id', $IDKaryawan)->first()->paginate(10);
                    $jabatan = jabatanModel::all();
                    $penggajian = penggajianModel::where('id_karyawan', $IDKaryawan)->orderBy('id')->paginate(10);

                    return view('owner.penggajian', compact('karyawan', 'jabatan', 'penggajian', 'query'));

                case 'akun':
                    $akun = akunModel::where('username', 'LIKE', "%{$query}")->orderBy('id', 'desc')->paginate(10);
                    $hak = hakModel::all();

                    return view('owner.akun', compact('akun', 'hak', 'query'));

                case 'hak':
                    $hak = hakModel::where('nama', 'LIKE', "%{$query}%")->orderBy('id')->paginate(10);

                    return view('owner.hak', compact('hak', 'query'));

                default:
                    return back()->with('error', 'Terjadi kesalahan: Gagal mencari, silahkan coba lagi');
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
