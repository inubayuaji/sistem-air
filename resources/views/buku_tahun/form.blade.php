@extends('adminlte::page')

@section('title', ($isEdit ? 'Ubah' : 'Tambah') . ' Buku Tahun')

@section('content_header')
    <h1>{{ $isEdit ? 'Edit' : 'Tambah' }} Buku Tahun</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">{{ $isEdit ? 'Ubah' : 'Tambah' }} Buku Tahun</h3>
        </div>
        <div class="card-body">
            <form role="form" method="POST"
                action="{{ $isEdit ? route('admin.buku_tahun.update', ['id' => $data->id]) : route('admin.buku_tahun.simpan') }}">
                @csrf
                <div class="form-group">
                    <label>Tahun</label>
                    <input type="number" class="form-control" name="tahun" value="{{ $isEdit ? $data->tahun : '' }}"
                        required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status_aktif"
                            value="1" required>
                        <label class="form-check-label" for="status_aktif">
                            Aktif
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status_tidak_aktif"
                            value="0" required>
                        <label class="form-check-label" for="status_tidak_aktif">
                            Tidak aktif
                        </label>
                    </div>
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
