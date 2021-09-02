<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Desa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

/**
 * mengikuti standar laravel restfull controller
 * https://laravel.com/docs/5.1/controllers#restful-resource-controllers
 */

class DesaController extends Controller
{
    // --- restfull function --- //

    public function index(Builder $builder)
    {
        // ajax data
        if (request()->ajax()) {
            return DataTables::of(Desa::query())
                ->addColumn('action', function($model){
                    return $this->rowActions($model);
                })
                ->make(true);
        }

        // membuat kolom tabel
        $table = $builder->columns([
            Column::make('nama'),
            Column::make('action')->class('text-right'),
        ]);

        return view('desa.index', ['table' => $table]);
    }

    public function create()
    {
        return view('desa.form', ['isEdit' => false]);
    }

    public function store(Request $req)
    {
        // validasi
        $data = $req->validate([
            'nama' => 'required',
        ]);

        $insert = [
            'nama' => $data['nama'],
        ];

        Desa::insert($insert);

        return redirect()->route('admin.desa.index');
    }

    public function show($id)
    {
        $data =  Desa::findOrFail($id);

        return view('desa.detail', ['data' => $data]);
    }

    public function edit($id)
    {
        $data =  Desa::findOrFail($id);

        return view('desa.form', ['isEdit' => true, 'data' => $data]);
    }

    public function update(Request $req, $id)
    {
        $data = $req->validate([
            'nama' => 'required',
        ]);

        $update = [
            'nama' => $data['nama'],
        ];

        Desa::where('id', $id)->update($update);

        return redirect()->route('admin.desa.index');
    }

    public function destroy($id)
    {
        Desa::findOrFail($id)
            ->delete();

        return redirect()->route('admin.desa.index');
    }

    // --- helper function --- //

    // aksi untuk per row tabel
    protected function rowActions($model)
    {
        $actions = '';
        if(Auth::user()->hasPermissionTo('desa.ubah')){
            $actions .= '<a href="' . route('admin.desa.ubah', ['id' => $model->id]) . '" class="mr-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';
        }
        if(Auth::user()->hasPermissionTo('desa.detail')){
            $actions .= '<a href="' . route('admin.desa.detail', ['id' => $model->id]) . '" class="mr-1 btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
        }
        if(Auth::user()->hasPermissionTo('desa.hapus')){
            $actions .= '<button type="button" data-href="' . route('admin.desa.hapus', ['id' => $model->id]) . '" class="mr-1 btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash"></i></button>';
        }

        return $actions;
    }
}
