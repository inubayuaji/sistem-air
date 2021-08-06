<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihan';

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }

    public function petugas()
    {
        return $this->hasOne(Admin::class, 'id', 'petugas_id');
    }

    public function pembayaran()
    {
        return $this->haMany(Pembayaran::class, 'id', 'tagihan_id');
    }
}
