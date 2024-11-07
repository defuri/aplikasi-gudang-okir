<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\satuanModel;
use Illuminate\Http\Request;
use App\Models\bahanBakuModel;
use Illuminate\Support\Facades\Auth;
use App\Models\transaksiBahanBakuModel;
use App\Models\DetailTransaksiBahanBaku;

class transaksiBahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hapus transaksi bahan baku yang tidak memiliki detail
        $transaksiBahanBakuTanpaDetail = transaksiBahanBakuModel::doesntHave('detailTransaksiBahanBaku')->get();

        foreach ($transaksiBahanBakuTanpaDetail as $transaksi) {
            $transaksi->delete();
        }

        // Ambil data yang sudah bersih dari transaksi tanpa detail
        $user = Auth::user();
        $transaksiBahanBaku = transaksiBahanBakuModel::orderBy('id', 'desc')->paginate(10);
        $detailTransaksiBahanBaku = DetailTransaksiBahanBaku::all();
        $bahanBaku = bahanBakuModel::all();
        $satuan = satuanModel::all();

        return view('CRUD.transaksiBahanBaku', compact('transaksiBahanBaku', 'detailTransaksiBahanBaku', 'bahanBaku', 'satuan', 'user'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $bahanBaku = bahanBakuModel::all();
        $satuan = satuanModel::all();
        $user = Auth::user();

        return view('CRUD.create-transaksi-bahan-baku', compact('bahanBaku', 'satuan', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

            $transaksiBahanBaku = transaksiBahanBakuModel::where('tanggal', $tanggal)->first();
            if ($transaksiBahanBaku !== null) {
                return redirect()->route('transaksi-bahan-baku.index')
                    ->with('error', 'Data gagal disimpan: Data transaksi tanggal tersebut sudah ada');
            }

            $bahanBakuIds = $request->bahanBaku;
            $duplicates = array_diff_assoc($bahanBakuIds, array_unique($bahanBakuIds));
            if (!empty($duplicates)) {
                return redirect()->route('transaksi-bahan-baku.index')
                    ->with('error', 'Data gagal disimpan: Terdapat bahan baku yang duplikat dalam transaksi');
            }

            $transaksiBahanBaku = new transaksiBahanBakuModel();
            $transaksiBahanBaku->tanggal = $tanggal;
            $transaksiBahanBaku->save();

            $transaksiBahanBakuID = transaksiBahanBakuModel::latest()->first()->id;

            for ($i = 0; $i < count($request->bahanBaku); $i++) {
                $detailTransaksiBahanBaku = new DetailTransaksiBahanBaku();
                $detailTransaksiBahanBaku->transaksi_bahan_baku_id = $transaksiBahanBakuID;
                $detailTransaksiBahanBaku->bahan_baku_id = $request->bahanBaku[$i];
                $detailTransaksiBahanBaku->jumlah = $request->jumlah[$i];
                $detailTransaksiBahanBaku->satuan_id = $request->satuan[$i];
                $detailTransaksiBahanBaku->harga = $request->harga[$i];
                $detailTransaksiBahanBaku->total = $request->harga[$i] * $request->jumlah[$i];
                $detailTransaksiBahanBaku->created_at = now();
                $detailTransaksiBahanBaku->updated_at = now();
                $detailTransaksiBahanBaku->save();
            }

            activity()
                ->useLog('Transaksi Bahan Baku')
                ->log('INSERT ID: ' . $transaksiBahanBakuID);

            return redirect()->route('transaksi-bahan-baku.index')
                ->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Throwable $th) {
            return redirect()->route('transaksi-bahan-baku.index')
                ->with('error', 'Data gagal disimpan: ' . $th->getMessage());
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
        $transaksiBahanBaku = transaksiBahanBakuModel::find($id);
        $detailTransaksiBahanBaku = DetailTransaksiBahanBaku::where('transaksi_bahan_baku_id', $transaksiBahanBaku->id)->get();
        $bahanBaku = bahanBakuModel::all();
        $satuan = satuanModel::all();

        $tanggal = Carbon::createFromFormat('Y-m-d', $transaksiBahanBaku->tanggal)->format('m-d-Y');
        $user = Auth::user();

        return view('CRUD.edit-transaksi-bahan-baku', compact('transaksiBahanBaku', 'detailTransaksiBahanBaku', 'bahanBaku', 'satuan', 'tanggal', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Cari transaksi bahan baku berdasarkan ID
            $transaksiBahanBaku = transaksiBahanBakuModel::findOrFail($id);
            $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

            // Validasi input
            $request->validate([
                'bahan_baku_id.*' => 'integer|required',
                'jumlah.*' => 'integer|required',
                'satuan_id.*' => 'integer|required',
                'harga.*' => 'integer|required',
            ]);

            // Cek apakah ada transaksi dengan tanggal yang sama selain yang sedang diedit
            $cek = transaksiBahanBakuModel::where('tanggal', $tanggal)
                ->where('id', '!=', $transaksiBahanBaku->id)
                ->first();

            // Jika ada transaksi dengan tanggal yang sama, berikan error
            if ($cek) {
                return redirect()->route('transaksi-bahan-baku.index')->with('error', 'Data gagal dirubah: Data dengan tanggal tersebut sudah ada');
            }

            // Update transaksi bahan baku
            $transaksiBahanBaku->tanggal = $tanggal;
            $transaksiBahanBaku->updated_at = now();
            $transaksiBahanBaku->save();

            $detailTransaksiBahanBaku = DetailTransaksiBahanBaku::where('transaksi_bahan_baku_id', $transaksiBahanBaku->id)->get();

            foreach ($detailTransaksiBahanBaku as $currentDetail) {
                $diedit = DetailTransaksiBahanBaku::find($currentDetail->id);

                $diedit->jumlah = $request->jumlah[$currentDetail->id];
                $diedit->satuan_id = $request->satuan[$currentDetail->id];
                $diedit->harga = $request->harga[$currentDetail->id];
                $diedit->total = $request->harga[$currentDetail->id] * $request->jumlah[$currentDetail->id];
                $diedit->updated_at = now();
                $diedit->save();
            }

            activity()
                ->useLog('Transaksi Bahan Baku')
                ->log('UPDATE ID: ' . $transaksiBahanBaku->id);

            return redirect()->route('transaksi-bahan-baku.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            return redirect()->route('transaksi-bahan-baku.index')->with('error', 'Data gagal dirubah: ' . $e->getMessage());
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

            activity()
                ->useLog('Transaksi Bahan Baku')
                ->log('DELETE ID: ' . $data->id);

            $data->delete();

            return redirect()->route('transaksi-bahan-baku.index')->with(['success' => 'Data Berhasil dihapus!']);
        } catch (\Throwable $th) {
            return redirect()->route('transaksi-bahan-baku.index')->with('error', 'Data gagal dihapus: ' . $th->getMessage());
        }
    }
    public function cetak(Request $request)
    {
        try {
            if (!$request->normal) {
                $dariTanggal = Carbon::createFromFormat('m/d/Y', $request->dariTanggal)->format('Y-m-d');
                $keTanggal = Carbon::createFromFormat('m/d/Y', $request->keTanggal)->format('Y-m-d');
            } else {
                $dariTanggal = $request->dariTanggal;
                $keTanggal = $request->keTanggal;
            }

            $user = Auth::user();

            $transaksiBahanBaku = TransaksiBahanBakuModel::whereBetween('tanggal', [$dariTanggal, $keTanggal])->get();

            if ($transaksiBahanBaku->isEmpty()) {
                return redirect()->route('transaksi-bahan-baku.index')->with('error', 'Gagal mencetak data: Data tidak ditemukan');
            }

            $transaksiIds = $transaksiBahanBaku->pluck('id')->toArray();

            $detailTransaksiBahanBaku = DetailTransaksiBahanBaku::whereIn('transaksi_bahan_baku_id', $transaksiIds)
                ->with(['bahanBaku', 'satuan'])
                ->get();

            $total = $detailTransaksiBahanBaku->sum('total');
            $formattedTotal = number_format($total, 0, ',', '.');
            $sekarang = Carbon::now('Asia/Jakarta')->format('d-m-Y H:i');
            $dompdf = new Dompdf();
            $tailwindCss = file_get_contents(public_path('css/tailwind-pdf.css'));

            $html = '
            <html>
                <head>
                    <style>' . $tailwindCss . '</style>
                </head>
                <body>
                    <p class="text-xs">' . $sekarang . '</p>

                    <h1 class="text-xl font-bold text-center mt-10">PT Original Kiripik</h1>
                    <h1 class="text-4xl font-bold text-center mt-3">Transaksi Bahan Baku</h1>

                    <hr class="h-px my-8 bg-gray-200 border-0 mt-4">

                    <table class="w-full text-xs mt-2">
                        <tr class="font-bold">
                            <td>Periode:</td>';

            $dariTanggalNormal = Carbon::createFromFormat('Y-m-d', $dariTanggal)->format('d-m-Y');
            $keTanggalNormal = Carbon::createFromFormat('Y-m-d', $keTanggal)->format('d-m-Y');

            if ($dariTanggal != $keTanggal) {
                $html .= '  <td>' . $dariTanggalNormal . ' hingga ' . $keTanggalNormal . '</td>';
            } else {
                $html .= '  <td>' . $dariTanggalNormal . '</td>';
            }

            $html .= '      <td>Admin:</td>
                            <td>' . $user->username . '</td>
                            <td>Total:</td>
                            <td>Rp ' . $formattedTotal . '</td>
                        </tr>
                        <tr class="mt-2">
                            <td>Merchant:</td>
                            <td>Okir</td>
                            <td>Departemen:</td>
                            <td>Produksi</td>
                            <td>Keterangan:</td>
                            <td></td>
                        </tr>
                    </table>

                    <table class="w-full text-xs text-left text-gray-500 mt-2 border border-gray-300 border-collapse">
                        <thead class="text-gray-700 capitalize bg-gray-200">
                            <tr>
                                <td scope="col" class="px-3 py-1">#</td>';

            if ($dariTanggal != $keTanggal) {
                $html .= '  <td>Tanggal</td>';
            }

            $html .= '          <td scope="col" class="px-3 py-1">Bahan Baku</td>
                                <td scope="col" class="px-3 py-1">Jumlah</td>
                                <td scope="col" class="px-3 py-1">Satuan</td>
                                <td scope="col" class="px-3 py-1">Harga</td>
                                <td scope="col" class="px-3 py-1">Total</td>
                            </tr>
                        </thead>
                    <tbody>';

            foreach ($detailTransaksiBahanBaku as $index => $item) {
                $tanggalTransaksi = $item->transaksiBahanBaku->tanggal ?? '';

                $html .= '
                            <tr class="border-b">
                                <td class="px-4 py-1">' . ($index + 1) . '</td>';

                if ($dariTanggal != $keTanggal) {
                    $html .= '<td class="px-4 py-1">' . \Carbon\Carbon::parse($item->transaksiBahanBaku->tanggal)->format('d-m-Y') . '</td>';
                }

                $html .= '       <td class="px-4 py-1">' . $item->bahanBaku->nama . '</td>
                                <td class="px-4 py-1">' . $item->jumlah . '</td>
                                <td class="px-4 py-1">' . $item->satuan->nama . '</td>
                                <td class="px-4 py-1">Rp ' . number_format($item->harga, 0, ',', '.') . '</td>
                                <td class="px-4 py-1">Rp ' . number_format($item->total, 0, ',', '.') . '</td>
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
        } catch (\Throwable $th) {
            return redirect()->route('transaksi-bahan-baku.index')->with('error', 'Gagal mencetak data: ' . $th->getMessage());
        }
    }
}
