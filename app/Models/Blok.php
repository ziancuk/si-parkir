<?php

namespace App\Models;

use App\Models\Parking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blok extends Model
{
    protected $primaryKey = 'blok_id';
    protected $fillable = [
        'nama_blok', 'kapasitas'
    ];

    public function parking()
    {
        return $this->hasOne(Parking::class);
    }
}
