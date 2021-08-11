@extends('adminlte::page')

@section('title', 'Detail Anggota')

@section('content_header')
    <h1>Detail Anggota</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Detail Anggota</h3>
        </div>
        <div class="card-body">
            <div>
                <div class="form-group">
                    <label>Nama</label>
                    <div class="border p-2">{{ $data->nama }}</div>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <div class="border p-2">{{ $data->getRoleNames()->first() }}</div>
                </div>
                <div class="form-group">
                    <label>Jenis kelamin</label>
                    <div class="border p-2">{{ $data->jeni_kelamin == 1 ? 'Laki - laki' : 'Perempuan' }}</div>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <div class="border p-2">{{ $data->username }}</div>
                </div>
            </div>
        </div>
    </div>
@stop
