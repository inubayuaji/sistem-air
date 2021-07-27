@extends('adminlte::page')

@section('title', 'Detail Permission')

@section('content_header')
    <h1>Detail Permission</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Detail Permission</h3>
        </div>
        <div class="card-body">
            <div>
                <div class="form-group">
                    <label>Nama</label>
                    <div class="border p-2">{{ $data->name }}</div>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <div class="border p-2">{{ $data->deskripsi }}</div>
                </div>
            </div>
        </div>
    </div>
@stop
