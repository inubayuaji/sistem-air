<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index()
    {
        $pendataan = [
            (int)Tagihan::where('status', 1)
                ->where('bulan', (int)date('m'))
                ->count(),
            (int)Tagihan::where('status', '!=', 1)
                ->where('bulan', (int)date('m'))
                ->count()
        ];

        $pembayaran = [
            // sebagian
            (int)Tagihan::where('status', 3)
                ->where('bulan', (int)date('m'))
                ->sum('bayar'),

            // lunas
            (int)Tagihan::where('status', 4)
                ->where('bulan', (int)date('m'))
                ->sum('bayar'),

            // belum terbayar
            (int)Tagihan::where('status', 2)
                ->orWhere('status', 3)
                ->where('bulan', (int)date('m'))
                ->sum(\DB::raw('total - bayar'))
        ];

        return view('dash', [
            'pendataan' => $pendataan,
            'pembayaran' => $pembayaran,
        ]);
    }
}
