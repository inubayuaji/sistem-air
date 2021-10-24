<?php

namespace App\Http\Controllers\Anggota;

use Auth;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

/**
 * mengikuti standar laravel restfull controller
 * https://laravel.com/docs/5.1/controllers#restful-resource-controllers
 */
class DaftarController extends Controller
{

    // --- restfull function --- //

    public function index(Builder $builder)
    {
        // ajax data
        if (request()->ajax()) {
            return DataTables::of(Admin::query())
                // merubah jenis kelamin 0: perempuan 1: laki - laki
                ->editColumn('jenis_kelamin', function($model){
                    if($model->jenis_kelamin == 0) {
                        return 'Perempuan';
                    }

                    return 'Laki - laki';
                })
                ->addColumn('role', function($model){
                    return $model->getRoleNames()->first();
                })
                ->addColumn('action', function($model){
                    return $this->rowActions($model);
                })
                ->make(true);
        }

        // membuat kolom tabel
        $table = $builder->columns([
            Column::make('nama'),
            Column::make('role'),
            Column::make('jenis_kelamin'),
            Column::make('action'),
        ]);

        return view('anggota.daftar.index', ['table' => $table]);
    }

    public function create()
    {
        return view('anggota.daftar.form', ['isEdit' => false]);
    }

    public function store(Request $req)
    {
        // validasi
        $data = $req->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'username' => 'required|unique:admin,username',
            'password' => 'required',
            're_password' => 'required|same:password',
            'role' => 'required',
        ]);

        $insert = [
            'nama' => $data['nama'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ];

        $adminId = Admin::insertGetId($insert);

        $admin = Admin::find($adminId);
        $admin->assignRole($data['role']);

        return redirect()->route('admin.anggota.daftar.index');
    }

    public function show($id)
    {
        $data =  Admin::findOrFail($id);

        return view('anggota.daftar.detail', ['data' => $data]);
    }

    public function edit($id)
    {
        $data =  Admin::findOrFail($id);

        return view('anggota.daftar.form', ['isEdit' => true, 'data' => $data]);
    }

    public function update(Request $req, $id)
    {
        $data = $req->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'username' => 'required|unique:admin,username,' . $id,
            'password' => '',
            're_password' => 'same:password',
            'role' => '',
        ]);

        $update = [
            'nama' => $data['nama'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'username' => $data['username'],
        ];

        if(isset($data['password'])) {
            $update['password'] = bcrypt($data['password']);
        }

        $admin = Admin::where('id', $id)->first();
        
        $admin->update($update);

        if($admin->getRoleNames()->first() != $data['role']){
            $admin->removeRole($admin->getRoleNames()->first());
            $admin->assignRole($data['role']);
        }

        return redirect()->route('admin.anggota.daftar.index');
    }

    public function destroy($id)
    {
        Admin::findOrFail($id)
            ->delete();

        return redirect()->route('admin.anggota.daftar.index');
    }

    // --- helper function --- //

    // aksi untuk per row tabel
    protected function rowActions($model)
    {
        $actions = '';
        if(Auth::user()->hasPermissionTo('anggota.ubah')){
            $actions .= '<a href="' . route('admin.anggota.daftar.ubah', ['id' => $model->id]) . '" class="mr-1 btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';
        }
        if(Auth::user()->hasPermissionTo('anggota.detail')){
            $actions .= '<a href="' . route('admin.anggota.daftar.detail', ['id' => $model->id]) . '" class="mr-1 btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
        }
        if(Auth::user()->hasPermissionTo('anggota.hapus') and $model->id != 1){
            $actions .= '<button type="button" data-href="' . route('admin.anggota.daftar.hapus', ['id' => $model->id]) . '" class="mr-1 btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash"></i></button>';
        }
        return $actions;
    }
}
