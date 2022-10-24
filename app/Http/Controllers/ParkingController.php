<?php

namespace App\Http\Controllers;

use App\Models\Blok;
use App\Models\Driver;
use App\Models\Fault;
use App\Models\Guest;
use App\Models\Parking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkingController extends Controller
{
    public function parkirMasukNon()
    {
        $parkir = null;
        return view('dashboard.parkirMasukNon', compact('parkir'));
    }

    public function postMasukNon(Request $request, Parking $parking)
    {
        //validasi untuk menambahkan data kendaraan masuk
        $this->validate(
            $request,
            [
                'no_polisi' => 'required|max:9|',
                'tipe_pengendara' => 'required',
                'jenis_kendaraan' => 'required'
            ],
            [
                'no_polisi.required' => 'Kolom Nomor Polisi Tidak Boleh Kosong',
                'tipe_pengendara.required' => 'Jenis Pengendara Tidak Boleh Kosong',
                'max' => 'Nomor Polisi Maksimal 9 Karakter'
            ]
        );

        $getPlat = Driver::with('employee', 'guest')->where('no_polisi', str_replace(' ', '', strtoupper($request->no_polisi)))->first();
        if ($getPlat) {
            $getParkir = Parking::with('driver')->where('driver_id', $getPlat->driver_id)->first();
            if ($getParkir->status == 'Masuk') {
                $parkir = 'nok';
                return view('dashboard.parkirMasukNon', compact('parkir'));
            }
        }

        //Membuat Kode Parkir
        $today = Carbon::now()->isoFormat('DMMYY');
        $last = $parking->latest('created_at')->first();
        if ($last) {
            $no = substr($last->kode_parkir, 9, 5);
            $no++;
            $kode_parkir = 'IDM' . $today . sprintf("%05s", $no);
        } else {
            $kode_parkir = 'IDM' . $today . sprintf("%05s", 1);
        }
        $blok = Blok::where('nama_blok', 'Blok D')->first();
        $date = Carbon::now()->setTimezone('Asia/Jakarta')->toDateTimeString();

        //Query database
        $tamu = Guest::create(['tipe_pengendara' => $request->tipe_pengendara]);

        $pengendara = Driver::create([
            'guest_id' => $tamu->guest_id,
            'no_polisi' => str_replace(' ', '', strtoupper($request->no_polisi)),
            'pengendara' => 2,
            'jenis_kendaraan' => $request->jenis_kendaraan
        ]);

        $parkir = $parking->create([
            'kode_parkir' => $kode_parkir,
            'user_id' => Auth::user()->user_id,
            'driver_id' => $pengendara->driver_id,
            'blok_id' => $blok->blok_id,
            'fault_id' => null,
            'jam_masuk' => $date,
            'petugas_out' => 'Belum Keluar',
            'status' => 'Masuk'
        ]);

        return view('dashboard.parkirMasukNon', compact('parkir', 'date', 'kode_parkir'));
    }

    public function parkirKeluarNon(Request $request)
    {
        //query tabel parkir sesuai dengan kode dari request

        $getParkir = Parking::with('driver', 'user', 'blok', 'fault')->where('kode_parkir', $request->kode_parkir)->first();

        if ($getParkir) {
            //validasi kode parkir apakah kode sudah pernah dipakai atau tidak
            if ($getParkir->status == 'Keluar') {
                $alert = 'keluar';
                return view('dashboard.parkirKeluarNon', compact('getParkir', 'alert'));
            } else {
                //jika kode parkir sesuai
                $jam_keluar = Carbon::now()->setTimezone('Asia/Jakarta');
                $keluar = strtotime($jam_keluar);

                //update data ke tabel parkir
                $getParkir->update([
                    'jam_keluar' => $jam_keluar,
                    'petugas_out' => Auth::user()->user_id,
                    'status' => 'Keluar'
                ]);
                $alert = 'bayar';
                return view('dashboard.parkirKeluarNon', compact('getParkir', 'alert'));
            }
        } else if ($request->kode_parkir) {
            $alert = 'notCode';
            return view('dashboard.parkirKeluarNon', compact('getParkir', 'alert'));
        } else {
            $alert = null;
            return view('dashboard.parkirKeluarNon', compact('getParkir', 'alert'));
        }
    }

    public function pelanggaran(Request $request, Parking $parking)
    {
        //query tabel parkir sesuai dengan kode dari request
        $penalti = Fault::get();
        $getKendaraan = Driver::where('no_polisi', str_replace(' ', '', strtoupper($request->no_polisi)))->first();
        if ($getKendaraan) {
            $getParkir = $parking->with('user', 'driver', 'fault', 'blok')->where('driver_id', $getKendaraan->driver_id)->latest()->first();
        } else {
            $getParkir = null;
        }
        if ($getParkir) {
            //validasi kode parkir apakah kode sudah pernah dipakai atau tidak
            if ($getParkir->status !== 'Masuk') {
                $alert = 'keluar';
                return view('dashboard.pelanggaranNon', compact('getParkir', 'alert', 'penalti'));
            } else {
                //jika kode parkir sesuai
                $jam_keluar = Carbon::now()->setTimezone('Asia/Jakarta');
                $keluar = strtotime($jam_keluar);

                $pelanggaran = Fault::where('role_pelanggaran', $request->role_pelanggaran)->first();

                //update data ke tabel parkir
                $getParkir->update([
                    'fault_id' => $pelanggaran->fault_id,
                    'jam_keluar' => $jam_keluar,
                    'petugas_out' => Auth::user()->user_id,
                    'status' => 'Fault'
                ]);
                $hasil_rupiah = "Rp" . number_format($pelanggaran->denda, 2, ',', '.');
                $alert = 'bayar';
                return view('dashboard.pelanggaranNon', compact('getParkir', 'hasil_rupiah', 'alert', 'getKendaraan', 'pelanggaran', 'penalti'));
            }
        } else if ($request->no_polisi) {
            $alert = 'notCode';
            return view('dashboard.pelanggaranNon', compact('getParkir', 'alert', 'penalti'));
        } else {
            $alert = null;
            return view('dashboard.pelanggaranNon', compact('getParkir', 'alert', 'penalti'));
        };
        return view('dashboard.pelanggaranNon');
    }

    public function setParkirMasuk(Request $request, Parking $parking)
    {
        $pengendara = Driver::with('employee')->where('qr_code', $request->qr_code)->first();
        if ($pengendara) {
            $getParkir = Parking::with('driver')->where('driver_id', $pengendara->driver_id)->latest()->first();
            if ($getParkir !== 'Masuk') {
                $today = Carbon::now()->isoFormat('DMMYY');
                $last = $parking->latest('created_at')->first();
                if ($last) {
                    $no = substr($last->kode_parkir, 9, 5);
                    $no++;
                    $kode_parkir = 'IDM' . $today . sprintf("%05s", $no);
                } else {
                    $kode_parkir = 'IDM' . $today . sprintf("%05s", 1);
                }
                $div = $pengendara->employee->departemen;
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
                $tempat = Blok::where('nama_blok', $blok)->first();
                $date = Carbon::now()->setTimezone('Asia/Jakarta')->toDateTimeString();

                $parkir = $parking->create([
                    'kode_parkir' => $kode_parkir,
                    'user_id' => Auth::user()->user_id,
                    'driver_id' => $pengendara->driver_id,
                    'blok_id' => $tempat->blok_id,
                    'fault_id' => null,
                    'jam_masuk' => $date,
                    'petugas_out' => 'Belum Keluar',
                    'status' => 'Masuk'
                ]);
                $masuk = $pengendara->toArray();
                $lok = $tempat->toArray();
                return response()->json(['masuk' => $masuk, 'lok' => $lok]);
            } else if ($getParkir->status == 'Masuk') {
                $parkir = 'nok';
                return view('dashboard.parkirMasukNon', compact('parkir'));
            }
        } else {
            return response()->json([
                "status" => "error",
                "msg" => "Error cuk",
                500
            ]);
        }
    }

    public function getParkirMasuk()
    {
        $pengendara = null;
        return view('dashboard.parkirMasuk', compact('pengendara'));
    }

    public function getParkirKeluar()
    {
        $pengendara = null;
        return view('dashboard.parkirKeluar', compact('pengendara'));
    }

    public function parkirKeluar(Request $request)
    {
        $pengendara = Driver::with('employee')->where('qr_code', $request->qr_code)->first();
        if ($pengendara !== null) {
            $getParkir = Parking::with('driver')->where('driver_id', $pengendara->driver_id)->latest()->first();
            if ($getParkir->status == 'Masuk') {
                $jam_keluar = Carbon::now()->setTimezone('Asia/Jakarta');
                $date = Carbon::now()->setTimezone('Asia/Jakarta')->toDateTimeString();

                //update data ke tabel parkir
                $getParkir->update([
                    'jam_keluar' => $jam_keluar,
                    'petugas_out' => Auth::user()->user_id,
                    'status' => 'Keluar'
                ]);
                $drive = $pengendara->toArray();
                $parkir = $getParkir->toArray();
                return response()->json(['date' => $date, 'drive' => $drive, 'parkir' => $parkir]);
            } else if ($getParkir->status == 'Keluar') {
                return response()->json([
                    "status" => "error",
                    "msg" => "Error cuk",
                    500
                ]);
            }
        } else {
            return response()->json([
                "status" => "error",
                "msg" => "Data Tidak Ada",
                500
            ]);
        }
    }
    public function destroyKendaraan(Parking $parking)
    {
        $driver = Driver::where('driver_id', $parking->driver_id)->first();
        if ($driver->employee !== NULL) {
            $driver->delete();
        } else {
            Guest::where('guest_id', $driver->guest_id)->delete();
        }
        return redirect('/report')->with('status', 'Data telah dihapus');
    }
}
