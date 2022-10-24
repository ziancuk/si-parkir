<?php

namespace App\Models;

use App\Models\Driver;
use App\Models\Fault;
use App\Models\Blok;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $primaryKey = 'kode_parkir';
    public $incrementing = false;
    protected $fillable = [
        'kode_parkir', 'user_id', 'driver_id', 'blok_id', 'fault_id', 'jam_masuk', 'jam_keluar', 'petugas_out', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
    public function fault()
    {
        return $this->belongsTo(Fault::class, 'fault_id');
    }
    public function blok()
    {
        return $this->belongsTo(Blok::class, 'blok_id');
    }
}
