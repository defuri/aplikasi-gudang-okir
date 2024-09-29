<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\stokModel;
use App\Models\gudangModel;
use App\Models\produkModel;
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

        if ($user->id_hak == 1) {
            return view('owner.stok', compact('stok', 'gudang', 'produk'));
        } else {
            return view('gudang.stok', compact('stok', 'gudang', 'produk'));
        }
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
                'id_gudang' => 'required|integer',
                'id_produk' => 'integer|required',
                'stok' => 'integer|required',
            ]);

            stokModel::create([
                'id_gudang' => $request->id_gudang,
                'id_produk' => $request->id_produk,
                'stok' => $request->stok,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('stok.index')->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Exception $e) {
            return redirect()->route('stok.index')->with('error', 'Data gagal disimpan: ' . $e->getMessage());
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
                'tanggal' => 'required|string|max:20',
                'id_gudang' => 'required|integer',
                'id_produk' => 'integer|required',
                'stok' => 'integer|required',
            ]);

            $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

            $data = stokModel::findOrFail($id);

            $data->update([
                'tanggal' => $tanggal,
                'id_gudang' => $request->id_gudang,
                'id_produk' => $request->id_produk,
                'stok' => $request->stok,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('stok.index')->with(['success' => 'Data berhasil dirubah!']);
        } catch (\Exception $e) {
            return redirect()->route('stok.index')->with('error', 'Data gagal dirubah: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = stokModel::findOrFail($id);

            $data->delete();

            return to_route('stok.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return to_route('stok.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
