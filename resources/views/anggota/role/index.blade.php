@extends('adminlte::page')

@section('title', 'Daftar Role')

@section('content_header')
    <h1>Daftar Role</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Daftar Role</h3>

            <div class="card-tools">
                {{-- <a href="{{ route('admin.anggota.role.tambah') }}" class="btn btn-success btn-sm">Tambah</a> --}}
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
