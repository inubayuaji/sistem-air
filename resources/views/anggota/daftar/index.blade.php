@extends('adminlte::page')

@section('title', 'Daftar Anggota')

@section('content_header')
    <h1>Daftar Anggota</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Daftar Anggota</h3>

            <div class="card-tools">
                @can('anggota.tambah')
                    <a href="{{ route('admin.anggota.daftar.tambah') }}" class="btn btn-success btn-sm">Tambah</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {!! $table->table(['class' => 'table table-bordered']) !!}
            </div>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/rowGroup.bootstrap4.min.css') }}" />
@stop

@section('js')
    {!! $table->scripts() !!}
@stop
