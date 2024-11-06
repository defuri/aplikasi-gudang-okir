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
        $dataSatuan = satuanModel::orderByDesc('id')->paginate(10);
        $jumlahData = $dataSatuan->total();

        $user = Auth::user();

        return view('CRUD.satuan', compact('dataSatuan', 'jumlahData', 'user'));
    }

    public function search(Request $request) {}

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:20|unique:satuan,nama'
            ]);

            // Membuat instance baru dari model
            $satuan = satuanModel::create([
                'nama' => $request->nama,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Mendapatkan ID terbaru dari instance yang baru saja dibuat
            $latestID = $satuan->id;

            activity()
                ->useLog('Satuan')
                ->log('INSERT ID: ' . $latestID);

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

            activity()
                ->useLog('Satuan')
                ->log('UPDATE ID: ' . $satuan->id);

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

            activity()
                ->useLog('Satuan')
                ->log('DELETE ID: ' . $satuan->id);

            return redirect()->route('satuan.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('satuan.index')->with('error', 'Data gagal dihapus: ' . $th->getMessage());
        }
    }
}
