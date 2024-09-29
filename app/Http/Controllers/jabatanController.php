<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\jabatanModel;
use Illuminate\Http\Request;

class jabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jabatan = jabatanModel::orderBy('id', 'asc')->paginate(10);

        return view('owner.jabatan', compact('jabatan'));
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
                'nama' => 'required|string|max:50|unique:jabatan,nama',
                'gaji' => 'required|integer',
            ]);

            jabatanModel::create([
                'nama' => $request->nama,
                'gaji' => $request->gaji,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('jabatan.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('jabatan.index')->with('error', 'Data gagal disimpan: '. $th->getMessage());
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
                'nama' => 'required|string|max:30|unique:satuan,nama',
                'gaji' => 'required|integer',
            ]);

            $data = jabatanModel::findOrFail($id);

            $data->update([
                'nama' => $request->nama,
                'gaji' => $request->gaji,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('jabatan.index')->with('success', 'Data berhasil dirubah!');

        } catch (\Throwable $th) {
            return redirect()->route('jabatan.index')->with('error', 'Data gagal dirubah: '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = jabatanModel::findOrFail($id);
            $data->delete();

            return redirect()->route('jabatan.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('jabatan.index')->with('error', 'Data gagal dihapus: '.$th->getMessage());
        }
    }
}
