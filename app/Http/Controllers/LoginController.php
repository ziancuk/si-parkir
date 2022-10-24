<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('guest.login');
    }
    public function getRegister()
    {
        return view('guest.register');
    }
    public function register(User $user, Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:3',
                'nik_karyawan' => 'required|unique:users,nik|min:10|max:10',
                'code' => 'required',
                'password' => 'required|min:3|confirmed'
            ],
            [
                'required' => 'Form Tidak Boleh Kosong!',
                'nik_karyawan.min' => 'NIK Minimal 10 Karakter',
                'nik_karyawan.max' => 'NIK Maksimal 10 Karakter',
                'password.min' => 'Kata Sandi Minimal 3 Karakter',
                'min' => 'Minimal 3 huruf',
                'unique' => 'NIK anda sudah didaftarkan!',
                'confirmed' => 'Password tidak sesuai'
            ]
        );
        if ($request->code == 'regisparkir') {
            User::create([
                'nik' => $request->nik_karyawan,
                'nama_user' => ucfirst($request->name),
                'role' => '1',
                'password' => bcrypt($request->password)
            ]);
            return redirect('/')->with('status', 'Registrasi berhasil. Silahkan melakukan Login.');
        } else {
            return redirect()->back()->with('status', 'Kode Rahasia Salah!');
        }
    }
    public function login(Request $request)
    {
        if (Auth::attempt(['nik' => $request->nik, 'password' => $request->password])) {
            return redirect('/dashboard');
        }
        return redirect()->back()->with('error', 'Username/Password tidak sesuai');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
