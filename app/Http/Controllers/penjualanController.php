<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\produkModel;
use Illuminate\Http\Request;
use App\Models\penjualanModel;
use Illuminate\Support\Facades\Auth;

class penjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $penjualan = penjualanModel::orderBy('id', 'desc')->paginate(10);
        $produk = produkModel::all();

        return view('owner.penjualan', compact('penjualan', 'produk'));
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
        //
        try {
            $request->validate([
                'tanggal' => 'required|string|max:20',
                'id_produk' => 'required|integer',
                'jumlah' => 'integer|required',
            ]);

            penjualanModel::create([
                'tanggal' => Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d'),
                'id_produk' => $request->id_produk,
                'jumlah' => $request->jumlah,
                'omzet' => produkModel::findOrFail($request->id_produk)->harga * $request->jumlah,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('penjualan.index')->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Exception $e) {
            return redirect()->route('penjualan.index')->with('error', 'Data gagal disimpan: ' . $e->getMessage());
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
        //
        try {
            $request->validate([
                'tanggal' => 'required|string|max:20',
                'id_produk' => 'required|integer',
                'jumlah' => 'integer|required',
            ]);

            $data = penjualanModel::findOrFail($id);

            $data->update([
                'tanggal' => Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d'),
                'id_produk' => $request->id_produk,
                'jumlah' => $request->jumlah,
                'omzet' => produkModel::findOrFail($request->id_produk)->harga * $request->jumlah,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('penjualan.index')->with(['success' => 'Data berhasil dirubah!']);
        } catch (\Exception $e) {
            return redirect()->route('penjualan.index')->with('error', 'Data gagal dirubah: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = penjualanModel::findOrFail($id);

            $data->delete();

            return to_route('penjualan.index')->with('success', 'data berhasil dihapus!');
        } catch (\Throwable $th) {
            return to_route('penjualan.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function cetak(Request $request)
    {
        $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

        $dataPenjualan = penjualanModel::where('tanggal', $tanggal)->get();

        $dompdf = new Dompdf();

        $tailwindCss = file_get_contents(public_path('css/tailwind-pdf.css'));

        $tanggalSekarang = Date(now());

        $totalOmzet = 0;

        foreach ($dataPenjualan as $currentDataPenjualan) {
            $totalOmzet += floatval($currentDataPenjualan->omzet);
        }


        $html = '
        <html>
            <head>
                <style>' . $tailwindCss . '</style>
            </head>
            <body>
                <p class="text-xs">' . $tanggalSekarang . '</p>

                <h1 class="text-xl font-bold text-center mt-10">PT Original Kiripik</h1>
                <h1 class="text-4xl font-bold text-center mt-3">Penjualan</h1>

                <hr class="h-px my-8 bg-gray-200 border-0 mt-4">

                <table class="w-full text-xs mt-2">
                    <tr class="font-bold">
                        <td>Tanggal:</td>
                        <td>' . $tanggal . '</td>
                        <td>Departemen:</td>
                        <td>Lapangan</td>
                        <td>Total omzet:</td>
                        <td>' . $totalOmzet . '</td>
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
                            <td scope="col" class="px-3 py-1">Tanggal</td>
                            <td scope="col" class="px-3 py-1">Produk</td>
                            <td scope="col" class="px-3 py-1">Jumlah</td>
                            <td scope="col" class="px-3 py-1">Omzet</td>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($dataPenjualan as $index => $item) {
            $html .= '
                        <tr class="border-b">
                            <td class="px-4 py-1">' . ($index + 1) . '</td>
                            <td class="px-4 py-1">' . Carbon::createFromFormat('m/d/Y', $item->tanggal)->format('d-m-Y') . '</td>
                            <td class="px-4 py-1">' . $item->produk->nama . '</td>
                            <td class="px-4 py-1">' . $item->jumlah . '</td>
                            <td class="px-4 py-1">Rp ' . $item->omzet . '</td>
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
