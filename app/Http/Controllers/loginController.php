<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class loginController extends Controller
{
    //

    function index()
    {
        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        try {
            $credentials = $request->validate([
                'username' => ['required', 'max:20'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                $user = Auth::user();

                switch ($user->id_hak) {
                    case '1':
                        return redirect()->intended('/owner');
                    case '2';
                        return redirect()->intended('/produksi');
                    case '3';
                        return redirect()->intended('/gudang');
                    case '4';
                        return redirect()->intended('/lapangan');
                    case '5';
                        return redirect()->intented('/administrasi');
                    default:
                        return back()->with('error', 'Error: Username atau password salah ');
                }
            } else {
                return back()->with('error', 'Error: Username atau password salah ');
            }
        } catch (\Throwable $th) {
            return redirect('/login')->with('error', 'Error: Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
