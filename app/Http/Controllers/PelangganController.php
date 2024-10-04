<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pelanggan = pelanggan::orderBy('id')->paginate(10);

        return view('owner.pelanggan', compact('pelanggan'));
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
                'nama' => ['required', 'string', 'max:40'],
                'no_tlp' => ['required', 'string', 'max:20'],
                'alamat' => ['required', 'string'],
            ]);

            pelanggan::create([
                'nama' => $request->nama,
                'no_tlp' => $request->no_tlp,
                'alamat' => $request->alamat,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect('/owner/pelanggan')->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Exception $e) {
            return redirect('/owner/pelanggan')->with('error', 'Data gagal disimpan: ' . $e->getMessage());
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
                'nama' => ['required', 'string', 'max:40'],
                'no_tlp' => ['required', 'string', 'max:20'],
                'alamat' => ['required', 'string'],
            ]);

            $data = pelanggan::findOrFail($id);

            $data->update([
                'nama' => $request->nama,
                'no_tlp' => $request->no_tlp,
                'alamat' => $request->alamat,
                'updated_at' => now(),
            ]);

            return to_route('pelanggan.index')->with('success', 'data berhasil dirubah');
        } catch (\Throwable $th) {
            return to_route('pelanggan.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        try {
            $data = pelanggan::findOrFail($id);

            $data->delete();

            return redirect('/owner/pelanggan')->with('success', 'data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('/owner/pelanggan')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
