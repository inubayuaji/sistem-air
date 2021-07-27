@extends('adminlte::page')

@section('title', 'Detail Buku Tahun')

@section('content_header')
    <h1>Detail Buku Tahun</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Detail Buku Tahun</h3>

            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
            <div>
                <div class="form-group">
                    <label>Tahun</label>
                    <div class="p-2 border">{{ $data->tahun }}</div>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <div class="p-2 border">{{ $data->status ? 'Aktif' : 'Tidak aktif' }}</div>
                </div>
            </div>
        </div>
    </div>
@stop
