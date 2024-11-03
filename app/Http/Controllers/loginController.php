<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Import Request yang benar
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class loginController extends Controller
{
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

                activity()
                    ->useLog('auth')
                    ->withProperties(['ip' => $request->ip(), 'user_agent' => $request->userAgent()])
                    ->log('LOGIN');

                switch ($user->id_hak) {
                    case '1':
                        return redirect()->intended('/owner');
                    case '2':
                        return redirect()->intended('/produksi');
                    case '3':
                        return redirect()->intended('/gudang-home');
                    default:
                        return back()->with('error', 'Error: Username atau password salah');
                }
            } else {
                return back()->with('error', 'Error: Username atau password salah');
            }
        } catch (\Throwable $th) {
            return redirect('/login')->with('error', 'Error: Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function logout(Request $request)
    {
        activity()
            ->useLog('auth')
            ->withProperties(['ip' => $request->ip(), 'user_agent' => $request->userAgent()])
            ->log('LOGOUT');

        Auth::logout();

        return redirect('/');
    }
}
