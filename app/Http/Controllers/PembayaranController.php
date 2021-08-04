<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    //
    public function index($id, $tagihan_id)
    {
        $bulan = [
            1 => '1. Januari',
            2 => '2. Februari',
            3 => '3. Maret',
            4 => '4. April',
            5 => '5. Mei',
            6 => '6. Juni',
            7 => '7. Juli',
            8 => '8. Agustus',
            9 => '9. September',
            10 => '10. Oktober',
            11 => '11. November',
            12 => '12. Desember',
        ];

        $data  = Tagihan::findOrFail($tagihan_id);

        $data->bulan = $bulan[$data->bulan];

        return view('pelanggan.pembayaran', [
            'data' => $data,
            'id' => $id,
            'tagihan_id' => $tagihan_id
        ]);
    }

    // asumsi pebayara cash belum menggunakan saldo
    public function bayar(Request $req, $id, $tagihan_id)
    {
        $slado = 0;
        $nominal = 0;
        $statusBayar = 4; // lunas

        $data = $req->validate([
            'nominal' => 'required|numeric'
        ]);

        // cek total tagihan
        $tagihan = Tagihan::findOrFail($tagihan_id);

        // bayar sebagian
        if($tagihan->total > $data['nominal']){
            $nominal = $data['nominal'];
            $statusBayar = 3; // sebagian
        }

        // bayar kelebihan nanti masuk saldo
        if($tagihan->total < $data['nominal']){
            $saldo = $data['nominal'] - $tagihan->total;
            $nominal = $tagihan->total;
        }

        // catat pembayaran
        Pembayaran::insert([
            'pelanggan_id' => $id,
            'petugas_id' => Auth::user()->id,
            'tagihan_id' => $tagihan_id,
            'nominal' => $nominal,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // update tagihan
        Tagihan::where('id', $tagihan_id)
            ->update([
                'status' => $statusBayar,
                'bayar' => $tagihan->bayar + $nominal,
            ]);
        

        return redirect()->route('admin.pelanggan.tagihan', ['id' => $id]);
    }
}
