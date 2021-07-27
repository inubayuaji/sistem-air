<?php

namespace App\Http\Controllers\Anggota;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class RoleController extends Controller
{

    // agar role admin tidak dapata dihapus atau edit
    protected $guardRoles = ['Admin'];

    // --- restfull function --- //

    public function index(Builder $builder)
    {
        // ajax data
        if (request()->ajax()) {
            return DataTables::of(Role::query())
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

        return view('anggota.role.index', ['table' => $table]);
    }

    public function create()
    {
        return view('anggota.role.form', ['isEdit' => false]);
    }

    public function store(Request $req)
    {
        // validasi
        $data = $req->validate([
            'name' => 'required|unique:roles,name',
            'deskripsi' => '',
            'permission' => 'required|array|filled'
        ]);

        $role = Role::create([
            'name' => $data['name'],
            'deskripsi' => $data['deskripsi'],
        ]);

        $role->syncPermissions($data['permission']);

        return redirect()->route('admin.anggota.role.index');
    }

    public function show($id)
    {
        $data =  Role::findOrFail($id);

        return view('anggota.role.detail', ['data' => $data]);
    }

    public function edit($id)
    {
        $data =  Role::findOrFail($id);

        return view('anggota.role.form', ['isEdit' => true, 'data' => $data]);
    }

    public function update(Request $req, $id)
    {
        $data = $req->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'deskripsi' => '',
            'permission' => 'required|array|filled'
        ]);

        $update = [
            'name' => $data['name'],
            'deskripsi' => $data['deskripsi'],
        ];

        $role = Role::find($id);
        
        $role->update($update);
        $role->syncPermissions($data['permission']);

        return redirect()->route('admin.anggota.role.index');
    }

    public function destroy($id)
    {
        Role::findOrFail($id)
            ->delete();

        return redirect()->route('admin.anggota.role.index');
    }

    // --- helper function --- //

    // aksi untuk per row tabel
    protected function rowActions($model)
    {
        $actions = '';

        if(!in_array($model->name, $this->guardRoles)){
            $actions .= view('partials.actions.ubah', ['url' => 'admin.anggota.role.ubah', 'id' => $model->id])->render();
            $actions .= view('partials.actions.detail', ['url' => 'admin.anggota.role.detail', 'id' => $model->id])->render();
            $actions .= view('partials.actions.hapus', ['url' => 'admin.anggota.role.hapus', 'id' => $model->id])->render();
        }

        return $actions;
    }
}
