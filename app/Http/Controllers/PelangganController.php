<?php

namespace App\Http\Controllers;

use Auth;
use Mpdf\Mpdf;
use App\Models\Pelanggan;
use App\Models\BukuTahun;
use App\Models\Tagihan;
use App\Models\Desa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class PelangganController extends Controller
{
    // --- restfull function --- //

    public function index(Builder $builder, Request $req)
    {
        $desaId = NULL;

        if($req->desa_id) {
            $desaId = $req->desa_id;
        }
        else {
            $desaId = Desa::first()->id ?? NULL;
        }

        // ajax data
        if (request()->ajax() and Auth::user()->hasPermissionTo('pelanggan.daftar')) {
            $query = Pelanggan::where('desa_id', $desaId)
                ->get();
            
            return DataTables::of($query)
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
            Column::make('saldo'),
            Column::make('action')->class('text-right'),
        ]);

        return view('pelanggan.index', ['table' => $table, 'desaId' => $desaId]);
    }

    public function create()
    {
        return view('pelanggan.form', ['isEdit' => false]);
    }

    public function store(Request $req)
    {
        // validasi
        $data = $req->validate([
            'no' => 'required|unique:pelanggan,no',
            'nama' => 'required',
            'desa' => 'required',
            'telepon' => 'nullable|numeric',
        ]);

        $insert = [
            'no' => $data['no'],
            'nama' => $data['nama'],
            'desa_id' => $data['desa'],
            'telepon' => $data['telepon'],
        ];

        $bukuTahun = BukuTahun::getTahunAktif();

        // cek apakah ada buku tahun aktif
        if(!$bukuTahun) {
            return redirect()
                ->back()
                ->with('error', 'Tidak ada buku tahun aktif');
        }

        $pelangganId = Pelanggan::insertGetId($insert);

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
            'no' => 'required|unique:pelanggan,no,' . $id,
            'nama' => 'required',
            'desa' => 'required',
            'telepon' => 'nullable|numeric',
        ]);

        $update = [
            'no' => $data['no'],
            'nama' => $data['nama'],
            'desa_id' => $data['desa'],
            'telepon' => $data['telepon'],
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
            Column::make('action')->class('text-right')->width(100),
        ]);

        return view('pelanggan.tagihan', ['table' => $table]);
    }

    public function editTagihan($id, $tagihanId)
    {
        $data = Tagihan::findOrFail($tagihanId);

        return view('pelanggan.edit', ['isEdit' => true, 'id' => $id, 'tagihanId' => $tagihanId, 'data' => $data]);
    }

    public function editUpdate(Request $req, $id, $tagihanId)
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
            'petugas_id' => Auth::user()->id,
            'meter_lalu' => $data['meter_lalu'],
            'meter_sekarang' => $data['meter_sekarang'],
            'jumlah_meter' => $data['jumlah_meter'],
            'total' => $total,
            'status' => 2,
        ];

        $tagihan = Tagihan::where('id', $tagihanId)->update($update);

        return redirect()->route('admin.pelanggan.tagihan', ['id' => $id]);
    }

    public function kartu($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $mpdf = new Mpdf([
            'format' => 'A5-L',
            'margin_left' => 10,
            'margin_right' => 10,
        ]);
        $mpdf->WriteHTML(view('pelanggan.kartu', ['pelanggan' => $pelanggan]));

        return $mpdf->Output();
        return view('pelanggan.kartu');
    }

    // --- helper function --- //

    // aksi untuk per row tabel
    protected function rowActions($model)
    {
        $actions = '';
        if(Auth::user()->hasPermissionTo('pelanggan.tagihan')){
            $actions .= '<a href="' . route('admin.pelanggan.tagihan', ['id' => $model->id]) . '" class="mr-1 btn btn-success btn-sm"><i class="fas fa-money-bill"></i></a>';
        }
        if(Auth::user()->hasPermissionTo('pelanggan.print')){
            $actions .= '<a href="' . route('admin.pelanggan.kartu', ['id' => $model->id]) . '" class="mr-1 btn btn-default btn-sm"><i class="fas fa-print"></i></a>';
        }
        if(Auth::user()->hasPermissionTo('pelanggan.ubah')){
            $actions .= '<a href="' . route('admin.pelanggan.ubah', ['id' => $model->id]) . '" class="mr-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';
        }
        if(Auth::user()->hasPermissionTo('pelanggan.detail')){
            $actions .= '<a href="' . route('admin.pelanggan.detail', ['id' => $model->id]) . '" class="mr-1 btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
        }
        if(Auth::user()->hasPermissionTo('pelanggan.hapus')){
            $actions .= '<button type="button" data-href="' . route('admin.pelanggan.hapus', ['id' => $model->id]) . '" class="mr-1 btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash"></i></button>';
        }

        return $actions;
    }

    protected function rowTagihanActions($model)
    {
        $actions = '';
        if($model->status != 1){
            if($model->status != 4){
                $actions .= '<a href="' . route('admin.pelanggan.edit', ['id' => $model->pelanggan->id, 'tagihan_id' => $model->id]) . '" class="mr-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';
            }
            if($model->status != 4 and Auth::user()->hasPermissionTo('pelanggan.tagihan_bayar')){
                $actions .= '<a href="' . route('admin.pelanggan.pembayaran', ['id' => $model->pelanggan->id, 'tagihan_id' => $model->id]) . '" class="mr-1 btn btn-info btn-sm"><i class="fas fa-cash-register"></i></a>';
            }
            $actions .= '<a href="#" data-tagihan="' . $this->printData($model) .'"  class="btn-print mr-1 btn btn-success btn-sm"><i class="fas fa-file-invoice-dollar"></i></a>';
        }
        
        return $actions;
    }

    protected function printData($model)
    {
        return htmlspecialchars(json_encode([
            'jumlah_meter' => $model->jumlah_meter,
            'total' => $model->total,
            'bayar' => $model->bayar,
            'kurang' => $model->total - $model->bayar,
            'tanggal' => $model->updated_at->format('d-m-Y')
        ]), ENT_QUOTES);
    }
}
