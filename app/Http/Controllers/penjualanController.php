<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\produkModel;
use Illuminate\Http\Request;
use App\Models\penjualanModel;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\Auth;

class penjualanController extends Controller
{
    public function index()
    {
        $penjualan = penjualanModel::orderBy('id', 'desc')->paginate(10);
        $detailPenjualan = DetailPenjualan::all();
        $produk = produkModel::all();

        return view('owner.penjualan', compact('penjualan', 'detailPenjualan', 'produk'));
    }

    public function create()
    {
        $produk = produkModel::all();
        return view('owner.create-penjualan', compact('produk'));
    }

    public function store(Request $request)
    {
        try {
            $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

            // Check if transaction for this date already exists
            $penjualan = penjualanModel::where('tanggal', $tanggal)->first();
            if ($penjualan !== null) {
                return redirect()->route('penjualan.index')
                    ->with('error', 'Data gagal disimpan: Data penjualan tanggal tersebut sudah ada');
            }

            // Check for duplicate produk_id in the request
            $produkIds = $request->produk;
            $duplicates = array_diff_assoc($produkIds, array_unique($produkIds));
            if (!empty($duplicates)) {
                return redirect()->route('penjualan.index')
                    ->with('error', 'Data gagal disimpan: Terdapat produk yang duplikat dalam penjualan');
            }

            // Create new penjualan
            $penjualan = new penjualanModel();
            $penjualan->tanggal = $tanggal;
            $penjualan->save();

            $penjualanID = penjualanModel::latest()->first()->id;

            // Store detail penjualan
            for ($i = 0; $i < count($request->produk); $i++) {
                $detailPenjualan = new DetailPenjualan();
                $detailPenjualan->penjualan_id = $penjualanID;
                $detailPenjualan->produk_id = $request->produk[$i];
                $detailPenjualan->jumlah = $request->jumlah[$i];
                $detailPenjualan->omzet = $request->jumlah[$i] * produkModel::find($request->produk[$i])->harga;
                $detailPenjualan->created_at = now();
                $detailPenjualan->updated_at = now();
                $detailPenjualan->save();
            }

            return redirect()->route('penjualan.index')
                ->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Throwable $th) {
            return redirect()->route('penjualan.index')
                ->with('error', 'Data gagal disimpan: ' . $th->getMessage());
        }
    }

    public function edit($id)
    {
        $penjualan = penjualanModel::where('id', $id)->first();
        $detailPenjualan = DetailPenjualan::where('penjualan_id', $penjualan->id)->get();
        $produk = produkModel::all();

        $tanggal = Carbon::createFromFormat('Y-m-d', $penjualan->tanggal)->format('m-d-Y');

        return view('owner.edit-penjualan', compact('penjualan', 'detailPenjualan', 'produk', 'tanggal'));
    }

    public function update(Request $request, string $id)
    {
        // try {
        //     $penjualan = penjualanModel::findOrFail($id);
        //     $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

        //     // Validasi input
        //     $request->validate([
        //         'produk_id.*' => 'integer|required',
        //         'jumlah.*' => 'integer|required',
        //     ]);

        //     // Cek apakah ada penjualanModel dengan tanggal yang sama selain yang sedang diedit
        //     $cek = penjualanModel::where('tanggal', $tanggal)
        //         ->where('id', '!=', $penjualan->id)
        //         ->first();

        //     if ($cek) {
        //         return redirect()->route('penjualan.index')
        //             ->with('error', 'Data gagal dirubah: Data dengan tanggal tersebut sudah ada');
        //     }

        //     // Update penjualan
        //     $penjualan->tanggal = $tanggal;
        //     $penjualan->updated_at = now();
        //     $penjualan->save();

        //     $detailPenjualan = DetailPenjualan::where('penjualan_id', $penjualan->id)->get();

        //     foreach ($detailPenjualan as $currentDetail) {
        //         $diedit = DetailPenjualan::find($currentDetail->id);
        //         $diedit->jumlah = $request->jumlah[$currentDetail->id];
        //         $diedit->omzet = $request->jumlah[$currentDetail->id] * produkModel::find($currentDetail->produk_id)->harga;
        //         $diedit->updated_at = now();
        //         $diedit->save();
        //     }

        //     return redirect()->route('penjualan.index')->with(['success' => 'Data Berhasil Diubah!']);
        // } catch (\Exception $e) {
        //     return redirect()->route('penjualan.index')
        //         ->with('error', 'Data gagal dirubah: ' . $e->getMessage());
        // }
    }

    public function destroy(string $id)
    {
        // try {
        //     $data = penjualanModel::findOrFail($id);
        //     $data->delete();

        //     return redirect()->route('penjualan.index')->with(['success' => 'Data Berhasil dihapus!']);
        // } catch (\Throwable $th) {
        //     return redirect()->route('penjualan.index')
        //         ->with('error', 'Data gagal dihapus: ' . $th->getMessage());
        // }
    }

    public function cetak(Request $request)
    {
        try {
            $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

            $penjualan = penjualanModel::where('tanggal', $tanggal)->first();
            $detailPenjualan = DetailPenjualan::where('penjualan_id', $penjualan->id)->get();

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
                    <h1 class="text-4xl font-bold text-center mt-3">Laporan Penjualan</h1>

                    <hr class="h-px my-8 bg-gray-200 border-0 mt-4">

                    <table class="w-full text-xs mt-2">
                        <tr class="font-bold">
                            <td>Tanggal:</td>
                            <td>' . $tanggal . '</td>
                            <td>Departemen:</td>
                            <td>Penjualan</td>
                            <td>No referensi:</td>
                            <td>' . $penjualan->id . '</td>
                        </tr>
                        <tr class="mt-2">
                            <td>Admin:</td>
                            <td>' . Auth::user()->username . '</td>
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
                                <td scope="col" class="px-3 py-1">Produk</td>
                                <td scope="col" class="px-3 py-1">Jumlah</td>
                                <td scope="col" class="px-3 py-1">Omzet</td>
                            </tr>
                        </thead>
                        <tbody>';

            foreach ($detailPenjualan as $index => $item) {
                $html .= '
                            <tr class="border-b">
                                <td class="px-4 py-1">' . ($index + 1) . '</td>
                                <td class="px-4 py-1">' . $item->produk->nama . '</td>
                                <td class="px-4 py-1">' . $item->jumlah . '</td>
                                <td class="px-4 py-1">Rp ' . number_format($item->omzet, 0, ',', '.') . '</td>
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

            return $dompdf->stream('Laporan Penjualan.pdf', ['Attachment' => 0]);
        } catch (\Throwable $th) {
            return redirect()->route('penjualan.index')
                ->with('error', 'Gagal mencetak laporan: ' . $th->getMessage());
        }
    }
}
