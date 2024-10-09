<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use Carbon\Carbon;
use App\Models\Pesanan;
use App\Models\pelanggan;
use App\Models\produkModel;
use Illuminate\Http\Request;
use LengthException;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pesanan = Pesanan::orderBy('id', 'desc')->paginate(10);
        $pelanggan = pelanggan::all();
        $produk = produkModel::all();

        return view('owner.pesanan', compact('pesanan', 'pelanggan', 'produk'));
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
                'pelanggan_id' => 'required|integer',
                'tanggal' => 'required|date',
                'jumlah' => 'array',
            ]);

            $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

            $pesanan = new Pesanan;
            $pesanan->pelanggan_id = $request->pelanggan_id;
            $pesanan->tanggal = $tanggal;
            $pesanan->save();

            $LatestID = $pesanan->id;

            $filteredJumlah = array_filter($request->jumlah, function ($jumlahnya) {
                return !is_null($jumlahnya) && $jumlahnya > 0;
            });

            if (count($filteredJumlah) > 0) {
                foreach ($filteredJumlah as $produk_id => $jumlahnya) {
                    $DetailPesanan = new DetailPesanan();
                    $DetailPesanan->pesanan_id = $LatestID;
                    $DetailPesanan->produk_id = $produk_id;
                    $DetailPesanan->jumlah = $jumlahnya;

                    $harga = ProdukModel::find($produk_id)->harga;
                    $DetailPesanan->total = $jumlahnya * $harga;

                    $DetailPesanan->save();
                }
                return redirect()->route('pesanan.index')->with(['success' => 'Data berhasil disimpan!']);
            } else {
                return redirect()->route('pesanan.index')->with('error', 'Data gagal disimpan: Produk yang dipesan tidak ada');
            }
        } catch (\Exception $e) {
            return redirect()->route('pesanan.index')->with('error', 'Data gagal disimpan: ' . $e->getMessage());
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $DetailPesanan = DetailPesanan::where('pesanan_id', $id)->get();

            foreach ($DetailPesanan as $data) {
                $data->delete();
            }

            $pesanan = Pesanan::find($id);
            $pesanan->delete();

            return redirect()->route('pesanan.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('pesanan.index')->with('error', 'Data gagal dihapus: ' . $th->getMessage());
        }
    }
}
