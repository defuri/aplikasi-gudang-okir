<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use App\Models\Pesanan;
use App\Models\produkModel;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $count = 1;
        $pesanan = Pesanan::orderBy('id', 'desc')->paginate(10);
        $pelanggan = pelanggan::all();
        $produk = produkModel::all();

        return view('owner.pesanan', compact('pesanan', 'pelanggan', 'produk', 'count'));
    }

    public function tambahProduk(Request $request)
    {
        // Ambil jumlah produk saat ini
        $count = $request->count;

        // Tambah 1 pada count
        $count++;

        // Ambil produk dari database
        $produk = produkModel::all();

        // Render ulang view dengan data baru
        return response()->json([
            'view' => view('partials.produk', compact('count', 'produk'))->render(),
            'count' => $count
        ]);
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
        dd($request->all());

        // try {
        //     $request->validate([
        //         'id_pelanggan' => ['required', 'integer'],
        //         'id_produk' => ['required', 'array'],
        //         'id_produk.*' => ['required', 'integer'],
        //         'jumlah' => ['required', 'array'],
        //         'jumlah.*' => ['required', 'integer'],
        //     ]);

        //     // Simpan pesanan
        //     $pesanan = new Pesanan;
        //     $pesanan->pelanggan_id = $request->id_pelanggan;
        //     $pesanan->created_at = now();
        //     $pesanan->updated_at = now();
        //     $pesanan->save();

        //     // Ambil ID pesanan terbaru
        //     $IDPesanan = $pesanan->id;

        //     // Loop melalui produk dan jumlah
        //     foreach ($request->id_produk as $index => $produk) {
        //         // Ambil harga berdasarkan ID produk
        //         $harga = produkModel::where('id', $produk)->value('harga');

        //         // Ambil jumlah yang sesuai dengan indeks produk
        //         $jumlah = $request->jumlah[$index];

        //         // Simpan detail pesanan
        //         $detail_pesanan = new DetailPesanan;
        //         $detail_pesanan->pesanan_id = $IDPesanan;
        //         $detail_pesanan->produk_id = $produk;
        //         $detail_pesanan->jumlah = $jumlah;
        //         $detail_pesanan->total = $harga * $jumlah;
        //         $detail_pesanan->created_at = now();
        //         $detail_pesanan->updated_at = now();
        //         $detail_pesanan->save();
        //     }

        //     return redirect()->route('pesanan.index')->with('success', 'Data berhasil disimpan');
        // } catch (\Throwable $th) {
        //     return redirect()->route('pesanan.index')->with('error', 'Data gagal disimpan: ' . $th->getMessage());
        // }
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
    }
}
