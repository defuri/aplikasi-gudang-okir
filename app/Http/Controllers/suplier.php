<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\suplier as ModelsSuplier;

class suplier extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //get suplier
        $suplier = ModelsSuplier::orderBy('id', 'asc')->paginate(10);

        $totalBaris = $suplier->total();

        $user = Auth::user();

        return view('crud.suplier', compact('suplier', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //validate form
            $request->validate([
                'nama' => 'required|string|max:40|unique:suplier,nama',
            ]);

            ModelsSuplier::create([
                'nama' => $request->nama,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('suplier.index')->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Exception $e) {
            // Menyimpan pesan flash ke session jika gagal
            return redirect()->route('suplier.index')->with('error', 'Data gagal dihapus: ' . $e->getMessage());
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
        $suplier = ModelsSuplier::findOrFail($id);

        return view('owner.suplier', compact('suplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            //validate form
            $request->validate([
                'nama' => 'required|string|max:40|unique:suplier,nama',
            ]);

            $suplier = ModelsSuplier::findOrFail($id);

            $suplier->update([
                'nama' => $request->nama,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('suplier.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            return redirect()->route('suplier.index')->with('error', 'Data gagal dirubah: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $suplier = ModelsSuplier::findOrFail($id);
            $suplier->delete();

            // Menyimpan pesan flash ke session jika berhasil
            return redirect()->route('suplier.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Menyimpan pesan flash ke session jika gagal
            return redirect()->route('suplier.index')->with('error', 'Data gagal dihapus: ' . $e->getMessage());
        }
    }
}
