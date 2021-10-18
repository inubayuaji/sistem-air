@extends('adminlte::page')

@section('title', 'Detail Buku Tahun')

@section('content_header')
    <h1>Detail Buku Tahun</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h4>{{ number_format($totalMeter, 0, ',', '.') }} m<sup>3</sup></h4>

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
                    <h4>Rp {{ number_format($totalTagihan, 2, ',', '.') }}</h4>

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
                    <h4>Rp {{ number_format($totalBayar, 2, ',', '.') }}</h4>

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
                    <h4>Rp {{ number_format($totalBelumBayar, 2, ',', '.') }}</h4>

                    <p>Total belum bayar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calculator"></i>
                </div>
            </div>
        </div>
    </div>
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
        <div class="col-12">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Detail Keuangan Bulanan</h3>

                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Total meter</th>
                                <th>Total tagihan</th>
                                <th>Total bayar</th>
                                <th>Total belum bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailBulan as $tagihan)
                            <tr>
                                <td>{{ $tagihan['bulan'] }}</td>
                                <td>{{ $tagihan['totalMeter'] }}</td>
                                <td>{{ $tagihan['totalTagihan'] }}</td>
                                <td>{{ $tagihan['totalBayar'] }}</td>
                                <td>{{ $tagihan['totalBelumBayar'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
