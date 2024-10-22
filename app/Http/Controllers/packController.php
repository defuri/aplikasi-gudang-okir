<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\packModel;
use App\Models\satuanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class packController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $satuan = satuanModel::all();
        $pack = packModel::orderBy('id', 'asc')->paginate(10);
        $user = Auth::user();

        return view('CRUD.pack', compact('pack', 'satuan', 'user'));
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
                'ukuran' => 'integer|required',
                'id_satuan' => 'required|integer',
            ]);

            packModel::create([
                'nama' => $request->nama,
                'ukuran' => $request->ukuran,
                'id_satuan' => $request->id_satuan,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return to_route('pack.index')->with('success', 'data berhasil disimpan!');
        } catch (\Throwable $th) {
            return to_route('pack.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
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
                'ukuran' => 'integer|required',
                'id_satuan' => 'required|integer',
            ]);

            $data = packModel::findOrFail($id);

            $data->update([
                'nama' => $request->nama,
                'ukuran' => $request->ukuran,
                'id_satuan' => $request->id_satuan,
                'updated_at' => Carbon::now(),
            ]);

            return to_route('pack.index')->with('success', 'data berhasil dirubah!');
        } catch (\Throwable $th) {
            return to_route('pack.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = packModel::findOrFail($id);

            $data->delete();

            return to_route('pack.index')->with('success', 'data berhasil dihapus!');
        } catch (\Throwable $th) {
            return to_route('pack.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
