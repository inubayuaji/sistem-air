@extends('adminlte::page')

@section('title', ($isEdit ? 'Ubah' : 'Tambah') . ' Permission')

@section('content_header')
    <h1>{{$isEdit ? 'Edit' : 'Tambah'}} Permission</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">{{ $isEdit ? 'Ubah' : 'Tambah' }} Permission</h3>
        </div>
        <div class="card-body">
            <form permission="form" method="POST"
                action="{{ $isEdit ? route('admin.anggota.permission.update', ['id' => $data->id])
                : route('admin.anggota.permission.simpan') }}">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="name" value="{{ $isEdit ? $data->name : '' }}" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" value="{{ $isEdit ? $data->deskripsi : '' }}"></textarea>
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


