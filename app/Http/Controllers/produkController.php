<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\packModel;
use App\Models\rasaModel;
use App\Models\produkModel;
use Illuminate\Http\Request;
use App\Models\kategoriModel;
use Illuminate\Support\Facades\Auth;

class produkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getProducts()
    {
        $products = produkModel::all();
        return response()->json($products);
    }

    public function index()
    {
        //

        $rasa = rasaModel::all();
        $kategori = kategoriModel::all();
        $pack = packModel::all();
        $produk = produkModel::orderby('id', 'asc')->paginate(10);

        $user = Auth::user();

        return view('owner.produk', compact('rasa', 'kategori', 'pack', 'produk'));
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
            $request->validate([
                'nama' => 'string|required|max:40',
                'id_rasa' => 'integer|required',
                'id_kategori' => 'integer|required',
                'id_pack' => 'integer|required',
                'harga' => 'integer|required',
            ]);

            produkModel::create([
                'nama' => $request->nama,
                'id_rasa' => $request->id_rasa,
                'id_kategori' => $request->id_kategori,
                'id_pack' => $request->id_pack,
                'harga' => $request->harga,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return to_route('produk.index')->with('success', 'data berhasil disimpan');
        } catch (\Throwable $th) {
            return to_route('produk.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
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
                'nama' => 'string|required|max:40',
                'id_rasa' => 'integer|required',
                'id_kategori' => 'integer|required',
                'id_pack' => 'integer|required',
                'harga' => 'integer|required',
            ]);

            $data = produkModel::findOrFail($id);

            $data->update([
                'nama' => $request->nama,
                'id_rasa' => $request->id_rasa,
                'id_kategori' => $request->id_kategori,
                'id_pack' => $request->id_pack,
                'harga' => $request->harga,
                'updated_at' => Carbon::now(),
            ]);

            return to_route('produk.index')->with('success', 'data berhasil dirubah!');
        } catch (\Throwable $th) {
            return to_route('produk.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = produkModel::findOrFail($id);

            $data->delete();

            return to_route('produk.index')->with('success', 'data berhasil dihapus');
        } catch (\Throwable $th) {
            return to_route('produk.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
