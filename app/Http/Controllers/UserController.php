<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser(User $user)
    {
        $petugas = $user->orderBy('nama_user', 'asc')->paginate(5);
        return view('dashboard.masterUser', compact('petugas'));
    }

    public function addUser(Request $request)
    {
        $this->validate(
            $request,
            [
                'nik' => 'required|min:10|max:10|unique:users',
                'nama_user' => 'required',
                'role' => 'required|',
                'password' => 'required|min:3|confirmed',
            ],
            [
                'nik.min' => 'NIK terlalu pendek',
                'nik.max' => 'NIK terlalu panjang',
                'nik.required' => 'NIK Tidak Boleh Kosong!',
                'nama_user.required' => 'Nama User Tidak Boleh Kosong!',
                'role.required' => 'Role Tidak Boleh Kosong!',
                'password.required' => 'Password Tidak Boleh Kosong!',
                'password.min' => 'Kata Sandi Minimal 8 Karakter',
                'min' => 'Minimal 3 huruf',
                'confirmed' => 'Password tidak sama',
                'unique' => 'NIK sudah digunakan. Silahkan ganti NIK.',
            ]
        );
        User::create([
            'nik' => $request->nik,
            'nama_user' => ucfirst($request->nama_user),
            'role' => $request->role,
            'password' => bcrypt($request->password)
        ]);
        return redirect('/master/user')->with('status', 'Data User Telah Ditambahkan');
    }

    public function editUser(User $user)
    {
        $getUser = $user->where('user_id', $user->user_id)->first();
        return view('dashboard.editUser', compact('getUser'));
    }
    public function updateUser(User $user, Request $request)
    {
        $getRequest = $request->validate(
            [
                'nama_user' => 'required|min:3|',
                'nik' => 'required|min:10|max:10',
                'role' => 'required',
            ],
            [
                'required' => 'Form Wajib diisi!',
                'nik.min' => 'NIK Minimal 10 Karakter',
                'nik.max' => 'NIK Maksimal 10 Karakter',
                'nama_user.min' => 'Nama User Minimal 3 Karakter',
            ]
        );

        //Percabangan jika rubah password
        if ($request->password) {
            $request->validate(
                [
                    'password' => 'min:3|confirmed'
                ],
                [
                    'min' => 'Kata Sandi Minimal 3 karakter',
                    'confirmed' => 'Kata Sandi tidak sesuai'
                ]
            );
            $getRequest['password'] = bcrypt($request->password);
        }

        $user->update($getRequest);
        return redirect('/master/user')->with('status', 'Data User telah dirubah');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect('/master/user')->with('status', 'Data User telah dihapus');
    }
    public function profil()
    {
        return view('dashboard.profil');
    }

    public function changePassword()
    {
        return view('dashboard.changePassword');
    }

    public function newPassword(Request $request, User $user)
    {
        $getRequest = $request->validate(
            [
                'password' => 'required|min:3|confirmed'
            ],
            [
                'required' => 'Kata Sandi tidak boleh kosong',
                'min' => 'Kata Sandi Minimal 3 karakter',
                'confirmed' => 'Kata Sandi tidak sesuai'
            ]
        );
        $getRequest['password'] = bcrypt($request->password);
        $user->update($getRequest);
        return redirect('/changePassword')->with('status', 'Kata Sandi berhasil diubah');
    }
}
