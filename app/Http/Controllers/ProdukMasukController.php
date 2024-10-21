<?php

namespace App\Http\Controllers;

use App\Models\gudangModel;
use App\Models\ProdukMasukModel;
use App\Models\produkModel;
use App\Models\stokModel;
use Illuminate\Http\Request;

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

        return view('owner.produkMasuk', compact('ProdukMasuk', 'gudang', 'produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id_gudang = $request->id_gudang;
        $produk = produkModel::all();
        $gudang = gudangModel::all();

        $nama_gudang = null;
        if ($id_gudang) {
            $nama_gudang = gudangModel::find($id_gudang)->nama ?? null;
        }

        return view('owner.create-produk-masuk', compact('id_gudang', 'nama_gudang', 'produk', 'gudang'));
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
                ProdukMasukModel::create([
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
            }

            return redirect('/owner/ProdukMasuk')->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Exception $e) {
            return redirect('/owner/ProdukMasuk')->with('error', 'Data gagal disimpan: ' . $e->getMessage());
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
                'id_gudang' => ['required', 'integer'],
                'produk_id' => ['required', 'integer'],
                'jumlah' => ['required', 'integer'],
            ]);

            // * cari data yang mau diedit
            $data = ProdukMasukModel::findOrFail($id);

            // * kurangi data sekarang dengan data yang mau diedit
            StokModel::where('id_gudang', $request->id_gudang)
                ->where('produk_id', $request->produk_id)
                ->decrement('stok', $data->jumlah);

            // * tambahkan data sesuai dengan data terbaru yang diinputkan
            StokModel::where('id_gudang', $request->id_gudang)
                ->where('produk_id', $request->produk_id)
                ->increment('stok', $request->jumlah);

            // * update data updated_at di tabel stok
            StokModel::where('id_gudang', $request->id_gudang)
                ->where('produk_id', $request->produk_id)
                ->update(['updated_at' => now()]);

            // * update semua data
            $data->update([
                'id_gudang' => $request->id_gudang,
                'produk_id' => $request->produk_id,
                'jumlah' => $request->jumlah,
                'updated_at' => now(),
            ]);

            return redirect()->route('ProdukMasuk.index')->with(['success' => 'Data berhasil dirubah!']);
        } catch (\Exception $e) {
            return redirect()->route('ProdukMasuk.index')->with('error', 'Data gagal dirubah: ' . $e->getMessage());
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
                ->where('produk_id', $data->produk_id)
                ->decrement('stok', $data->jumlah);

            // * update data updated_at di tabel stok
            StokModel::where('id_gudang', $data->id_gudang)
                ->where('produk_id', $data->produk_id)
                ->update(['updated_at' => now()]);

            // * hapus data
            $data->delete();

            return to_route('ProdukMasuk.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return to_route('ProdukMasuk.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
