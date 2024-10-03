<?php

namespace App\Http\Controllers;

use App\Models\gudangModel;
use App\Models\ProdukKeluarModel;
use App\Models\produkModel;
use App\Models\stokModel;
use Illuminate\Http\Request;

class ProdukKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $ProdukKeluar = ProdukKeluarModel::orderBy('id', 'desc')->paginate(10);
        $gudang = gudangModel::all();
        $produk = produkModel::all();

        return view('owner.ProdukKeluar', compact('ProdukKeluar', 'gudang', 'produk'));
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
                'id_gudang' => ['required', 'integer'],
                'id_produk' => ['required', 'integer'],
                'jumlah' => ['required', 'integer'],
            ]);

            $exists = StokModel::where('id_gudang', $request->id_gudang)
                ->where('id_produk', $request->id_produk)
                ->exists();

            if ($exists) {
                $stok = StokModel::where('id_gudang', $request->id_gudang)
                    ->where('id_produk', $request->id_produk)
                    ->first();

                if ($stok && ($stok->stok - $request->jumlah) > -1) {
                    ProdukKeluarModel::create([
                        'id_gudang' => $request->id_gudang,
                        'id_produk' => $request->id_produk,
                        'jumlah' => $request->jumlah,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    try {
                        StokModel::where('id_gudang', $request->id_gudang)
                            ->where('id_produk', $request->id_produk)
                            ->decrement('stok', $request->jumlah);

                        StokModel::where(function ($query) use ($request) {
                            $query->where('id_gudang', $request->id_gudang)
                                ->where('id_produk', $request->id_produk);
                        })->update(['updated_at' => now()]);

                        return redirect('/owner/ProdukKeluar')->with(['success' => 'Data berhasil disimpan!']);
                    } catch (\Throwable $th) {
                        StokModel::create([
                            'id_gudang' => $request->id_gudang,
                            'id_produk' => $request->id_produk,
                            'stok' => $request->stok,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                } else {
                    return redirect('/owner/ProdukKeluar')->with('error', 'Pastikan jumlah barang yang dimasukkan kurang dari stok di gudang');
                }
            } else {
                return redirect('/owner/ProdukKeluar')->with('error', 'Produk tidak ada di gudang');
            }
        } catch (\Exception $e) {
            return redirect('/owner/ProdukKeluar')->with('error', 'Data gagal disimpan: ' . $e->getMessage());
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
                'id_produk' => ['required', 'integer'],
                'jumlah' => ['required', 'integer'],
            ]);


            $data = ProdukKeluarModel::findOrFail($id);

            // * tambahkan dulu dengan jumlah data keluar
            StokModel::where('id_gudang', $data->id_gudang)
                ->where('id_produk', $data->id_produk)
                ->increment('stok', $data->jumlah);

            // * kurangi dengan data baru
            StokModel::where('id_gudang', $request->id_gudang)
                ->where('id_produk', $request->id_produk)
                ->decrement('stok', $request->jumlah);

            // * update data updated_at di tabel stok
            StokModel::where('id_gudang', $request->id_gudang)
                ->where('id_produk', $request->id_produk)
                ->update(['updated_at' => now()]);

            $data->update([
                'id_gudang' => $request->id_gudang,
                'id_produk' => $request->id_produk,
                'jumlah' => $request->jumlah,
                'updated_at' => now(),
            ]);

            return redirect()->route('ProdukKeluar.index')->with(['success' => 'Data berhasil dirubah!']);
        } catch (\Exception $e) {
            return redirect()->route('ProdukKeluar.index')->with('error', 'Data gagal dirubah: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = ProdukKeluarModel::findOrFail($id);

            // * tambah dengan data yang mau dihapus
            StokModel::where('id_gudang', $data->id_gudang)
                ->where('id_produk', $data->id_produk)
                ->increment('stok', $data->jumlah);

            // * update kolom updated_at
            StokModel::where('id_gudang', $data->id_gudang)
                ->where('id_produk', $data->id_produk)
                ->update(['updated_at' => now()]);

            $data->delete();

            return to_route('ProdukKeluar.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return to_route('ProdukKeluar.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
