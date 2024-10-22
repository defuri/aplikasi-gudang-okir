<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\gudangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            gudangModel::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

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

            return to_route('gudang.index')->with('success', 'data berhasil dihapus!');
        } catch (\Throwable $th) {
            return to_route('gudang.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
