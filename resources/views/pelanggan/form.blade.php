@extends('adminlte::page')

@section('title', ($isEdit ? 'Ubah' : 'Tambah') . ' Pelanggan')

@section('content_header')
    <h1>{{ $isEdit ? 'Edit' : 'Tambah' }} Pelanggan</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">{{ $isEdit ? 'Ubah' : 'Tambah' }} Pelanggan</h3>
        </div>
        <div class="card-body">
            <form role="form" method="POST"
                action="{{ $isEdit ? route('admin.pelanggan.update', ['id' => $data->id]) : route('admin.pelanggan.simpan') }}">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="{{ $isEdit ? $data->nama : '' }}" required>
                </div>
                <div class="form-group">
                    <label>Desa</label>
                    <select class="form-control" name="desa" required>
                        <option value="" {{ $isEdit ? '' : 'selected' }} disabled>Pilih Desa</option>
                        @foreach (\App\Models\Desa::all() as $desa)
                            <option value="{{ $desa->id }}"
                                {{ ($isEdit and $data->desa_id == $desa->id) ? 'selected' : '' }}>{{ $desa->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" name="alamat">{{ $isEdit ? $data->alamat : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="number" class="form-control" name="telepon" value="{{ $isEdit ? $data->telepon : '' }}">
                </div>
                <div class="form-group">
                    <label>Jarak</label>
                    <input type="number" class="form-control" name="jarak" value="{{ $isEdit ? $data->jarak : '' }}"
                        required>
                </div>

                <div class="hr-line-dashed"></div>

                <div class="mb-0 form-group">
                    <button class="btn btn-sm btn-default" type="reset">Reset</button>
                    <button class="btn btn-sm btn-primary" type="submit">{{ $isEdit ? 'Ubah' : 'Tambah' }}</button>
                </div>
            </form>
        </div>
    </div>
@stop
