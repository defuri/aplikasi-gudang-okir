<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\stokModel;
use App\Models\gudangModel;
use App\Models\produkModel;
use Illuminate\Http\Request;
use App\Models\ProdukMasukModel;
use Illuminate\Support\Facades\Auth;

class ProdukMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ProdukMasuk = ProdukMasukModel::orderBy('id', 'desc')->paginate(10);
        $gudang = gudangModel::all();
        $produk = produkModel::all();
        $user = Auth::user();

        return view('CRUD.produkMasuk', compact('ProdukMasuk', 'gudang', 'produk', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id_gudang = $request->id_gudang;
        $produk = produkModel::all();
        $gudang = gudangModel::all();
        $user = Auth::user();

        $ProdukMasuk = ProdukMasukModel::orderBy('id', 'desc')->paginate(10);

        $nama_gudang = null;
        if ($id_gudang) {
            $nama_gudang = gudangModel::find($id_gudang)->nama ?? null;
        }

        return view('CRUD.create-produk-masuk', compact('id_gudang', 'nama_gudang', 'produk', 'gudang', 'user', 'ProdukMasuk'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_gudang' => ['required', 'integer'],
                'produk_id.*' => ['required', 'integer'],
                'jumlah.*' => ['required', 'integer'],
            ]);

            // Pastikan array produk_id dan jumlah memiliki panjang yang sama
            if (count($request->produk_id) != count($request->jumlah)) {
                throw new \Exception('Data produk dan jumlah tidak sesuai');
            }

            // Loop through setiap produk
            foreach ($request->produk_id as $key => $produkId) {
                $jumlah = $request->jumlah[$key];

                // Cek dan update atau create stok
                $stokExists = StokModel::where('id_gudang', $request->id_gudang)
                    ->where('id_produk', $produkId)
                    ->exists();

                if ($stokExists) {
                    StokModel::where('id_gudang', $request->id_gudang)
                        ->where('id_produk', $produkId)
                        ->increment('stok', $jumlah);
                } else {
                    StokModel::create([
                        'id_gudang' => $request->id_gudang,
                        'id_produk' => $produkId,
                        'stok' => $jumlah,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // Create record produk masuk
                $data = ProdukMasukModel::create([
                    'id_gudang' => $request->id_gudang,
                    'id_produk' => $produkId,
                    'jumlah' => $jumlah,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Update timestamp
                StokModel::where('id_gudang', $request->id_gudang)
                    ->where('id_produk', $produkId)
                    ->update(['updated_at' => now()]);


                activity()
                    ->causedBy(Auth::user()) // Menyertakan informasi pengguna yang melakukan tindakan
                    ->useLog('Produk Masuk')
                    ->log('INSERT ID: ' . $data->id);
            }

            return redirect()->route('produk-masuk.index')->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Exception $e) {
            return redirect()->route('produk-masuk.index')->with('error', 'Data gagal disimpan: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'id_gudang' => ['required', 'integer'],
                'id_produk' => ['required', 'integer'],
                'jumlah' => ['required', 'integer'],
            ]);

            // * cari data produk masuk yang mau diedit
            $data = ProdukMasukModel::findOrFail($id);

            // * jika id_produk atau id_gudang berubah, kurangi stok lama
            if ($data->id_gudang != $request->id_gudang || $data->id_produk != $request->id_produk) {
                StokModel::where('id_gudang', $data->id_gudang)
                    ->where('id_produk', $data->id_produk)
                    ->decrement('stok', $data->jumlah);
            }

            // * tambahkan stok baru sesuai dengan data yang diinputkan
            StokModel::where('id_gudang', $request->id_gudang)
                ->where('id_produk', $request->id_produk)
                ->increment('stok', $request->jumlah);

            // * update data updated_at di tabel stok
            StokModel::where('id_gudang', $request->id_gudang)
                ->where('id_produk', $request->id_produk)
                ->update(['updated_at' => now()]);

            // * update semua data di ProdukMasukModel
            $data->update([
                'id_gudang' => $request->id_gudang,
                'id_produk' => $request->id_produk,
                'jumlah' => $request->jumlah,
                'updated_at' => now(),
            ]);

            activity()
                ->useLog('Produk Masuk')
                ->log('UPDATE: ' . $data->id);

            return redirect()->route('produk-masuk.index')->with(['success' => 'Data berhasil dirubah!']);
        } catch (\Exception $e) {
            return redirect()->route('produk-masuk.index')->with('error', 'Data gagal dirubah: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = ProdukMasukModel::findOrFail($id);

            // * kurangi data dengan data yang mau dihapus
            StokModel::where('id_gudang', $data->id_gudang)
                ->where('id_produk', $data->id_produk)
                ->decrement('stok', $data->jumlah);

            // * update data updated_at di tabel stok
            StokModel::where('id_gudang', $data->id_gudang)
                ->where('id_produk', $data->id_produk)
                ->update(['updated_at' => now()]);

            // * hapus data
            $data->delete();

            activity()
                ->useLog('Produk Masuk')
                ->log('DELETE ID: ' . $data->id);

            return to_route('produk-masuk.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return to_route('produk-masuk.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function cetak(Request $request)
    {
        try {
            if ($request->dariTanggal && $request->keTanggal) {
                if ($request->dariTanggal == $request->keTanggal) {
                    $dariTanggal = $request->dariTanggal;
                    $keTanggal = $request->keTanggal;
                    $tanggal = Carbon::createFromFormat('m/d/Y', $request->dariTanggal)->format('Y-m-d');
                    $ProdukMasuk = ProdukMasukModel::whereDate('created_at', $tanggal)->orderBy('id')->get();
                } else {
                    $dariTanggal = Carbon::createFromFormat('m/d/Y', $request->dariTanggal)->format('Y-m-d');
                    $keTanggal = Carbon::createFromFormat('m/d/Y', $request->keTanggal)->format('Y-m-d');
                    $ProdukMasuk = ProdukMasukModel::whereBetween('created_at', [$dariTanggal, $keTanggal])->orderBy('id')->get();

                    $query = ProdukMasukModel::query();

                    if ($request->filled(['dariTanggal', 'keTanggal'])) {
                        $dariTanggal = Carbon::createFromFormat('m/d/Y', $request->dariTanggal)
                            ->startOfDay();

                        $keTanggal = Carbon::createFromFormat('m/d/Y', $request->keTanggal)
                            ->endOfDay();

                        $query->whereBetween('created_at', [$dariTanggal, $keTanggal]);
                    }

                    $ProdukMasuk =  $query->orderBy('id_gudang')->get();
                }
            }

            if ($ProdukMasuk->isEmpty()) {
                return redirect()->route('produk-masuk.index')->with('error', 'Gagal mencetak data: Data tidak ditemukan');
            }

            $total = 0;
            foreach ($ProdukMasuk as $currentProduk) {
                $total += $currentProduk->jumlah;
            }
            $formattedTotal = number_format($total, 0, ',', '.');
            $dariTanggalFormatted = Carbon::parse($dariTanggal)->format('Y-m-d');
            $keTanggalFormatted = Carbon::parse($keTanggal)->format('Y-m-d');
            $user = Auth::user();
            $dompdf = new Dompdf();
            $tailwindCss = file_get_contents(public_path('css/tailwind-pdf.css'));

            $html = '
            <html>
                <head>
                    <style>' . $tailwindCss . '</style>
                </head>
                <body>
                    <p class="text-xs">' . Carbon::now('Asia/Jakarta')->format('d-m-Y H:i') . '</p>
                    <h1 class="text-xl font-bold text-center mt-10">PT Original Kiripik</h1>
                    <h1 class="text-4xl font-bold text-center mt-3">Data Produk Masuk Gudang</h1>
                    <hr class="h-px my-8 bg-gray-200 border-0 mt-4">

                    <table class="w-full text-xs mt-2">
                        <tr class="font-bold">
                            <td>Admin:</td>
                            <td>' . $user->username . '</td>';

            if ($dariTanggal == $keTanggal) {
                $html .= '  <td>Tanggal:</td>
                            <td>' . $request->dariTanggal . '</td>';
            } else {
                $html .= '  <td>Periode:</td>
                            <td>' . $dariTanggalFormatted . ' hingga ' . $keTanggalFormatted . '</td>';
            }

            $html .= '       <td>Total:</td>
                            <td>' . $formattedTotal . '</td>
                        </tr>
                        <tr class="mt-2">
                            <td>Merchant:</td>
                            <td>Okir</td>
                            <td>Departemen:</td>
                            <td>Gudang</td>
                            <td>Catatan:</td>
                            <td></td>
                        </tr>
                    </table>

                    <table class="w-full text-xs text-left text-gray-500 mt-2 border border-gray-300 border-collapse">
                        <thead class="text-gray-700 capitalize bg-gray-200">
                            <tr>
                                <td scope="col" class="px-3 py-1">#</td>';
            if ($dariTanggal != $keTanggal) {
                $html .= '<td scope="col" class = "px-3 py-1">Tanggal</td>';
            }

            $html .= '          <td scope="col" class="px-3 py-1">Produk</td>
                                <td scope="col" class="px-3 py-1">Gudang</td>
                                <td scope="col" class="px-3 py-1">Jumlah</td>
                            </tr>
                        </thead>
                        <tbody>';

            foreach ($ProdukMasuk as $index => $item) {
                $html .= '
                            <tr class="border-b">
                                <td class="px-4 py-1">' . ($index + 1) . '</td>';

                if ($dariTanggal != $keTanggal) {
                    $html .= '<td class="px-4 py-1">' . $item->created_at->format('d-m-Y')  . '</td>';
                }

                $html .=       '<td class="px-4 py-1">' . $item->gudang->nama . '</td>
                                <td class="px-4 py-1">' . $item->produk->nama . '</td>
                                <td class="px-4 py-1">' . $item->jumlah . '</td>
                            </tr>';
            }

            $html .= '
                        </tbody>
                    </table>

                    <div class="text-right w-full mt-9">
                        <p style="margin-top: 130px; text-align: right; margin-right: 100px;" class="text-xs">Mengetahui</p>
                    </div>
                </body>
            </html>';

            $dompdf->loadHtml($html);
            $dompdf->render();

            return $dompdf->stream('Laporan Produk Masuk Gudang.pdf', ['Attachment' => 0]);
        } catch (\Throwable $th) {
            return redirect()->route('produk-masuk.index')->with('error', 'Gagal mencetak data: ' . $th->getMessage());
        }
    }

    public function getProdukMasuk($rentang, $idGudang, $produkId)
    {
        switch ($rentang) {
            case 'bulan':
                $dateSatu = Carbon::now()->startOfMonth();
                $dateDua = Carbon::now()->endOfMonth();
                break;

            case 'minggu':
                $dateSatu = Carbon::now()->startOfWeek();
                $dateDua = Carbon::now()->endOfWeek();
                break;

            case 'hari':
                $dateSatu = Carbon::now()->startOfDay();
                $dateDua = Carbon::now()->endOfDay();
                break;

            default:
                abort(404, 'Data tidak ditemukan');
        }

        $produkMasuk = ProdukMasukModel::where('id_gudang', $idGudang)->where('id_produk', $produkId)->whereBetween('created_at', [$dateSatu, $dateDua])->get();

        return response()->json($produkMasuk);
    }
}
