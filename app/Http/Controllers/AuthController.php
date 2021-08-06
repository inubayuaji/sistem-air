<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function logout(Request $req)
    {
        Auth::logout();

        $req->session()->invalidate();

        $req->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function attempt(Request $req)
    {
        $credentials = $req->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();

            return redirect()->route('admin.dash');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function changePassword()
    {
        return view('ganti_password');
    }

    public function updatePassword(Request $req)
    {
        $data = $req->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            're_password' => 'required',
        ]);
        $admin = Auth::user();

        if(!Hash::check($data['old_password'], $admin->password)){
            return redirect()
                ->back()
                ->with(['gagal' => 'Password salah.']);
        }

        if($data['new_password'] != $data['re_password']){
            return redirect()
                ->back()
                ->with(['gagal' => 'Password tidak sama.']);
        }

        $admin->password = Hash::make($data['new_password']);

        return redirect()
            ->back()
            ->with(['berhasil' => 'Password berhasil diperbarui.']);
    }
}
