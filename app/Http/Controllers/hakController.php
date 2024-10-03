<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\hakModel;
use Illuminate\Http\Request;

class hakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $hak = hakModel::orderBy('id')->paginate(10);

        return view('owner.hak', compact('hak'));
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
                'nama' => 'required|string|max:20|unique:satuan,nama'
            ]);

            hakModel::create([
                'nama' => $request->nama,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('hak.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('hak.index')->with('error', 'Data gagal disimpan: '. $th->getMessage());
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = hakModel::findOrFail($id);
            $data->delete();

            return redirect()->route('hak.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('hak.index')->with('error', 'Data gagal dihapus: '.$th->getMessage());
        }
    }
}
