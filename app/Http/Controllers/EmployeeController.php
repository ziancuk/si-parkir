<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Employee;
use App\Models\Guest;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class EmployeeController extends Controller
{
    public function getEmployee(Driver $driver)
    {
        $karyawan = $driver->with('employee')->where('pengendara', 1)->orderBy('nik_karyawan', 'asc')->paginate(5);
        return view('dashboard.masterKaryawan', compact('karyawan'));
    }
    public function getNon(Driver $driver)
    {
        $non = $driver->with('guest')->where('pengendara', 2)->orderBy('created_at', 'asc')->paginate(10);
        return view('dashboard.masterNon', compact('non'));
    }
    public function destroyNon(Guest $guest)
    {
        $guest->delete();
        return redirect('/master/non-karyawan')->with('status', 'Data Telah dihapus');
    }

    public function editEmployee(Driver $driver)
    {
        $getEmployee = Driver::with('employee')->where('driver_id', $driver->driver_id)->first();
        return view('dashboard.editKaryawan', compact('getEmployee'));
    }

    public function setEmployee(Request $request, Driver $driver, Employee $employee)
    {
        //validasi untuk menambahkan data ke tabel blok
        $request->validate(
            [
                'nik_karyawan' => 'required|min:10|max:10',
                'nama_karyawan' => 'required',
                'departemen' => 'required',
                'no_polisi' => 'required',
                'jenis_kendaraan' => 'required',
            ],
            [
                'required' => 'Form tidak boleh kosong',
                'min' => 'NIK anda terlalu pendek',
                'max' => 'NIK anda terlalu panjang',
            ]
        );

        //menambahkan data ke tabel blok
        $driver->where('driver_id', $driver->driver_id)->update([
            'no_polisi' => $request->no_polisi
        ]);
        Employee::where('nik_karyawan', $driver->nik_karyawan)->update([
            'nik_karyawan' => $request->nik_karyawan,
            'nama_karyawan' => $request->nama_karyawan,
            'departemen' => $request->departemen,
        ]);
        return redirect('/master/karyawan')->with('status', 'Data Karyawan Telah Diubah');
    }

    public function deleteEmployee(Driver $driver)
    {
        $driver->where('driver_id', $driver->driver_id)->first()->delete();
        return redirect('/master/karyawan')->with('status', 'Data Kendaraan Karyawan telah dihapus');
    }

    public function getQR()
    {
        return view('guest.barcode');
    }
    public function addEmployee(Request $request)
    {
        $request->validate(
            [
                'nik_karyawan' => 'required|min:10|max:10',
                'nama_karyawan' => 'required',
                'departemen' => 'required',
                'no_polisi' => 'required'
            ],
            [
                'required' => 'Form tidak boleh kosong',
                'min' => 'NIK anda terlalu pendek',
                'max' => 'NIK anda terlalu panjang',
            ]
        );
        $karyawan = Employee::where('nik_karyawan', $request->nik_karyawan)->first();
        $gabungan = ($request->nik_karyawan . str_replace(' ', '', strtoupper($request->no_polisi)));
        $cekPlat = Driver::where('qr_code', $gabungan)->first();
        if ($cekPlat) {
            $gabungan = ($request->nik_karyawan . str_replace(' ', '', strtoupper($request->no_polisi)));
            $barcode = QrCode::size(300)->generate($gabungan);
            $div = $request->departemen;
            switch ($div) {
                case "ACL Maintenance";
                case "ADM AREA / DBM ADM";
                case "Area Operation";
                case "Development";
                    $blok = "Blok A";
                    break;
                case "Area Inventory";
                case "EDP";
                case "General Affair (GA)";
                case "HRD";
                    $blok = "Blok B";
                    break;
                case "License";
                case "Location";
                case "Franchising";
                case "FAD";
                    $blok = "Blok C";
                    break;
                default:
                    $blok = "Blok D";
            }
            return view('guest.getBarcode', compact('barcode', 'blok'));
        } else if ($karyawan) {
            $gabungan = ($request->nik_karyawan . str_replace(' ', '', strtoupper($request->no_polisi)));
            $barcode = QrCode::size(300)->generate($gabungan);
            $div = $request->departemen;
            switch ($div) {
                case "ACL Maintenance";
                case "ADM AREA / DBM ADM";
                case "Area Operation";
                case "Development";
                    $blok = "Blok A";
                    break;
                case "Area Inventory";
                case "EDP";
                case "General Affair (GA)";
                case "HRD";
                    $blok = "Blok B";
                    break;
                case "License";
                case "Location";
                case "Franchising";
                case "FAD";
                    $blok = "Blok C";
                    break;
                default:
                    $blok = "Blok D";
            }

            Driver::create([
                'nik_karyawan' => $request->nik_karyawan,
                'qr_code' => $gabungan,
                'no_polisi' => str_replace(' ', '', strtoupper($request->no_polisi)),
                'pengendara' => 1,
                'jenis_kendaraan' => $request->jenis_kendaraan
            ]);
            return view('guest.getBarcode', compact('barcode', 'blok'));
        } else {
            $gabungan = ($request->nik_karyawan . str_replace(' ', '', strtoupper($request->no_polisi)));
            $barcode = QrCode::size(300)->generate($gabungan);
            $div = $request->departemen;
            switch ($div) {
                case "ACL Maintenance";
                case "ADM AREA / DBM ADM";
                case "Area Operation";
                case "Development";
                    $blok = "Blok A";
                    break;
                case "Area Inventory";
                case "EDP";
                case "General Affair (GA)";
                case "HRD";
                    $blok = "Blok B";
                    break;
                case "License";
                case "Location";
                case "Franchising";
                case "FAD";
                    $blok = "Blok C";
                    break;
                default:
                    $blok = "Blok D";
            }

            $employee = Employee::create([
                'nik_karyawan' => $request->nik_karyawan,
                'nama_karyawan' => ucwords($request->nama_karyawan),
                'departemen' => $request->departemen
            ]);
            Driver::create([
                'nik_karyawan' => $employee->nik_karyawan,
                'no_polisi' => str_replace(' ', '', strtoupper($request->no_polisi)),
                'qr_code' => $gabungan,
                'pengendara' => 1,
                'jenis_kendaraan' => $request->jenis_kendaraan
            ]);
            return view('guest.getBarcode', compact('barcode', 'blok'));
        }
    }
}
