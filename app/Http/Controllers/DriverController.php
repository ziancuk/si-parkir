<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Parking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function getKendaraan()
    {
        $kendaraan = Parking::with('user', 'driver', 'blok')->orderBy('created_at', 'asc')->paginate(5);
        return view('dashboard.masterKendaraan', compact('kendaraan'));
    }

    public function detailKendaraan(Parking $parking)
    {
        //query ke tabel parkir
        $getParkir = $parking->where('kode_parkir', $parking->kode_parkir)->with('driver', 'user', 'user', 'fault')->first();
        $tanggalMasuk = Carbon::parse($getParkir->created_at)->setTimezone('Asia/Jakarta')->toDate();
        $tanggalKeluar = Carbon::parse($getParkir->created_at);
        $driver = Driver::with('guest', 'employee')->where('driver_id', $getParkir->driver_id)->first();
        return view('dashboard.detailKendaraan', compact('getParkir', 'driver'));
    }
}
