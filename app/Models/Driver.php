<?php

namespace App\Models;

use App\Models\Parking;
use App\Models\Employee;
use App\Models\Guest;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $primaryKey = 'driver_id';
    protected $fillable = [
        'driver_id', 'qr_code', 'nik_karyawan', 'guest_id', 'pengendara', 'no_polisi', 'jenis_kendaraan'
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'nik_karyawan');
    }
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }

    public function parking()
    {
        return $this->hasOne(Parking::class);
    }
}
