<?php

namespace App\Http\Controllers;

use App\Models\Blok;
use App\Models\Driver;
use App\Models\Parking;
use Illuminate\Http\Request;

class BlokController extends Controller
{
    public function getBlok(Driver $driver, Blok $blok)
    {

        $area = $blok->orderBy('nama_blok', 'asc')->paginate(5);
        $blokA = Parking::whereHas('blok', function ($query) {
            $query->where('nama_blok', 'Blok A');
        })->where('status', 'Masuk')->count();

        $blokB = Parking::whereHas('blok', function ($query) {
            $query->where('nama_blok', 'Blok B');
        })->where('status', 'Masuk')->count();

        $blokC = Parking::whereHas('blok', function ($query) {
            $query->where('nama_blok', 'Blok C');
        })->where('status', 'Masuk')->count();

        $blokD = Parking::whereHas('blok', function ($query) {
            $query->where('nama_blok', 'Blok D');
        })->where('status', 'Masuk')->count();

        return view('dashboard.masterBlok', compact('area', 'blokA', 'blokB', 'blokC', 'blokD'));
    }

    public function addBlok(Request $request)
    {
        $bloks = $request->validate(
            [
                'nama_blok' => 'required|max:6|unique:bloks',
                'kapasitas' => 'required|max:4'
            ],
            [
                'nama_blok.required' => 'Nama Blok tidak boleh kosong!',
                'kapasitas.required' => 'Kapasitas tidak boleh kosong!',
                'nama_blok.max' => 'Nama blok terlalu panjang',
                'kapasitas.max' => 'Kapasitas melebihi maksimal',
                'unique' => 'Nama blok sudah ada'
            ]
        );

        Blok::create($bloks);
        return redirect('/master/blok')->with('status', 'Data Blok Berhasil Ditambahkan');
    }

    public function editBlok(Blok $blok)
    {
        $getBlok = Blok::where('blok_id', $blok->blok_id)->first();
        return view('dashboard.editBlok', compact('getBlok'));
    }

    public function setBlok(Request $request, Blok $blok)
    {
        //validasi untuk menambahkan data ke tabel blok
        $requestBlok = $request->validate(
            [
                'nama_blok' => 'required|max:6|',
                'kapasitas' => 'required|max:4'
            ],
            [
                'required' => 'Form tidak boleh kosong!',
                'nama_blok.max' => 'Nama blok terlalu panjang',
                'kapasitas.max' => 'Kapasitas melebihi maksimal',
            ]
        );

        //menambahkan data ke tabel blok
        $blok->where('blok_id', $blok->blok_id)->update($requestBlok);
        return redirect('/master/blok')->with('status', 'Blok Telah Diubah');
    }

    public function deleteBlok(Blok $blok)
    {
        $blok->where('blok_id', $blok->blok_id)->first()->delete();
        return redirect('/master/blok')->with('status', 'Data Blok telah dihapus');
    }
}
