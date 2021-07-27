@extends('adminlte::page')

@section('title', ($isEdit ? 'Ubah' : 'Tambah') . ' Desa')

@section('content_header')
    <h1>{{$isEdit ? 'Edit' : 'Tambah'}} Desa</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">{{ $isEdit ? 'Ubah' : 'Tambah' }} Desa</h3>
        </div>
        <div class="card-body">
            <form role="form" method="POST"
                action="{{ $isEdit ? route('admin.desa.update', ['id' => $data->id]) : route('admin.desa.simpan') }}">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="{{ $isEdit ? $data->nama : '' }}" required>
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
