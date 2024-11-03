<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\satuanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class satuanController extends Controller
{
    public function index()
    {
        $dataSatuan = satuanModel::orderBy('id', 'desc')->paginate(10);
        $jumlahData = $dataSatuan->total();

        $user = Auth::user();

        return view('CRUD.satuan', compact('dataSatuan', 'jumlahData', 'user'));
    }

    public function search(Request $request)
    {
    }

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
            return redirect()->route('satuan.index')->with('error', 'Data gagal disimpan: ' . $th->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        $satuan = satuanModel::findOrFail($id);

        try {
            $request->validate([
                'nama' => 'required|string|max:20|unique:satuan,nama,' . $id
            ]);

            $satuan->update([
                'nama' => $request->nama,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('satuan.index')->with('success', 'Data berhasil dirubah!');
        } catch (\Throwable $th) {
            return redirect()->route('satuan.index')->with('error', 'Data gagal dirubah: ' . $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $satuan = satuanModel::findOrFail($id);

        try {
            $satuan->delete();
            return redirect()->route('satuan.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('satuan.index')->with('error', 'Data gagal dihapus: ' . $th->getMessage());
        }
    }
}
