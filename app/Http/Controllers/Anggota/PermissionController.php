<?php

namespace App\Http\Controllers\Anggota;

use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class PermissionController extends Controller
{
    // --- restfull function --- //

    public function index(Builder $builder)
    {
        // ajax data
        if (request()->ajax()) {
            return DataTables::of(Permission::query())
                // ->addColumn('action', function($model){
                //     return $this->rowActions($model);
                // })
                ->make(true);
        }

        // membuat kolom tabel
        $table = $builder->columns([
            Column::make('name'),
            Column::make('deskripsi'),
            // Column::make('action'),
        ]);

        return view('anggota.permission.index', ['table' => $table]);
    }

    public function create()
    {
        return view('anggota.permission.form', ['isEdit' => false]);
    }

    public function store(Request $req)
    {
        // validasi
        $data = $req->validate([
            'name' => 'required|unique:roles,name',
            'deskripsi' => '',
        ]);

        Permission::create([
            'name' => $data['name'],
            'deskripsi' => $data['deskripsi'],
        ]);

        return redirect()->route('admin.anggota.permission.index');
    }

    public function show($id)
    {
        $data =  Permission::findOrFail($id);

        return view('anggota.permission.detail', ['data' => $data]);
    }

    public function edit($id)
    {
        $data =  Permission::findOrFail($id);

        return view('anggota.permission.form', ['isEdit' => true, 'data' => $data]);
    }

    public function update(Request $req, $id)
    {
        $data = $req->validate([
            'name' => 'required|unique:roles,name',
            'deskripsi' => '',
        ]);

        $update = [
            'name' => $data['name'],
            'deskripsi' => $data['deskripsi'],
        ];

        Permission::where('id', $id)
            ->update($update);

        return redirect()->route('admin.anggota.permission.index');
    }

    public function destroy($id)
    {
        Permission::findOrFail($id)
            ->delete();

        return redirect()->route('admin.anggota.permission.index');
    }

    // --- helper function --- //

    // aksi untuk per row tabel
    protected function rowActions($model)
    {
        $actions = '';
        $actions .= view('partials.actions.ubah', ['url' => 'admin.anggota.permission.ubah', 'id' => $model->id])->render();
        $actions .= view('partials.actions.detail', ['url' => 'admin.anggota.permission.detail', 'id' => $model->id])->render();
        $actions .= view('partials.actions.hapus', ['url' => 'admin.anggota.permission.hapus', 'id' => $model->id])->render();

        return $actions;
    }
}
