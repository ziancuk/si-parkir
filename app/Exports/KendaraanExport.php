<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KendaraanExport implements FromCollection, WithMapping, WithHeadings
{

    protected $kendaraan;

    function __construct($kendaraan)
    {
        $this->kendaraan = $kendaraan;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->kendaraan;
    }
    public function map($member): array
    {
        $data = array(
            $member->driver->no_polisi,
            $member->driver->jenis_kendaraan
        );
        if ($member->driver->pengendara == 1) {
            $data[$member->driver->pengendara] = "Karyawan";
        } else {
            $data[$member->driver->pengendara] = "Non Karyawan";
        }
        $data[$member->jam_masuk] = $member->jam_masuk;
        if ($member->jam_keluar == NULL) {
            $data[$member->jam_keluar] = "Belum Keluar";
        } else {
            $data[$member->jam_keluar] = $member->jam_keluar;
        }
        return $data;
    }

    // this is fine
    public function headings(): array
    {
        return [
            'Nomor Polisi',
            'Kendaraan',
            'Pengendara',
            'Jam Masuk',
            'Jam Keluar'
        ];
    }
}
