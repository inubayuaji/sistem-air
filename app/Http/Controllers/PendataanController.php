<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Tagihan;
use App\Models\Pelanggan;
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

        // ajax data
        if (request()->ajax()) {
            $query = Pelanggan::where('desa_id', $req->desa_id ?? Desa::first()->id)
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
            Column::make('jarak'),
            Column::make('action')->class('text-right'),
        ]);

        return view('pendataan.index', ['table' => $table, 'desaId' => $req->desa_id ?? Desa::first()->id]);
    }

    public function edit($id)
    {
        $data =  Tagihan::findOrFail($id);

        return view('pendataan.form', ['isEdit' => true, 'data' => $data]);
    }

    public function update(Request $req, $id)
    {
        $data = $req->validate([
            'meter_lalu' => 'required|numeric',
            'meter_sekarang' => 'required|numeric',
            'jumlah_meter' => 'required|numeric',
        ]);

        $total = 0;

        if($data['jumlah_meter'] <= 5){
            $total = 25000;
        }

        if($data['jumlah_meter'] > 5){
            $total = ($data['jumlah_meter'] * 4000) + 5000;
        }

        $update = [
            'meter_lalu' => $data['meter_lalu'],
            'meter_sekarang' => $data['meter_sekarang'],
            'jumlah_meter' => $data['jumlah_meter'],
            'total' => $total,
            'status' => 2,
        ];

        $tagihan = Tagihan::where('id', $id)->update($update);

        return redirect()->route('admin.pendataan.tagihan', ['id' => Tagihan::find($id)->pelanggan_id]);
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
                ->orderBy('bulan', 'asc')
                ->get();

            return DataTables::of($query)
                ->editColumn('bulan', function($model)use ($bulan){
                    return $bulan[$model->bulan];
                })
                ->addColumn('action', function($model){
                    return $this->rowTagihanActions($model);
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
        $actions .= '<a href="' . route('admin.pendataan.tagihan', ['id' => $model->id]) . '#" class="mr-1 btn btn-success btn-sm"><i class="fas fa-money-bill"></i></a>';
        // $actions .= '<a href="' . route('admin.desa.detail', ['id' => $model->id]) . '" class="mr-1 btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
        
        return $actions;
    }

    protected function rowTagihanActions($model)
    {
        $actions = '';
        $actions .= '<a href="' . route('admin.pendataan.ubah', ['id' => $model->id]) . '" class="mr-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';

        return $actions;
    }
}
