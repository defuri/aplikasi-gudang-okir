<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\divisiModel;
use App\Models\jabatanModel;
use Illuminate\Http\Request;
use App\Models\karyawanModel;

class karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jabatan = jabatanModel::all();
        $divisi = divisiModel::all();
        $karyawan = karyawanModel::orderBy('id', 'asc')->paginate(10);

        return view('owner.karyawan', compact('jabatan', 'divisi', 'karyawan'));
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
                'nama' => 'required|string|max:50|unique:karyawan,nama',
                'id_jabatan' => 'integer|required',
                'id_divisi' => 'integer|required',
                'alamat' => 'string|required',
                'no_tlp' => 'required|string|max:40|unique:karyawan,no_tlp',
            ]);

            karyawanModel::create([
                'nama' => $request->nama,
                'id_jabatan' => $request->id_jabatan,
                'id_divisi' => $request->id_divisi,
                'alamat' => $request->alamat,
                'no_tlp' => $request->no_tlp,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('karyawan.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('karyawan.index')->with('error', 'Data gagal disimpan: '. $th->getMessage());
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
                'nama' => 'required|string|max:50',
                'id_jabatan' => 'integer|required',
                'id_divisi' => 'integer|required',
                'alamat' => 'string|required',
                'no_tlp' => 'required|string|max:40|unique:karyawan,no_tlp,' .$id,
            ]);

            $data = karyawanModel::findOrFail($id);

            $data->update([
                'nama' => $request->nama,
                'id_jabatan' => $request->id_jabatan,
                'id_divisi' => $request->id_divisi,
                'alamat' => $request->alamat,
                'no_tlp' => $request->no_tlp,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('karyawan.index')->with('success', 'Data berhasil dirubah!');

        } catch (\Throwable $th) {
            return redirect()->route('karyawan.index')->with('error', 'Data gagal dirubah: '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = karyawanModel::findOrFail($id);
            $data->delete();

            return redirect()->route('karyawan.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('karyawan.index')->with('error', 'Data gagal dihapus: '.$th->getMessage());
        }
    }
}
