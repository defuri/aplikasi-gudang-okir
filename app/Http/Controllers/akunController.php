<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\hakModel;
use App\Models\akunModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class akunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $akun = akunModel::orderBy('id', 'desc')->paginate(10);
        $hak = hakModel::all();

        return view('CRUD.akun', compact('akun', 'hak'));
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
                'id_hak' => 'integer|required',
                'username' => 'string|required|unique:users,username',
                'password' => 'string|required',
                'confirmPassword' => 'string|required|same:password',
            ]);

            // Lakukan pengecekan kecocokan password dan confirm password
            if ($request->password === $request->confirmPassword) {
                $akun = akunModel::create([
                    'username' => $request->username,
                    'id_hak' => $request->id_hak,
                    'password' => bcrypt($request->password),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                // Gunakan ID dari objek yang baru dibuat
                activity()
                    ->useLog('Akun')
                    ->log('INSERT ID: ' . $akun->id);

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

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'id_hak' => 'integer|required',
                'username' => 'string|required|unique:users,username,' . $id,
            ]);

            $akun = akunModel::findOrFail($id);

            $forceLogout = false;

            // Cek apakah user sedang login mencoba mengubah password
            if ($request->passwordBaru != null) {
                $request->validate([
                    'passwordBaru' => ['required', Password::min(1)],
                    'konfirmasiPasswordBaru' => ['required', Password::min(1)],
                ]);

                if ($request->passwordBaru != $request->konfirmasiPasswordBaru) {
                    return redirect()->back()->with('error', 'Password baru dengan konfirmasinya tidak sama');
                }

                $akun->update([
                    'password' => bcrypt($request->passwordBaru),
                ]);

                if ($akun->id == Auth::id()) {
                    $forceLogout = true;
                }
            }

            // Cek apakah id_hak diubah
            if ($akun->id_hak != $request->id_hak) {
                // Jika id_hak == 1 (misalnya Admin), lakukan pengecekan
                if ($akun->id_hak == 1) {
                    // Hitung berapa akun yang memiliki id_hak == 1
                    $countAdmin = akunModel::where('id_hak', 1)->count();

                    // Jika hanya ada satu akun dengan id_hak == 1, cegah perubahan
                    if ($countAdmin <= 1) {
                        return redirect()->back()->with('error', 'Tidak bisa mengubah hak akun ini, karena ini adalah satu-satunya akun dengan hak super admin.');
                    }
                }

                // Update id_hak jika lolos dari pengecekan
                $akun->update([
                    'id_hak' => $request->id_hak,
                ]);

                if ($akun->id == Auth::id()) {
                    $forceLogout = true;
                }
            }

            // Update username dan updated_at
            $akun->update([
                'username' => $request->username,
                'updated_at' => Carbon::now(),
            ]);

            // Logout jika user yang login terpengaruh
            if ($forceLogout) {
                Auth::logout();
                return redirect()->route('login')->with('success', 'Perubahan dilakukan. Silakan login kembali.');
            }

            activity()
                ->useLog('Akun')
                ->log('UPDATE ID: ' . $akun->id);

            Auth::logout();

            return redirect()->route('login')->with('success', 'Data berhasil dirubah!');
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

            if ($data->id_hak == 1) {
                // Hitung berapa akun yang memiliki id_hak == 1
                $countAdmin = akunModel::where('id_hak', 1)->count();

                // Jika hanya ada satu akun dengan id_hak == 1, cegah perubahan
                if ($countAdmin <= 1) {
                    return redirect()->back()->with('error', 'Tidak bisa menghapus akun ini, karena ini adalah satu-satunya akun dengan hak super admin.');
                }
            }

            $data->delete();

            activity()
                ->useLog('Akun')
                ->log('DELETE ID: ' . $data->id);

            return redirect()->route('akun.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('akun.index')->with('error', 'Data gagal dihapus: ' . $th->getMessage());
        }
    }
}
