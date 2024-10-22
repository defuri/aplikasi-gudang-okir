<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\kategoriModel;
use Illuminate\Support\Facades\Auth;

class kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $kategori = kategoriModel::orderBy('id', 'asc')->paginate(10);

        $user = Auth::user();

        return view('CRUD.kategori', compact('kategori', 'user'));
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
                'nama' => 'string|required|max:40',
            ]);

            kategoriModel::create([
                "nama" => $request->nama,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);

            return to_route('kategori.index')->with('success', 'data berhasil disimpan');
        } catch (\Throwable $th) {
            return to_route('kategori.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
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
                "nama" => "string|required|max:40",
            ]);

            $data = kategoriModel::findOrFail($id);

            $data->update([
                "nama" => $request->nama,
                "updated_at" => Carbon::now(),
            ]);

            return to_route('kategori.index')->with('success', 'data berhasil dirubah');
        } catch (\Throwable $th) {
            return to_route('kategori.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = kategoriModel::findOrFail($id);

            $data->delete();

            return to_route('kategori.index')->with('success', 'data berhasil dihapus');
        } catch (\Throwable $th) {
            return to_route('kategori.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
