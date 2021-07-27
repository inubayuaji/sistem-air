@extends('adminlte::page')

@section('title', 'Detail Desa')

@section('content_header')
    <h1>Detail Desa</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Detail Desa</h3>

            <div class="card-tools">
                <a href="{{ route('admin.desa.ubah', ['id' => $data->id]) }}" class="btn btn-warning btn-sm">Ubah</a>
            </div>
        </div>
        <div class="card-body">
            <div>
                <div class="form-group">
                    <label>Nama</label>
                    <div class="border p-2">{{ $data->nama }}</div>
                </div>
            </div>
        </div>
    </div>
@stop
