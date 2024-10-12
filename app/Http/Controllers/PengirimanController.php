<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPengiriman;
use Carbon\Carbon;
use App\Models\Pesanan;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengirimans = Pengiriman::orderBy('id', 'desc')->paginate(10);
        $pengirimanIDs = Pengiriman::pluck('pesanan_id')->toArray();
        $pesanans = Pesanan::whereNotIn('id', $pengirimanIDs)->orderBy('id', 'desc')->get();

        return view('owner.pengiriman', compact('pengirimans', 'pesanans'));
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
                'pesanan_id' => 'required|integer',
                'tanggal' => 'required|date',
            ]);

            $pengiriman = new Pengiriman();
            $pengiriman->pesanan_id = $request->pesanan_id;
            $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
            $pengiriman->tanggal = $tanggal;
            $pengiriman->created_at = now();
            $pengiriman->updated_at = now();
            $pengiriman->save();

            return redirect()->route('pengiriman.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('pengiriman.index')->with('error', 'Data gagal disimpan: ' . $th->getMessage());
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
            $request->validate(
                [
                    'tanggal' => 'required|date',
                ],
            );

            $pengiriman = Pengiriman::find($id);
            $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

            $pengiriman->tanggal = $tanggal;
            $pengiriman->updated_at = now();
            $pengiriman->save();

            return redirect()->route('pengiriman.index')->with('success', 'Data berhasil dirubah!');
        } catch (\Throwable $th) {
            return redirect()->route('pengiriman.index')->with('error', 'Data gagal dirubah: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $pengiriman = Pengiriman::find($id);
            $pengiriman->delete();

            return redirect()->route('pengiriman.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('pengiriman.index')->with('error', 'Data gagal dihapus: ' . $th->getMessage());
        }
    }
}
