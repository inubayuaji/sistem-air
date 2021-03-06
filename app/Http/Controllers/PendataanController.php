<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Desa;
use App\Models\Tagihan;
use App\Models\Pelanggan;
use App\Models\BukuTahun;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

/**
 * mengikuti standar laravel restfull controller
 * https://laravel.com/docs/5.1/controllers#restful-resource-controllers
 */

class PendataanController extends Controller
{
    // --- restfull function --- //

    public function index(Builder $builder, Request $req)
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

        $desaId = NULL;

        if($req->desa_id) {
            $desaId = $req->desa_id;
        }
        else {
            $desaId = Desa::first()->id ?? NULL;
        }

        // ajax data
        if (request()->ajax() and Auth::user()->hasPermissionTo('pendataan.daftar')) {
            $query = Pelanggan::where('desa_id', $desaId)
                ->get();

            return DataTables::of($query)
                ->addColumn('action', function($model){
                    return $this->rowActions($model);
                })
                ->make(true);
        }

        // membuat kolom tabel
        $table = $builder->columns([
            Column::make('no'),
            Column::make('nama'),
            Column::make('telepon'),
            Column::make('action')->class('text-right'),
        ]);

        return view('pendataan.index', ['table' => $table, 'desaId' => $desaId]);
    }

    public function edit($id, $tagihan_id)
    {
        $data =  Tagihan::findOrFail($tagihan_id);
        $data->meter_lalu = 0;
        $data->jumlah_meter = 0;

        if($data->bulan > 1) {
            $data->meter_lalu = Tagihan::where('pelanggan_id', $data->pelanggan_id)
                ->where('bulan', $data->bulan - 1)
                ->where('buku_tahun_id', BukuTahun::getTahunAktif()->id)
                ->first()
                ->meter_sekarang;
        }

        if($data->meter_lalu < $data->meter_sekarang){
            $data->jumlah_meter = $data->meter_sekarang - $data->meter_lalu;
        }

        return view('pendataan.form', ['isEdit' => true, 'data' => $data]);
    }

    public function update(Request $req, $id, $tagihan_id)
    {
        $data = $req->validate([
            'meter_lalu' => 'required|numeric',
            'meter_sekarang' => 'required|numeric',
            'jumlah_meter' => 'required|numeric|min:0',
        ]);

        $total = 0;

        if($data['jumlah_meter'] <= 5){
            $total = 25000;
        }

        if($data['jumlah_meter'] > 5){
            $total = ($data['jumlah_meter'] * 4000) + 5000;
        }

        $update = [
            'petugas_id' => Auth::user()->id,
            'meter_lalu' => $data['meter_lalu'],
            'meter_sekarang' => $data['meter_sekarang'],
            'jumlah_meter' => $data['jumlah_meter'],
            'total' => $total,
            'status' => 2,
        ];

        $tagihan = Tagihan::where('id', $tagihan_id)->update($update);

        return redirect()->route('admin.pendataan.tagihan', ['id' => Tagihan::find($tagihan_id)->pelanggan_id]);
    }

    public function tagihan(Builder $builder, $id)
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

        // ajax data
        if (request()->ajax()) {
            $query = Tagihan::where('pelanggan_id', $id)
                ->where('buku_tahun_id', BukuTahun::getTahunAktif()->id)
                ->orderBy('bulan', 'asc')
                ->get();

            return DataTables::of($query)
                ->editColumn('petugas_id', function($model){
                    return $model->petugas->nama ?? null;
                })
                ->editColumn('bulan', function($model)use ($bulan){
                    return $bulan[$model->bulan];
                })
                ->addColumn('action', function($model) use ($id){
                    return $this->rowTagihanActions($model, $id);
                })
                ->make(true);
        }

        // membuat kolom tabel
        $table = $builder->columns([
            Column::make('bulan'),
            Column::make('petugas_id')->title('Petugas'),
            Column::make('meter_lalu'),
            Column::make('meter_sekarang'),
            Column::make('jumlah_meter'),
            Column::make('total'),
            Column::make('bayar'),
            Column::make('action')->class('text-right'),
        ]);

        return view('pelanggan.tagihan', ['table' => $table]);
    }

    // --- helper function --- //

    // aksi untuk per row tabel
    protected function rowActions($model)
    {
        $actions = '';
        if(Auth::user()->hasPermissionTo('pendataan.tagihan')){
            $actions .= '<a href="' . route('admin.pendataan.tagihan', ['id' => $model->id]) . '#" class="mr-1 btn btn-success btn-sm"><i class="fas fa-money-bill"></i></a>';
        }
        // $actions .= '<a href="' . route('admin.desa.detail', ['id' => $model->id]) . '" class="mr-1 btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
        
        return $actions;
    }

    protected function rowTagihanActions($model, $id)
    {
        $actions = '';
        if(Auth::user()->hasPermissionTo('pendataan.tagihan_ubah')){
            $actions .= '<a href="' . route('admin.pendataan.ubah', ['id' => $id, 'tagihan_id' => $model->id]) . '" class="mr-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';
        }

        return $actions;
    }
}
