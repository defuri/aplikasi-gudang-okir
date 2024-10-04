<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\suplier;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Http\Request;
use App\Models\bahanBakuModel;
use Illuminate\Support\Facades\Auth;

class bahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        //

        $bahanBaku = bahanBakuModel::with('suplier')->orderBy('id', 'asc')->paginate(10);
        $totalBaris = $bahanBaku->total();
        $suppliers = suplier::get();


        $user = Auth::user();

            return view('owner.bahanBaku', compact(['bahanBaku', 'totalBaris', 'suppliers']));
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

        try {
            $request->validate([
                'nama' => 'required|string|max:50',
                'id_suplier' => 'required|integer|exists:suplier,id',
            ]);

            bahanBakuModel::create([
                'nama' => $request->nama,
                'id_suplier' => $request->id_suplier, // Pastikan ini sesuai
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('bahanBaku.index')->with(['success' => 'Data berhasil disimpan!']);
        } catch(\Exception $e) {
            return redirect()->route('bahanBaku.index')->with(['error' => 'Data gagal disimpan: ' . $e->getMessage()]);
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
        $bahanBaku = bahanBakuModel::findOrFail($id);

        return view('owner.bahanBaku', compact('bahanBaku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            //validate form
            $request->validate([
                'nama' => 'required|string|max:50',
                'id_suplier' => 'required|integer|exists:suplier,id',
            ]);

            $bahanBaku = bahanBakuModel::findOrFail($id);

            $bahanBaku->update([
                'nama' => $request->nama,
                'id_suplier' => $request->id_suplier,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('bahanBaku.index')->with(['success' => 'Data Berhasil Diubah!']);

        } catch (\Exception $e) {
            return redirect()->route('bahanBaku.index')->with('error', 'Data gagal dirubah: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $bahanBaku = bahanBakuModel::findOrFail($id);
            $bahanBaku->delete();

            // Menyimpan pesan flash ke session jika berhasil
            return redirect()->route('bahanBaku.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Menyimpan pesan flash ke session jika gagal
            return redirect()->route('bahanBaku.index')->with('error', 'Data gagal dihapus: ' . $e->getMessage());
        }
    }
}
