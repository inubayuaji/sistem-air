@extends('adminlte::page')

@section('title', 'Detail Buku Tahun')

@section('content_header')
    <h1>Detail Buku Tahun</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
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
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h4>{{ number_format(\App\Models\Tagihan::sum('jumlah_meter'), 0, ',', '.') }} m<sup>3</sup></h4>

                    <p>Total meter</p>
                </div>
                <div class="icon">
                    <i class="fas fa-faucet"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>Rp {{ number_format(\App\Models\Tagihan::sum('total'), 2, ',', '.') }}</h4>

                    <p>Total tagihan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>Rp {{ number_format(\App\Models\Tagihan::sum('bayar'), 2, ',', '.') }}</h4>

                    <p>Total bayar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>Rp {{ number_format(\App\Models\Tagihan::sum('total') - \App\Models\Tagihan::sum('bayar'), 2, ',', '.') }}</h4>

                    <p>Total belum bayar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calculator"></i>
                </div>
            </div>
        </div>
    </div>
@stop
