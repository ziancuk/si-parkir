<?php

namespace App\Models;

use App\Models\Parking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fault extends Model
{
    protected $primaryKey = 'fault_id';
    protected $fillable = [
        'role_pelanggaran', 'nama_pelanggaran', 'denda'
    ];

    public function parking()
    {
        return $this->hasOne(Parking::class);
    }
}
