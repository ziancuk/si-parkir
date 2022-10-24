<?php

namespace App\Http\Controllers;

use App\Models\Blok;
use App\Models\Driver;
use App\Models\Employee;
use App\Models\Parking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BarcodeController extends Controller
{
    public function setparkirMasuk(Request $request, Parking $parking)
    {
        $pengendara = Driver::with('employee')->where('qr_code', $request->qr_code)->first();
        if ($pengendara) {
            $getParkir = Parking::with('driver')->where('driver_id', $pengendara->driver_id)->first();
            if (!$getParkir) {
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
                    'petugas_out' => 'Ucok',
                    'status' => 'Masuk'
                ]);
                return response()->json($pengendara);
            } else if (!$getParkir->status == 'Masuk') {
                $parkir = 'nok';
                return view('dashboard.parkirMasukNon', compact('parkir'));
            }
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
        $pengendara = Driver::with('employee')->where('barcode', $request->qr_code)->first();
        return response()->json($pengendara);
    }
}
