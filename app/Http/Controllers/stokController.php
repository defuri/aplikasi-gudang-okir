<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\stokModel;
use App\Models\gudangModel;
use App\Models\produkModel;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class stokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stok = stokModel::orderBy('id', 'asc')->paginate(10);
        $gudang = gudangModel::all();
        $produk = produkModel::all();
        $user = Auth::user();

        return view('CRUD.stok', compact('stok', 'gudang', 'produk', 'user'));
    }

    public function cetak()
    {
        $stok = stokModel::all();
        $dompdf = new Dompdf();
        $tailwindCss = file_get_contents(public_path('css/tailwind-pdf.css'));
        $totalProduk = 0;

        foreach ($stok as $currentStok) {
            $totalProduk += $currentStok->stok;
        }

        $formattedTotal = number_format($totalProduk, 0, ',', '.');

        $html = '
        <html>
            <head>
                <style>' . $tailwindCss . '</style>
            </head>
            <body>
                <p class="text-xs">' . Date(now()) . '</p>

                <h1 class="text-xl font-bold text-center mt-10">PT Original Kiripik</h1>
                <h1 class="text-4xl font-bold text-center mt-3">Stok Produk</h1>

                <hr class="h-px my-8 bg-gray-200 border-0 mt-4">

                <table class="w-full text-xs mt-2">
                    <tr class="font-bold">
                        <td>Tanggal:</td>
                        <td>' . Date(now()) . '</td>
                        <td>Departemen:</td>
                        <td>Gudang</td>
                        <td>Total stok:</td>
                        <td>' . $formattedTotal . '</td>
                    </tr>
                    <tr class="mt-2">
                        <td>Admin:</td>
                        <td>Nama Admin</td>
                        <td>Merchant:</td>
                        <td>Okir</td>
                        <td>Satuan:</td>
                        <td>PCS</td>
                    </tr>
                </table>

                <table class="w-full text-xs text-left text-gray-500 mt-2 border border-gray-300 border-collapse">
                    <thead class="text-gray-700 capitalize bg-gray-200">
                        <tr>
                            <td scope="col" class="px-3 py-1">#</td>
                            <td scope="col" class="px-3 py-1">Gudang</td>
                            <td scope="col" class="px-3 py-1">Produk</td>
                            <td scope="col" class="px-3 py-1">Stok</td>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($stok as $index => $item) {
            $html .= '
                        <tr class="border-b">
                            <td class="px-4 py-1">' . ($index + 1) . '</td>
                            <td class="px-4 py-1">' . $item->gudang->nama . '</td>
                            <td class="px-4 py-1">' . $item->produk->nama . '</td>
                            <td class="px-4 py-1">' . $item->stok . '</td>
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

        return $dompdf->stream('Laporan Stok.pdf', ['Attachment' => 0]);
    }
}
