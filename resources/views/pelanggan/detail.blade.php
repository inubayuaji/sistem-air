@extends('adminlte::page')

@section('title', 'Detail Pelanggan')

@section('content_header')
    <h1>Detail Pelanggan</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Detail Pelanggan</h3>

            <div class="card-tools">
                <a href="{{ route('admin.pelanggan.ubah', ['id' => $data->id]) }}" class="btn btn-warning btn-sm">Ubah</a>
            </div>
        </div>
        <div class="card-body">
            <div>
                <div class="form-group">
                    <label>No</label>
                    <div class="p-2 border">{{ $data->no }}</div>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <div class="p-2 border">{{ $data->nama }}</div>
                </div>
                <div class="form-group">
                    <label>Desa</label>
                    <div class="p-2 border">{{ $data->desa->nama }}</div>
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <div class="p-2 border">{{ $data->telepon }}</div>
                </div>
            </div>
        </div>
    </div>
@stop
