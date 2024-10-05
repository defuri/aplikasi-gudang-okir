<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
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
        //
        try {
            dd($request->all());

            $request->validate([
                'id_pelanggan' => ['required', 'integer'],
                'id_produk' => ['required', 'integer'],
                'jumlah' => ['required', 'integer'],
            ]);

            $harga = produkModel::find($request->id_produk)->harga;

            $pesanan = new Pesanan;
            $pesanan->id_pelanggan = $request->id_pelanggan;
            $pesanan->created_at = now();
            $pesanan->updated_at = now();
            $pesanan->save();

            $DetailPesanan = new DetailPesanan;

            DetailPesanan::create();

            return redirect()->route('pesanan.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('pesanan.index')->with('error', 'Data gagal disimpan: ' . $th->getMessage());
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
    }
}
