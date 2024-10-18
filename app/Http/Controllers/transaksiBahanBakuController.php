<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\DetailTransaksiBahanBaku;
use Carbon\Carbon;
use Date;
use Dompdf\Dompdf;
use App\Models\satuanModel;
use Illuminate\Http\Request;
use App\Models\bahanBakuModel;
use App\Models\transaksiBahanBakuModel;

class transaksiBahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $transaksiBahanBaku = transaksiBahanBakuModel::orderBy('id', 'desc')->paginate(10);
        $detailTransaksiBahanBaku = DetailTransaksiBahanBaku::all();
        $bahanBaku = bahanBakuModel::all();
        $satuan = satuanModel::all();

        return view('owner.transaksiBahanBaku', compact('transaksiBahanBaku', 'detailTransaksiBahanBaku', 'bahanBaku', 'satuan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'tanggal' => 'required|string',
                'idBahanBaku' => 'required|integer',
                'jumlah' => 'integer|required',
                'harga' => 'integer|required',
                'idSatuan' => 'required|integer',
            ]);

            $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

            transaksiBahanBakuModel::create([
                'tanggal' => $tanggal,
                'id_bahan_baku' => $request->idBahanBaku,
                'jumlah' => $request->jumlah,
                'id_satuan' => $request->idSatuan,
                'harga' => $request->harga,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('transaksiBahanBaku.index')->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('transaksiBahanBaku.index')->with('error', 'Data gagal disimpan: ' . $e->getMessage());
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
                'idBahanBaku' => 'required|integer',
                'jumlah' => 'required|integer',
                'idSatuan' => 'required|integer',
                'harga' => 'required|integer',
                'tanggal' => 'required|string',
            ]);

            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');

            $dataYangMauDiEdit = transaksiBahanBakuModel::findOrFail($id);

            $dataYangMauDiEdit->update([
                'id_bahan_baku' => $request->idBahanBaku,
                'jumlah' => $request->jumlah,
                'id_satuan' => $request->idSatuan,
                'harga' => $request->harga,
                'tanggal' => $tanggal,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('transaksiBahanBaku.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            return redirect()->route('transaksiBahanBaku.index')->with('error', 'Data gagal dirubah: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = transaksiBahanBakuModel::findOrFail($id);

            $data->delete();

            return redirect()->route('transaksiBahanBaku.index')->with(['success' => 'Data Berhasil dihapus!']);
        } catch (\Throwable $th) {
            return redirect()->route('transaksiBahanBaku.index')->with('error', 'Data gagal dihapus: ' . $th->getMessage());
        }
    }

    public function cetak(Request $request)
    {
        $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

        $transaksi = transaksiBahanBakuModel::where('tanggal', $tanggal)->get();

        $dompdf = new Dompdf();

        $tailwindCss = file_get_contents(public_path('css/tailwind-pdf.css'));

        $tanggalSekarang = Date(now());

        $html = '
        <html>
            <head>
                <style>' . $tailwindCss . '</style>
            </head>
            <body>
                <p class="text-xs">' . $tanggalSekarang . '</p>

                <h1 class="text-xl font-bold text-center mt-10">PT Original Kiripik</h1>
                <h1 class="text-4xl font-bold text-center mt-3">Transaksi Bahan Baku</h1>

                <hr class="h-px my-8 bg-gray-200 border-0 mt-4">

                <table class="w-full text-xs mt-2">
                    <tr class="font-bold">
                        <td>Tanggal:</td>
                        <td>'. $tanggal . '</td>
                        <td>Departemen:</td>
                        <td>Produksi</td>
                        <td>Metode pembayaran:</td>
                        <td>'. $request->metodePembayaran .'</td>
                    </tr>
                    <tr class="mt-2">
                        <td>Admin:</td>
                        <td>Nama Admin</td>
                        <td>Merchant:</td>
                        <td>Okir</td>
                        <td>Mata Uang:</td>
                        <td>Rupiah</td>
                    </tr>
                </table>

                <table class="w-full text-xs text-left text-gray-500 mt-2 border border-gray-300 border-collapse">
                    <thead class="text-gray-700 capitalize bg-gray-200">
                        <tr>
                            <td scope="col" class="px-3 py-1">#</td>
                            <td scope="col" class="px-3 py-1">Bahan Baku</td>
                            <td scope="col" class="px-3 py-1">Jumlah</td>
                            <td scope="col" class="px-3 py-1">Satuan</td>
                            <td scope="col" class="px-3 py-1">Harga</td>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($transaksi as $index => $item) {
            $html .= '
                        <tr class="border-b">
                            <td class="px-4 py-1">' . ($index + 1) . '</td>
                            <td class="px-4 py-1">' . $item->bahanBaku->nama . '</td>
                            <td class="px-4 py-1">' . $item->jumlah . '</td>
                            <td class="px-4 py-1">' . $item->satuan->nama . '</td>
                            <td class="px-4 py-1">Rp ' . $item->harga . '</td>
                        </tr>';
        }

        $html .= '
                    </tbody>
                </table>

                <div class="text-right w-full mt-9">
                <p style="margin-top: 130px;text-align: right; margin-right: 100px;" class="text-xs">Mengetahui </p>
                </div>

            </body>

        </html>';

        $dompdf->loadHtml($html);
        $dompdf->render();

        return $dompdf->stream('Laporan Transaksi Bahan Baku.pdf', ['Attachment' => 0]);
    }
}
