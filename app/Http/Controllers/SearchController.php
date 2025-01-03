<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use App\Models\transaksiBahanBakuModel;
use App\Models\DetailTransaksiBahanBaku;
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

            $user = Auth::user();
            $query = $request->cari;
            $satuan = satuanModel::all();
            $pack = packModel::all();
            $gudang = gudangModel::all();
            $produk = produkModel::all();
            $pelanggan = pelanggan::all();

            if (!$user) {
                return redirect('/login')->with('error', 'Anda tidak mempunyai akses untuk halaman ini');
            }

            switch ($request->tabel) {
                case 'satuan':
                    $dataSatuan = satuanModel::where('nama', 'LIKE', "%{$query}%")->orderByDesc('id')->paginate(10);
                    return view('CRUD.satuan', compact('query', 'dataSatuan', 'user'));

                case 'suplier':
                    $suplier = suplier::where('nama', 'LIKE', "%{$query}%")->orderByDesc('id')->paginate(10);
                    return view('CRUD.suplier', compact('query', 'suplier', 'user'));

                case 'bahanBaku':
                    $bahanBaku = bahanBakuModel::where('nama', 'LIKE', "%{$query}%")->orderByDesc('id')->paginate(10);
                    $suppliers = suplier::get();

                    return view('CRUD.bahanBaku', compact('query', 'bahanBaku', 'suppliers', 'user'));

                case 'transaksiBahanBaku':
                    $dariTanggal = $request->dariTanggal ?: null;
                    $keTanggal = $request->keTanggal ?: null;

                    if ($dariTanggal && $keTanggal) {
                        $dariTanggalFormatted = Carbon::createFromFormat('m/d/Y', $dariTanggal)->format('Y-m-d');
                        $keTanggalFormatted = Carbon::createFromFormat('m/d/Y', $keTanggal)->format('Y-m-d');

                        $transaksiBahanBaku = transaksiBahanBakuModel::whereBetween('tanggal', [$dariTanggalFormatted, $keTanggalFormatted])
                            ->orderBy('id', 'desc')
                            ->paginate(10);
                    } else {
                        $transaksiBahanBaku = transaksiBahanBakuModel::orderBy('id', 'desc')->paginate(10);
                    }

                    $detailTransaksiBahanBaku = DetailTransaksiBahanBaku::all();
                    $bahanBaku = bahanBakuModel::all();
                    $satuan = satuanModel::all();

                    return view('CRUD.transaksiBahanBaku', compact('transaksiBahanBaku', 'detailTransaksiBahanBaku', 'bahanBaku', 'satuan', 'user', 'dariTanggal', 'keTanggal'));

                case 'rasa':
                    $rasa = rasaModel::where('nama', 'LIKE', "%{$query}%")->orderByDesc('id')->paginate(10);
                    return view('CRUD.rasa', compact('query', 'rasa', 'user'));

                case 'kategori':
                    $kategori = kategoriModel::where('nama', 'LIKE', "%{$query}%")->orderByDesc('id')->paginate(10);
                    return view('CRUD.kategori', compact('query', 'kategori', 'user'));

                case 'pack':
                    $pack = packModel::where('nama', 'LIKE', "%{$query}%")->orderByDesc('id')->paginate(10);

                    return view('CRUD.pack', compact('query', 'pack', 'satuan', 'user'));

                case 'produk':
                    $produk = produkModel::where('nama', 'LIKE', "%{$query}%")->orderByDesc('id')->paginate(10);
                    $rasa = rasaModel::all();
                    $kategori = kategoriModel::all();
                    $total = $produk->total();

                    return view('CRUD.produk', compact('query', 'pack', 'kategori', 'rasa', 'produk', 'satuan', 'total', 'user'));

                case 'stok':
                    try {
                        if (!empty($query)) {
                            // Jika ada input pencarian
                            $gudang = gudangModel::where('nama', 'LIKE', "%{$query}%")->paginate(10);

                            if ($gudang->isNotEmpty()) {
                                // Ambil stok untuk semua gudang yang ditemukan
                                $allResults = stokModel::whereIn('id_gudang', $gudang->pluck('id'))->get();
                                $hasEmptyStock = $allResults->where('stok', 0)->count() > 0;

                                $stokQuery = stokModel::whereIn('id_gudang', $gudang->pluck('id'));

                                if (!request()->has('show_empty')) {
                                    $stokQuery->where('stok', '>', 0);
                                }

                                $stok = $stokQuery->orderBy('id', 'desc')->paginate(10);
                            } else {
                                // Jika tidak ada gudang yang ditemukan
                                $stok = collect([])->paginate(10);
                            }
                        } else {
                            // Jika query kosong, tampilkan semua stok tanpa filter nama gudang
                            $stokQuery = stokModel::query();

                            if (!request()->has('show_empty')) {
                                $stokQuery->where('stok', '>', 0);
                            }

                            $stok = $stokQuery->orderBy('id', 'desc')->paginate(10);
                            $hasEmptyStock = $stok->where('stok', 0)->count() > 0;
                        }

                        return view('CRUD.stok', [
                            'query' => $query,
                            'stok' => $stok,
                            'satuan' => $satuan ?? null,
                            'pack' => $pack ?? null,
                            'user' => $user,
                            'hasEmptyStock' => $hasEmptyStock ?? false
                        ]);
                    } catch (\Exception $e) {
                        // Handle any errors
                        $stok = collect([])->paginate(10);
                        return view('CRUD.stok', [
                            'query' => $query,
                            'stok' => $stok,
                            'satuan' => $satuan ?? null,
                            'pack' => $pack ?? null,
                            'user' => $user,
                            'hasEmptyStock' => false
                        ]);
                    }

                case 'produkMasuk':
                    $dariTanggal = $request->dariTanggal;
                    $keTanggal = $request->keTanggal;
                    $user = Auth::user();
                    $query = ProdukMasukModel::query();
                    $gudang = gudangModel::all();
                    $produk = produkModel::all();

                    if ($dariTanggal && $keTanggal) {
                        $dariTanggalFormatted = Carbon::createFromFormat('m/d/Y', $dariTanggal)->startOfDay();
                        $keTanggalFormatted = Carbon::createFromFormat('m/d/Y', $keTanggal)->endOfDay();

                        $query->whereBetween('created_at', [
                            $dariTanggalFormatted,
                            $keTanggalFormatted
                        ]);
                    }

                    $ProdukMasuk = $query->orderBy('id', 'desc')->paginate(10);

                    return view('CRUD.ProdukMasuk', compact('ProdukMasuk', 'dariTanggal', 'keTanggal', 'user', 'gudang', 'produk'));


                case 'produkKeluar':
                    $dariTanggal = $request->dariTanggal;
                    $keTanggal = $request->keTanggal;
                    $user = Auth::user();
                    $query = ProdukKeluarModel::query();
                    $gudang = gudangModel::all();
                    $produk = produkModel::all();

                    if ($dariTanggal && $keTanggal) {
                        $dariTanggalFormatted = Carbon::createFromFormat('m/d/Y', $dariTanggal)->startOfDay();
                        $keTanggalFormatted = Carbon::createFromFormat('m/d/Y', $keTanggal)->endOfDay();

                        $query->whereBetween('created_at', [
                            $dariTanggalFormatted,
                            $keTanggalFormatted
                        ]);
                    }

                    $ProdukKeluar = $query->orderBy('id', 'desc')->paginate(10);

                    return view('CRUD.ProdukKeluar', compact('ProdukKeluar', 'dariTanggal', 'keTanggal', 'user', 'gudang', 'produk'));


                case 'gudang':
                    $gudang = gudangModel::where('nama', 'LIKE', "%{$query}%")->orderByDesc('id')->paginate(10);

                    return view('CRUD.gudang', compact('query', 'user', 'gudang'));

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

                        $DetailPesanan = new LengthAwarePaginator(
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
                        $DetailPesanan = new LengthAwarePaginator(
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

                    return view('CRUD.akun', compact('akun', 'hak', 'query'));

                case 'hak':
                    $hak = hakModel::where('nama', 'LIKE', "%{$query}%")->orderBy('id')->paginate(10);

                    return view('crud.hak', compact('hak', 'query'));

                case 'activityOwner':
                    $user = Auth::user();

                    if ($user->id_hak === 1) {
                        $activity = Activity::with('causer')->where('log_name', 'LIKE', "%{$query}%")->orderByDesc('id')->paginate(10);
                    } else if ($user->id_hak === 2) {
                        $logNames = ['Satuan', 'Suplier', 'Bahan Baku', 'Transaksi Bahan Baku', 'Rasa', 'Kategori', 'Pack', 'Produk'];
                        $activity = Activity::with('causer')->whereIn('log_name', $logNames)->where('log_name', 'LIKE', "%{$query}%")->orderByDesc('id')->paginate(10);
                    } else {
                        $logNames = ['Gudang', 'Produk masuk', 'Produk Keluar', 'Stok'];
                        $activity = Activity::with('causer')->whereIn('log_name', $logNames)->where('log_name', 'LIKE', "%{$query}%")->orderByDesc('id')->paginate(10);
                    }

                    return view('owner.activity', compact('activity', 'user'));

                default:
                    return back()->with('error', 'Terjadi kesalahan: Gagal mencari, silahkan coba lagi');
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
