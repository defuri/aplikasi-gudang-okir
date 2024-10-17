<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use Carbon\Carbon;
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
        $total = $transaksiBahanBaku->total();
        $bahanBaku = bahanBakuModel::all();
        $satuan = satuanModel::all();

        return view('owner.transaksiBahanBaku', compact('transaksiBahanBaku', 'total', 'bahanBaku', 'satuan'));
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

        dd($transaksi);

        $dompdf = new Dompdf();

        $tailwindCss = file_get_contents(public_path('css/tailwind-pdf.css'));

        $imagePath = public_path('img/logo.webp');
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageBase64 = 'data:image/webp;base64,' . $imageData;

        $html = '
        <html>
            <head>
                <style>' . $tailwindCss . '</style>
            </head>
            <body class="bg-gray-100 text-gray-900">
                <div class="container mx-auto p-4">
                    <h1 class="text-3xl font-bold text-center">Hello, World with Tailwind CSS!</h1>
                    <p class="mt-4 text-lg">This is a sample PDF generated using Tailwind CSS and Dompdf.</p>
                    <img src="' . $imageBase64 . '" alt="Logo" style="max-width: 150px;">
                </div>
            </body>
        </html>';

        $dompdf->loadHtml($html);
        $dompdf->render();

        return $dompdf->stream('document.pdf', ['Attachment' => 0]);
    }
}
