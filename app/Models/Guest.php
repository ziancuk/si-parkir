<?php

namespace App\Models;

use App\Models\Driver;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $primaryKey = 'guest_id';
    protected $fillable =
    [
        'tipe_pengendara'
    ];

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }
}
