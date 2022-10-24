<?php

namespace App\Http\Controllers;

use App\Models\Fault;
use Illuminate\Http\Request;

class FaultController extends Controller
{
    public function getFault(Fault $fault)
    {
        $pelanggaran = $fault->orderBy('role_pelanggaran', 'asc')->paginate(5);
        return view('dashboard.masterFault', compact('pelanggaran'));
    }

    public function addFault(Request $request)
    {
        $pelanggaran = $request->validate(
            [
                'role_pelanggaran' => 'required|max:1|unique:faults',
                'nama_pelanggaran' => 'required|unique:faults',
                'denda' => 'required'
            ],
            [
                'max' => 'Role Pelanggaran cukup satu angka',
                'role_pelanggaran.required' => 'Form Role Pelanggaran tidak boleh kosong',
                'nama_pelanggaran.required' => 'Nama Pelanggaran tidak boleh kosong',
                'denda.required' => 'Form Denda tidak boleh kosong',
                'role_pelanggaran.unique' => 'Role pelanggaran sudah ada. Tidak boleh sama!',
                'nama_pelanggaran.unique' => 'Nama pelanggaran sudah ada. Tidak boleh sama!'
            ]
        );

        Fault::create($pelanggaran);
        return redirect('/master/fault')->with('status', 'Data Pelanggaran Berhasil Ditambahkan');
    }

    public function editFault(Fault $fault)
    {
        $getFault = Fault::where('fault_id', $fault->fault_id)->first();
        return view('dashboard.editFault', compact('getFault'));
    }

    public function deleteFault(Fault $fault)
    {
        $fault->where('fault_id', $fault->fault_id)->first()->delete();
        return redirect('/master/fault')->with('status', 'Data Pelanggaran telah dihapus');
    }

    public function setFault(Request $request, Fault $fault)
    {
        //validasi untuk menambahkan data ke tabel blok
        $requestFault = $request->validate(
            [
                'nama_pelanggaran' => 'required',
                'role_pelanggaran' => 'required',
                'denda' => 'required'
            ],
            [
                'required' => 'Form tidak boleh kosong'
            ]
        );

        //menambahkan data ke tabel blok
        $fault->where('fault_id', $fault->fault_id)->update($requestFault);
        return redirect('/master/fault')->with('status', 'Data Pelanggaran Telah Diubah');
    }
}
