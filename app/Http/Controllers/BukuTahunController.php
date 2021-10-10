<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Desa;
use App\Models\BukuTahun;
use App\Models\Tagihan;
use App\Models\Pelanggan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class BukuTahunController extends Controller
{
    // --- restfull function --- //

    public function index(Builder $builder)
    {
        // ajax data
        if (request()->ajax() and Auth::user()->hasPermissionTo('buku_tahun.daftar')) {
            return DataTables::of(BukuTahun::query())
                ->addColumn('action', function($model){
                    return $this->rowActions($model);
                })
                ->editColumn('status', function($model){
                    return $model->status ? 'Aktif' : 'Tidak aktif';
                })
                ->make(true);
        }

        // membuat kolom tabel
        $table = $builder->columns([
            Column::make('tahun'),
            Column::make('status'),
            Column::make('action')->class('text-right'),
        ]);

        return view('buku_tahun.index', ['table' => $table]);
    }

    public function create()
    {
        return view('buku_tahun.form', ['isEdit' => false]);
    }

    public function store(Request $req)
    {
        // validasi
        $data = $req->validate([
            'tahun' => 'required|unique:buku_tahun,tahun',
            'status' => 'required'
        ]);

        $insert = [
            'tahun' => $data['tahun'],
            'status' => $data['status'],
        ];

        // reset tahun aktif
        if($insert['status'] == 1){
            BukuTahun::resetTahunAktif();
        }

        $bukuTahunId = BukuTahun::insertGetId($insert);

        // membuat tagihan
        foreach(Pelanggan::all() as $pelanggan){
            for($bulan = 1; $bulan <= 12; $bulan++){
                Tagihan::insert([
                    'pelanggan_id' => $pelanggan->id,
                    'buku_tahun_id' => $bukuTahunId,
                    'bulan' => $bulan,
                ]);
            }
        }

        return redirect()->route('admin.buku_tahun.index');
    }

    public function show($id)
    {
        $data =  BukuTahun::findOrFail($id);

        return view('buku_tahun.detail', ['data' => $data]);
    }

    public function destroy($id)
    {
        BukuTahun::findOrFail($id)
            ->delete();

        // hapus tagihan
        Tagihan::where('buku_tahun_id', $id)
            ->delete();

        return redirect()->route('admin.buku_tahun.index');
    }

    public function tagihan(Builder $builder, Request $req, $id)
    {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $desaId = NULL;

        if($req->desa_id) {
            $desaId = $req->desa_id;
        }
        else {
            $desaId = Desa::first()->id ?? NULL;
        }
        
        // ajax data
        if (request()->ajax()) {
            $query = Tagihan::where('bulan', $req->bulan ?? 1)
                ->join('pelanggan', 'pelanggan.id', 'tagihan.pelanggan_id')
                ->where('buku_tahun_id', $id)
                ->where('desa_id', $desaId)
                ->get();

            return DataTables::of($query)
                ->editColumn('petugas_id', function($model){
                    return $model->petugas->nama ?? null;
                })
                ->editColumn('pelanggan_id', function($model){
                    return $model->pelanggan->nama ?? null;
                })
                ->addColumn('action', function($model){
                    return $this->rowTagihanActions($model);
                })
                ->make(true);
        }

        // membuat kolom tabel
        $table = $builder->columns([
            Column::make('pelanggan_id')->title('Pelanggan'),
            Column::make('petugas_id')->title('Petugas'),
            Column::make('meter_lalu'),
            Column::make('meter_sekarang'),
            Column::make('jumlah_meter'),
            Column::make('total'),
            Column::make('bayar'),
            Column::make('action')->class('text-right'),
        ]);

        return view('buku_tahun.tagihan', [
            'table' => $table,
            'id' => $id,
            'bulan' => $bulan[$req->bulan ?? 1],
            'desaId' => $desaId,
        ]);
    }

    public function gantiTahunAktif(Request $req)
    {
        BukuTahun::setTahunAktif($req->ganti_tahun);

        return redirect()->back();
    }

    // --- helper function --- //

    // aksi untuk per row tabel
    protected function rowActions($model)
    {
        $actions = '';
        if(Auth::user()->hasPermissionTo('buku_tahun.tagihan')){
            $actions .= '<a href="' . route('admin.buku_tahun.tagihan', ['id' => $model->id]) . '#" class="mr-1 btn btn-success btn-sm"><i class="fas fa-money-bill"></i></a>';
        }
        if(Auth::user()->hasPermissionTo('buku_tahun.detail')){
            $actions .= '<a href="' . route('admin.buku_tahun.detail', ['id' => $model->id]) . '" class="mr-1 btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
        }
        
        if($model->status != 1 and Auth::user()->hasPermissionTo('buku_tahun.hapus')){
            $actions .= '<button type="button" data-href="' . route('admin.buku_tahun.hapus', ['id' => $model->id]) . '" class="mr-1 btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash"></i></button>';
        }
        
        return $actions;
    }

    protected function rowTagihanActions($model)
    {
        $actions = '';

        return $actions;
    }
}
