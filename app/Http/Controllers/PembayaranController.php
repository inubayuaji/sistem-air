<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Tagihan;
use App\Models\Pelanggan;
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

    public function bayar(Request $req, $id, $tagihan_id)
    {
        $saldo = 0;
        $nominal = 0;
        $terbayar = 0;
        $statusBayar = 4; // lunas

        $data = $req->validate([
            'metode' => 'required',
            'nominal' => 'required|numeric'
        ]);

        // cek total tagihan
        $tagihan = Tagihan::findOrFail($tagihan_id);

        $saldo = $tagihan->pelanggan->saldo;

        // bayar cash
        if($data['metode'] == 'cash'){
            // bayar pertama
            if($tagihan->status == 2){
                // sisa
                if($tagihan->total < $data['nominal']){
                    $saldo += $data['nominal'] - $tagihan->total;
                    $nominal = $data['nominal'];
                    $terbayar = $tagihan->total;
                    $statusBayar = 4;
                }

                // pas
                if($tagihan->total == $data['nominal']){
                    $saldo += 0;
                    $nominal = $data['nominal'];
                    $terbayar = $tagihan->total;
                    $statusBayar = 4;
                }

                // kurang
                if($tagihan->total > $data['nominal']){
                    $saldo += 0;
                    $nominal = $data['nominal'];
                    $terbayar = $data['nominal'];
                    $statusBayar = 3;
                }
            }
            
            // bayar keduakali
            if($tagihan->status == 3){
                // sisa
                if(($tagihan->total - $tagihan->bayar) < $data['nominal']){
                    $saldo += ($tagihan->bayar + $data['nominal']) - $tagihan->total;
                    $nominal = $data['nominal'];
                    $terbayar = $tagihan->total;
                    $statusBayar = 4;
                }

                // pas
                if(($tagihan->total - $tagihan->bayar) == $data['nominal']){
                    $saldo += 0;
                    $nominal = $data['nominal'];
                    $terbayar = $tagihan->total;
                    $statusBayar = 4;
                }

                // kurang
                if(($tagihan->total - $tagihan->bayar) > $data['nominal']){
                    $saldo += 0;
                    $nominal = $data['nominal'];
                    $terbayar = $tagihan->bayar + $data['nominal'];
                    $statusBayar = 3;
                }
            }
        }
        // bayar saldo
        else{
            // cek apakah nominal mencukupi untuk melakukan pebayaran dengan saldo
            if($tagihan->pelanggan->saldo < $data['nominal']){
                return redirect()
                    ->back()
                    ->with(['saldo_kurang' => 'Saldo tidak mencukupi.']);
            }

            // bayar pertama
            if($tagihan->status == 2){
                // sisa
                if($tagihan->total < $data['nominal']){
                    $saldo -= $tagihan->total;
                    $nominal = $data['nominal'];
                    $terbayar = $tagihan->total;
                    $statusBayar = 4;
                }

                // pas
                if($tagihan->total == $data['nominal']){
                    $saldo -= $tagihan->total;
                    $nominal = $data['nominal'];
                    $terbayar = $tagihan->total;
                    $statusBayar = 4;
                }

                // kurang
                if($tagihan->total > $data['nominal']){
                    $saldo -= $data['nominal'];
                    $nominal = $data['nominal'];
                    $terbayar = $data['nominal'];
                    $statusBayar = 3;
                }
            }

            // bayar kedaukali
            if($tagihan->status == 3){
                // sisa
                if(($tagihan->total - $tagihan->bayar) < $data['nominal']){
                    $saldo -= $tagihan->total - $tagihan->bayar;
                    $nominal = $data['nominal'];
                    $terbayar = $tagihan->total;
                    $statusBayar = 4;
                }

                // pas
                if(($tagihan->total - $tagihan->bayar) == $data['nominal']){
                    $saldo -= $data['nominal'];
                    $nominal = $data['nominal'];
                    $terbayar = $tagihan->total;
                    $statusBayar = 4;
                }

                // kurang
                if(($tagihan->total - $tagihan->bayar) > $data['nominal']){
                    $saldo -= $data['nominal'];
                    $nominal = $data['nominal'];
                    $terbayar = $tagihan->bayar + $data['nominal'];
                    $statusBayar = 3;
                }
            }
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
                'bayar' => $terbayar,
                'updated_at' => now()
            ]);

        // update saldo pelanggan
        Pelanggan::where('id', $id)
                ->update([
                    'saldo' => $saldo,
                    'updated_at' => now()
                ]);
        

        return redirect()->route('admin.pelanggan.tagihan', ['id' => $id]);
    }
}
