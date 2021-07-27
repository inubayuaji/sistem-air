<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    public function desa()
    {
        return $this->hasOne(Desa::class, 'id', 'desa_id');
    }

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'id', 'pelanggan_id');
    }
}
