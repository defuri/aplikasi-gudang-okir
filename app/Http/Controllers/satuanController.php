<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\satuanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class satuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSatuan = satuanModel::orderBy('id', 'asc')->paginate(10);
        $jumlahData = $dataSatuan->total(); // Menggunakan total() untuk mendapatkan jumlah total data


        $user = Auth::user();

        if ($user->id_hak == 1) {
            return view('owner.satuan', compact('dataSatuan', 'jumlahData'));
        } else {
            return view('produksi.satuan', compact('dataSatuan', 'jumlahData'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.satuan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:20|unique:satuan,nama'
            ]);

            satuanModel::create([
                'nama' => $request->nama,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('satuan.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('satuan.index')->with('error', 'Data gagal disimpan: '. $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:20|unique:satuan,nama,' . $id // Mengabaikan ID saat memvalidasi keunikan
            ]);

            $data = satuanModel::findOrFail($id);

            $data->update([
                'nama' => $request->nama,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('satuan.index')->with('success', 'Data berhasil dirubah!');

        } catch (\Throwable $th) {
            return redirect()->route('satuan.index')->with('error', 'Data gagal dirubah: '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = satuanModel::findOrFail($id);
            $data->delete();

            return redirect()->route('satuan.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('satuan.index')->with('error', 'Data gagal dihapus: '.$th->getMessage());
        }
    }
}
