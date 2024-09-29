<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\jabatanModel;
use Illuminate\Http\Request;
use App\Models\karyawanModel;
use App\Models\penggajianModel;

class penggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $karyawan = karyawanModel::all();
        $jabatan = jabatanModel::all();
        $penggajian = penggajianModel::orderBy('id')->paginate(10);

        return view('owner.penggajian', compact('karyawan', 'jabatan', 'penggajian'));
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
                'tanggal' => 'required|string',
                'id_karyawan' => 'required|integer',
                'lembur' => 'integer|required',
            ]);

            $tanggal = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');
            $gaji = jabatanModel::findOrFail($request->id_karyawan)->gaji;
            $total = $gaji + $request->lembur;

            $jabatan = karyawanModel::findOrFail($request->id_karyawan)->id_jabatan;


            penggajianModel::create([
                'tanggal' => $tanggal,
                'id_karyawan' => $request->id_karyawan,
                'id_jabatan' => $jabatan,
                'lembur' => $request->lembur,
                'total' => $total,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('penggajian.index')->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Exception $e) {
            return redirect()->route('penggajian.index')->with('error', 'Data gagal disimpan: ' . $e->getMessage());
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
                'tanggal' => 'required|string',
                'id_karyawan' => 'required|integer',
                'lembur' => 'integer|required',
            ]);

            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');

            $gaji = jabatanModel::findOrFail($request->id_karyawan)->gaji;
            $total = $gaji + $request->lembur;

            $jabatan = karyawanModel::findOrFail($request->id_karyawan)->id_jabatan;

            $dataYangMauDiEdit = penggajianModel::findOrFail($id);

            $dataYangMauDiEdit->update([
                'tanggal' => $tanggal,
                'id_karyawan' => $request->id_karyawan,
                'id_jabatan' => $jabatan,
                'lembur' => $request->lembur,
                'total' => $total,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('penggajian.index')->with(['success' => 'Data berhasil dirubah!']);
        } catch (\Exception $e) {
            return redirect()->route('penggajian.index')->with('error', 'Data gagal dirubah: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = penggajianModel::findOrFail($id);

            $data->delete();

            return redirect()->route('penggajian.index')->with(['success' => 'Data Berhasil dihapus!']);

        } catch (\Throwable $th) {
            return redirect()->route('penggajian.index')->with('error', 'Data gagal dihapus: ' . $th->getMessage());
        }
    }
}
