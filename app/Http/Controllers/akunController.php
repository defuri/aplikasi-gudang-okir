<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\hakModel;
use App\Models\akunModel;
use Illuminate\Http\Request;

class akunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $akun = akunModel::orderBy('id')->paginate(10);
        $hak = hakModel::all();

        return view('owner.akun', compact('akun', 'hak'));
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
                'id_hak' => 'integer|required',
                'username' => 'string|required|unique:users,username',
                'password' => 'string|required',
            ]);

            $password = $request->password;
            $confirmPassword = $request->confirmPassword;

            if ($password === $confirmPassword) {

                akunModel::create([
                    'username' => $request->username,
                    'id_hak' => $request->id_hak,
                    'password' => bcrypt($request->passwordBaru),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),

                ]);

                return redirect()->route('akun.index')->with('success', 'Data berhasil disimpan');

            } else {
                return redirect()->route('akun.index')->with('error', 'Data gagal disimpan: Password and confirm password doesn\'t match');
            }

        } catch (\Throwable $th) {
            return redirect()->route('akun.index')->with('error', 'Data gagal disimpan: ' . $th->getMessage());
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
                'id_hak' => 'integer|required',
                'username' => 'string|required|unique:users,username,' . $id,
                'passwordBaru' => 'string|required',
                'passwordLama' => 'string|required',
            ]);

            $akun = akunModel::findOrFail($id);
            $dataPasswordLama = $akun->password;
            $inputPasswordLama = $request->passwordLama;

            if ($dataPasswordLama === $inputPasswordLama) {

                $akun->update([
                    'username' => $request->username,
                    'id_hak' => $request->id_hak,
                    'password' => bcrypt($request->passwordBaru),
                    'updated_at' => Carbon::now(),
                ]);
                return redirect()->route('akun.index')->with('success', 'Data berhasil dirubah!');

            } else {
                return redirect()->route('akun.index')->with('error', 'Data gagal disimpan: Old password input is not the same as in the database');
            }

        } catch (\Throwable $th) {
            return redirect()->route('akun.index')->with('error', 'Data gagal disimpan: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $data = akunModel::findOrFail($id);
            $data->delete();

            return redirect()->route('akun.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('akun.index')->with('error', 'Data gagal dihapus: '.$th->getMessage());
        }
    }
}
