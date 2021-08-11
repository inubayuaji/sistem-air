@extends('adminlte::page')

@section('title', ($isEdit ? 'Ubah' : 'Tambah') . ' Anggota')

@section('content_header')
    <h1>{{$isEdit ? 'Edit' : 'Tambah'}} Anggota</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">{{ $isEdit ? 'Ubah' : 'Tambah' }} Anggota</h3>
        </div>
        <div class="card-body">
            <form role="form" method="POST"
                action="{{ $isEdit ? route('admin.anggota.daftar.update', ['id' => $data->id]) : route('admin.anggota.daftar.simpan') }}">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="{{ $isEdit ? $data->nama : '' }}" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role" required>
                        <option value="" {{ $isEdit ? '' : 'selected' }} disabled></option>
                        @foreach (\Spatie\Permission\Models\Role::all() as $role)
                            <option value="{{ $role->name }}"
                                {{ ($isEdit and $data->getRoleNames()->first() == $role->name) ? 'selected' : '' }}>
                                {{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="opsi-perempuan" value="0"
                            {{ ($isEdit and $data->jenis_kelamin == 0) ? 'checked' : '' }} required>
                        <label class="form-check-label" for="opsi-perempuan">Perempuan</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="opsi-laki-laki" value="1"
                            {{ ($isEdit and $data->jenis_kelamin == 1) ? 'checked' : '' }} required>
                        <label class="form-check-label" for="opsi-laki-laki">Laki - laki</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="{{ $isEdit ? $data->username : '' }}"
                        required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" {{ $isEdit ? '' : 'required' }}>
                </div>
                <div class="form-group">
                    <label>Ketik ulang password</label>
                    <input type="password" class="form-control" name="re_password" {{ $isEdit ? '' : 'required' }}>
                </div>

                <div class="hr-line-dashed"></div>

                <div class="form-group mb-0">
                    <button class="btn btn-sm btn-default" type="reset">Reset</button>
                    <button class="btn btn-sm btn-primary" type="submit">{{ $isEdit ? 'Ubah' : 'Tambah' }}</button>
                </div>
            </form>
        </div>
    </div>
@stop
