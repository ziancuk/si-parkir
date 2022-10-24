<?php

namespace App\Http\Controllers;

use App\Exports\KendaraanExport;
use App\Exports\MttRegistrationsExport;
use App\Models\Blok;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Driver;
use App\Models\Parking;
use Illuminate\Http\Request;
use PDF;
use phpDocumentor\Reflection\Types\Null_;

class DashboardController extends Controller
{
    public function index(Parking $parking)
    {
        // Resume Kendaraan
        $total = Parking::where('status', 'Masuk')->count();
        $mobil = Parking::whereHas('driver', function ($query) {
            $query->where('jenis_kendaraan', '1');
        })->where('status', 'Masuk')->count();
        $motor = Parking::whereHas('driver', function ($query) {
            $query->where('jenis_kendaraan', '2');
        })->where('status', 'Masuk')->count();
        $fault = Parking::with('user', 'driver', 'blok', 'fault')->where('status', 'fault')->get();

        // Resume Area Parking
        $area = Blok::get();
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

        // Data Master
        $master = Parking::with('user', 'driver', 'blok')->orderBy('created_at', 'desc')->paginate(5);
        return view('dashboard.index', compact('area', 'blokA', 'blokB', 'blokC', 'blokD', 'master', 'total', 'mobil', 'motor', 'fault'));
    }

    public function getReport()
    {
        $kendaraan = null;
        $total = null;
        return view('dashboard.report', compact('kendaraan', 'total'));
    }

    public function report(Request $request)
    {
        $request->validate(
            [
                'start_date' => 'required',
                'end_date' => 'required',
                'jenis_kendaraan' => 'required',
                'jenis_pengendara' => 'required'
            ],
            [
                'required' => 'Form tidak boleh kosong!'
            ]
        );
        if ($request->jenis_kendaraan == 'All' && $request->jenis_pengendara == 'All') {
            $kendaraan = Parking::with('driver')->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->paginate();
        } else if ($request->jenis_kendaraan == 'All') {
            $kendaraan = Parking::with('driver')->whereHas('driver', function ($query) use ($request) {
                $query->where('pengendara', $request->jenis_pengendara);
            })->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->paginate();
        } else if ($request->jenis_pengendara == 'All') {
            $kendaraan = Parking::with('driver')->whereHas('driver', function ($query) use ($request) {
                $query->where('jenis_kendaraan', $request->jenis_kendaraan);
            })->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->paginate();
        } else {
            $kendaraan = Parking::with('driver')->whereHas('driver', function ($query) use ($request) {
                $query->where('jenis_kendaraan', $request->jenis_kendaraan)->where('pengendara', $request->jenis_pengendara);
            })->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->paginate();
        }

        $parkir = Parking::with('driver')->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        $countKendaraan = $parkir->count();

        $countMobil = Parking::whereHas('driver', function ($query) {
            $query->where('jenis_kendaraan', '1');
        })->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->count();

        $countMotor = Parking::whereHas('driver', function ($query) {
            $query->where('jenis_kendaraan', '2');
        })->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->count();

        $countKaryawan = Parking::whereHas('driver', function ($query) {
            $query->where('pengendara', '1');
        })->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->count();

        $countNon = Parking::whereHas('driver', function ($query) {
            $query->where('pengendara', '2');
        })->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->count();
        if ($request->button == "submit") {
            $mulai = $request->start_date;
            $akhir = $request->end_date;
            $mesin = $request->jenis_kendaraan;
            $orang = $request->jenis_pengendara;
            return view('dashboard.report', compact('kendaraan', 'countKendaraan', 'countMobil', 'countMotor', 'countKaryawan', 'countNon', 'mulai', 'akhir', 'orang', 'mesin'));
        } else if ($request->button == "pdf") {
            $pdf = PDF::loadView('dashboard.generatePDF', compact('kendaraan'));
            return $pdf->download('report-parking.pdf');
        } else if ($request->button == "csv") {
            return Excel::download(new KendaraanExport($kendaraan), 'report-parking.xlsx');
        }
    }
    public function pelanggaran()
    {
        $parkir = Parking::with('driver')->where('status', 'Fault')->paginate(10);
        return view('dashboard.fault', compact('parkir'));
    }
}
