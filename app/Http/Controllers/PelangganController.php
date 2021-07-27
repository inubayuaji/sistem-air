<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\BukuTahun;
use App\Models\Tagihan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class PelangganController extends Controller
{
    // --- restfull function --- //

    public function index(Builder $builder)
    {
        // ajax data
        if (request()->ajax()) {
            return DataTables::of(Pelanggan::query())
                ->addColumn('desa', function($model){
                    return $model->desa->nama;
                })
                ->addColumn('action', function($model){
                    return $this->rowActions($model);
                })
                ->make(true);
        }

        // membuat kolom tabel
        $table = $builder->columns([
            Column::make('no'),
            Column::make('nama'),
            Column::make('desa'),
            Column::make('telepon'),
            Column::make('jarak'),
            Column::make('action')->class('text-right'),
        ]);

        return view('pelanggan.index', ['table' => $table]);
    }

    public function create()
    {
        return view('pelanggan.form', ['isEdit' => false]);
    }

    public function store(Request $req)
    {
        // validasi
        $data = $req->validate([
            'nama' => 'required',
            'desa' => 'required',
            'alamat' => '',
            'telepon' => 'numeric',
            'jarak' => 'required|numeric'
        ]);

        $insert = [
            'nama' => $data['nama'],
            'desa_id' => $data['desa'],
            'alamat' => $data['alamat'],
            'telepon' => $data['telepon'],
            'jarak' => $data['jarak']
        ];

        $pelangganId = Pelanggan::insertGetId($insert);
        $bukuTahun = BukuTahun::getTahunAktif();

        // buat tagihan
        for($bulan = 1; $bulan <= 12; $bulan++){
            Tagihan::insert([
                'pelanggan_id' => $pelangganId,
                'buku_tahun_id' => $bukuTahun->id,
                'bulan' => $bulan,
            ]);
        }

        return redirect()->route('admin.pelanggan.index');
    }

    public function show($id)
    {
        $data =  Pelanggan::findOrFail($id);

        return view('pelanggan.detail', ['data' => $data]);
    }

    public function edit($id)
    {
        $data =  Pelanggan::findOrFail($id);

        return view('pelanggan.form', ['isEdit' => true, 'data' => $data]);
    }

    public function update(Request $req, $id)
    {
        $data = $req->validate([
            'nama' => 'required',
            'desa' => 'required',
            'alamat' => '',
            'telepon' => 'numeric',
            'jarak' => 'required|numeric'
        ]);

        $update = [
            'nama' => $data['nama'],
            'desa_id' => $data['desa'],
            'alamat' => $data['alamat'],
            'telepon' => $data['telepon'],
            'jarak' => $data['jarak']
        ];

        Pelanggan::where('id', $id)->update($update);

        return redirect()->route('admin.pelanggan.index');
    }

    public function destroy($id)
    {
        Pelanggan::findOrFail($id)
            ->delete();

        return redirect()->route('admin.pelanggan.index');
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
        $actions .= '<a href="' . route('admin.pelanggan.tagihan', ['id' => $model->id]) . '" class="mr-1 btn btn-success btn-sm"><i class="fas fa-money-bill"></i></a>';
        $actions .= '<a href="#" class="mr-1 btn btn-default btn-sm"><i class="fas fa-print"></i></a>';
        $actions .= '<a href="' . route('admin.pelanggan.ubah', ['id' => $model->id]) . '" class="mr-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';
        $actions .= '<a href="' . route('admin.pelanggan.detail', ['id' => $model->id]) . '" class="mr-1 btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
        $actions .= '<button type="button" data-href="' . route('admin.pelanggan.hapus', ['id' => $model->id]) . '" class="mr-1 btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash"></i></button>';

        return $actions;
    }

    protected function rowTagihanActions($model)
    {
        $actions = '';

        return $actions;
    }
}
