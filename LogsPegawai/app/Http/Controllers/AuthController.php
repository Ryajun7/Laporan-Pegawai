<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NIP' => 'required|unique:users',
            'Nama' => 'required',
            'email' => 'required|email|unique:users',
            'Jabatan' => 'required|in:Kepala Dinas,Kepala Bidang,Pegawai',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'NIP' => $request->NIP,
            'Nama' => $request->Nama,
            'email' => $request->email,
            'Jabatan' => $request->Jabatan,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('NIP', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }

        return back()->withErrors(['login' => 'NIP/Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
