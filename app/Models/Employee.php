<?php

namespace App\Models;


use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $primaryKey = 'nik_karyawan';
    protected $fillable = [
        'nik_karyawan', 'nama_karyawan', 'departemen'
    ];
    public function driver()
    {
        return $this->hasMany(Driver::class);
    }
}
