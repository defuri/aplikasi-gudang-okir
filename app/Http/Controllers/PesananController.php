<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use Carbon\Carbon;
use App\Models\Pesanan;
use App\Models\pelanggan;
use App\Models\produkModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pesanan = Pesanan::with('pelanggan')->get();
        $produk = produkModel::all();
        $DetailPesanan = DetailPesanan::orderBy('pesanan_id', 'desc')->paginate(10);
        $pelanggan = pelanggan::all();

        return view('owner.pesanan', compact('pesanan', 'pelanggan', 'produk', 'DetailPesanan'));
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $request->validate([
                'pesanan_id' => 'integer|required', // * id pesanan $data->pesanan_id
                'pelanggan_id' => 'integer|required',
                'tanggal' => 'date| required',
                'id' => 'integer|required', // * id detail $data->id
                'produk_id' => 'integer|required',
                'jumlah' => 'integer|required',
            ]);

            $pesanan = Pesanan::find($request->pesanan_id);
            $pesanan->pelanggan_id = $request->pelanggan_id;
            $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
            $pesanan->tanggal = $tanggal;
            $pesanan->updated_at = now();
            $pesanan->save();

            $DetailPesanan = DetailPesanan::find($id);
            $DetailPesanan->produk_id = $request->produk_id;
            $HargaProduk = produkModel::find($request->produk_id)->harga; // * menghitung harga
            $DetailPesanan->jumlah = $request->jumlah;
            $DetailPesanan->total = $request->jumlah * $HargaProduk;
            $DetailPesanan->updated_at = now();
            $DetailPesanan->save();

            return redirect()->route('pesanan.index')->with('success', 'Data berhasil dirubah!');
        } catch (\Throwable $th) {
            return redirect()->route('pesanan.index')->with('error', 'Data gagal dirubah: ' . $th->getMessage());
        }
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
