<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\stokModel;
use App\Models\gudangModel;
use App\Models\produkModel;
use Illuminate\Http\Request;
use App\Models\ProdukMasukModel;
use App\Models\ProdukKeluarModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class gudangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $gudang = gudangModel::orderBy('id', 'desc')->paginate(10);
        $user = Auth::user();

        return view('CRUD.gudang', compact('user', 'gudang'));
    }

    public function dashboard()
    {
        $totalProduk = produkModel::count();

        $countProdukMasuk = ProdukMasukModel::whereBetween('created_at', [Carbon::today(), Carbon::tomorrow()])->count();
        $countProdukKeluar = ProdukKeluarModel::whereBetween('created_at', [Carbon::today(), Carbon::tomorrow()])->count();
        $totalTransaksi = $countProdukMasuk + $countProdukKeluar;

        $stok = stokModel::all();

        function format_uang($angka)
        {
            if ($angka >= 1000000000) {
                return number_format($angka / 1000000000, 3) . ' M';
            } elseif ($angka >= 1000000) {
                return number_format($angka / 1000000, 3) . ' jt';
            } elseif ($angka >= 1000) {
                return number_format($angka / 1000, 1) . ' rb';
            } else {
                return number_format($angka);
            }
        }

        $nilaiInventori = 0;

        foreach ($stok as $currentStok) {
            $hargaProduknya = produkModel::where('id', $currentStok->id_produk)->first()->harga;
            $totalnya = $hargaProduknya * $currentStok->stok;

            $nilaiInventori += $totalnya;
        }

        $nilaiInventori = format_uang($nilaiInventori);

        $stokMenipis = stokModel::where('stok', '<', 1000)->select('id_produk', DB::raw('SUM(stok) as stok'))->groupBy('id_produk')->get();

        $logNames = ['gudang', 'Produk masuk', 'Produk Keluar', 'Stok'];

        $activity = Activity::whereIn('log_name', $logNames)->latest()->limit(10)->get();

        return view('gudang.index', compact('totalProduk', 'totalTransaksi', 'nilaiInventori', 'stokMenipis', 'activity'));
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
                'nama' => 'required|string|max:20|unique:satuan,nama',
                'alamat' => 'required|string',
            ]);

            $data = gudangModel::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            activity()
                ->useLog('Gudang')
                ->log('INSERT ID: ' . $data->id);

            return redirect()->route('gudang.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('gudang.index')->with('error', 'Data gagal disimpan: ' . $th->getMessage());
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
                'alamat' => 'string|required',
            ]);

            $data = gudangModel::findOrFail($id);

            $data->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'updated_at' => Carbon::now(),
            ]);

            activity()
                ->useLog('Gudang')
                ->log('UPDATE ID: ' . $data->id);

            return to_route('gudang.index')->with('success', 'data berhasil dirubah!');
        } catch (\Throwable $th) {
            return to_route('gudang.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = gudangModel::findOrFail($id);

            $data->delete();

            activity()
                ->useLog('Gudang')
                ->log('DELETE ID: ' . $data->id);

            return to_route('gudang.index')->with('success', 'data berhasil dihapus!');
        } catch (\Throwable $th) {
            return to_route('gudang.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function getGudang()
    {
        $gudang = gudangModel::all();

        return response()->json($gudang);
    }
}
