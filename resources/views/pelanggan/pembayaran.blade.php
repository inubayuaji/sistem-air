@extends('adminlte::page')

@section('title', 'Pembayaran Pelanggan')

@section('content_header')
    <h1>Pembayaran Pelanggan</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Pembayaran Pelanggan</h3>
        </div>
        <div class="card-body">
            @if (\Session::has('saldo_kurang'))
                <div class="alert alert-warning">
                    {{ \Session::get('saldo_kurang') }}
                </div>
            @endif
            <form role="form" method="POST"
                action="{{ route('admin.pelanggan.bayar', ['id' => $id, 'tagihan_id' => $tagihan_id]) }}">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <div class="p-2 border">{{ $data->pelanggan->nama }}</div>
                </div>
                <div class="form-group">
                    <label>Bulan</label>
                    <div class="p-2 border">{{ $data->bulan }}</div>
                </div>
                <div class="form-group">
                    <label>Total tagihan</label>
                    <div class="p-2 border">{{ $data->total }}</div>
                </div>
                <div class="form-group">
                    <label>Terbayar</label>
                    <div class="p-2 border">{{ $data->bayar }}</div>
                </div>

                <hr>

                <div class="form-group">
                    <label>Metode</label>
                    <select class="custom-select" name="metode" required>
                        <option value="cash" selected>Cash</option>
                        <option value="saldo">Saldo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nominal</label>
                    <input type="number" class="form-control" name="nominal" required>
                </div>

                <div class="hr-line-dashed"></div>

                <div class="mb-0 form-group">
                    <button class="btn btn-sm btn-default" type="reset">Reset</button>
                    <button class="btn btn-sm btn-primary" type="submit">Bayar</button>
                </div>
            </form>
        </div>
    </div>
@stop
