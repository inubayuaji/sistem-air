@extends('adminlte::page')

@section('title', 'Detail Role')

@section('content_header')
    <h1>Detail Role</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Detail Role</h3>
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
                <div class="form-group">
                    <label>Deskripsi</label>
                    <div class="border p-2">
                        @foreach ($data->permissions->pluck('name') as $permission)
                            <span class="badge mr-1">{{ $permission }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
