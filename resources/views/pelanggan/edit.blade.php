@extends('adminlte::page')

@section('title', ($isEdit ? 'Ubah' : 'Tambah') . ' Tagihan')

@section('content_header')
    <h1>{{$isEdit ? 'Edit' : 'Tambah'}} Tagihan</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">{{ $isEdit ? 'Ubah' : 'Tambah' }} Tagihan</h3>
        </div>
        <div class="card-body">
            <form role="form" method="POST"
                action="{{ route('admin.pelanggan.update-edit', ['id' => $id, 'tagihan_id' => $tagihanId]) }}">
                @csrf
                <div class="form-group">
                    <label>Meter lalu</label>
                    <input type="number" class="form-control" name="meter_lalu" value="{{ $isEdit ? $data->meter_lalu : '' }}" required>
                </div>
                <div class="form-group">
                    <label>Meter sekarang</label>
                    <input type="number" class="form-control" name="meter_sekarang" value="{{ $isEdit ? $data->meter_sekarang : '' }}" required>
                </div>
                <div class="form-group">
                    <label>Jumlah meter</label>
                    <input type="number" class="form-control" name="jumlah_meter" value="{{ $isEdit ? $data->junlah_meter : '' }}" required>
                </div>

                <div class="hr-line-dashed"></div>

                <div class="mb-0 form-group">
                    <button class="btn btn-sm btn-default" type="reset">Reset</button>
                    <button class="btn btn-sm btn-primary" type="submit">{{ $isEdit ? 'Ubah' : 'Tambah' }}</button>
                </div>
            </form>
        </div>
    </div>
@stop
