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

        $ProdukMasuk = ProdukMasukModel::orderBy('id')->paginate(10);
        $gudang = gudangModel::all();
        $produk = produkModel::all();

        return view('owner.produkMasuk', compact('ProdukMasuk', 'gudang', 'produk'));
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

            $stokExists = StokModel::where('id_gudang', $request->id_gudang)
                ->where('id_produk', $request->id_produk)
                ->exists();

            if ($stokExists) {
                StokModel::where('id_gudang', $request->id_gudang)
                    ->where('id_produk', $request->id_produk)
                    ->increment('stok', $request->jumlah);
            } else {
                StokModel::create([
                    'id_gudang' => $request->id_gudang,
                    'id_produk' => $request->id_produk,
                    'stok' => $request->jumlah,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            ProdukMasukModel::create([
                'id_gudang' => $request->id_gudang,
                'id_produk' => $request->id_produk,
                'jumlah' => $request->jumlah,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            StokModel::where('id_gudang', $request->id_gudang)
                ->where('id_produk', $request->id_produk)
                ->update(['updated_at' => now()]);

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
                'id_produk' => ['required', 'integer'],
                'jumlah' => ['required', 'integer'],
            ]);


            $data = ProdukMasukModel::findOrFail($id);

            $data->update([
                'id_gudang' => $request->id_gudang,
                'id_produk' => $request->id_produk,
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

            $data->delete();

            return to_route('ProdukMasuk.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return to_route('ProdukMasuk.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
