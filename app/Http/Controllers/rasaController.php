<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\rasaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class rasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $rasa = rasaModel::orderBy('id', 'desc')->paginate(10);

        $user = Auth::user();

        return view('CRUD.rasa', compact('rasa', 'user'));
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
                'nama' => 'required|string|max:15|unique:rasa,nama,id',
            ]);

            $rasa = rasaModel::create(
                [
                    'nama' => $request->nama,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );

            activity()
                ->useLog('Rasa')
                ->log('INSERT ID: ' . $rasa->id);

            return redirect()->route('rasa.index')->with('success', 'Data berhasil dibuat!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('rasa.index')->with('error', 'Error, terjadi kesalahan:' . $th->getMessage());
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
                'nama' => 'required|string|max:15|unique:rasa,nama,id',
            ]);

            $data = rasaModel::findOrFail($id);

            $data->update([
                'nama' => $request->nama,
                'updated_at' => Carbon::now(),
            ]);

            activity()
                ->useLog('Rasa')
                ->log('UPDATE ID: ' . $data->id);

            return redirect()->route('rasa.index')->with('success', 'Data berhasil diupdate!');
        } catch (\Throwable $th) {
            //throw $th;

            return redirect()->route('rasa.index')->with('error', 'Error, terjadi kesalahan: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = rasaModel::findOrFail($id);

            activity()
                ->useLog('Rasa')
                ->log('DELETE ID: ' . $data->id);

            $data->delete();

            return redirect()->route('rasa.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            //throw $th;

            return redirect()->route('rasa.index')->with('error', 'Error, terjadi kesalahan: '  . $th->getMessage());
        }
    }
}
