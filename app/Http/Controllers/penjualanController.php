<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\produkModel;
use Illuminate\Http\Request;
use App\Models\penjualanModel;
use Illuminate\Support\Facades\Auth;

class penjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $penjualan = penjualanModel::orderBy('id', 'desc')->paginate(10);
        $produk = produkModel::all();

        return view('owner.penjualan', compact('penjualan', 'produk'));
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
                'tanggal' => 'required|string|max:20',
                'id_produk' => 'required|integer',
                'jumlah' => 'integer|required',
            ]);

            penjualanModel::create([
                'tanggal' => Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d'),
                'id_produk' => $request->id_produk,
                'jumlah' => $request->jumlah,
                'omzet' => produkModel::findOrFail($request->id_produk)->harga * $request->jumlah,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('penjualan.index')->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Exception $e) {
            return redirect()->route('penjualan.index')->with('error', 'Data gagal disimpan: ' . $e->getMessage());
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
                'tanggal' => 'required|string|max:20',
                'id_produk' => 'required|integer',
                'jumlah' => 'integer|required',
            ]);

            $data = penjualanModel::findOrFail($id);

            $data->update([
                'tanggal' => Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d'),
                'id_produk' => $request->id_produk,
                'jumlah' => $request->jumlah,
                'omzet' => produkModel::findOrFail($request->id_produk)->harga * $request->jumlah,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('penjualan.index')->with(['success' => 'Data berhasil dirubah!']);
        } catch (\Exception $e) {
            return redirect()->route('penjualan.index')->with('error', 'Data gagal dirubah: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = penjualanModel::findOrFail($id);

            $data->delete();

            return to_route('penjualan.index')->with('success', 'data berhasil dihapus!');
        } catch (\Throwable $th) {
            return to_route('penjualan.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
