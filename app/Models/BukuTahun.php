<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuTahun extends Model
{
    use HasFactory;

    protected $table = 'buku_tahun';

    public static function resetTahunAktif()
    {
        DB::table('buku_tahun')
            ->update(['status' => 0]);
    }

    public static function getTahunAktif()
    {
        return self::where('status', 1)
            ->first();
    }

    public static function setTahunAktif($id)
    {
        self::resetTahunAktif();

        return self::where('id', $id)
            ->update(['status' => 1]);
    }
}
