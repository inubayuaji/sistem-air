@extends('adminlte::page')

@section('title', 'Daftar Tagihan')

@section('content_header')
    <h1>Daftar Tagihan</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Daftar Tagihan</h3>

            <div class="card-tools">
                @if($desaId)
                <div class="dropdown d-inline">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        {{ \App\Models\Desa::find($desaId)->nama }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach (\App\Models\Desa::all() as $desa)
                            <a class="dropdown-item"
                                href="{{ route('admin.buku_tahun.tagihan', ['id' => $id, 'desa_id' => $desa->id]) }}">{{ $desa->nama }}</a>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="dropdown d-inline">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        {{ $bulan }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item"
                            href="{{ route('admin.buku_tahun.tagihan', ['id' => $id, 'bulan' => 1]) }}">Januari</a>
                        <a class="dropdown-item"
                            href="{{ route('admin.buku_tahun.tagihan', ['id' => $id, 'bulan' => 2]) }}">Februari</a>
                        <a class="dropdown-item"
                            href="{{ route('admin.buku_tahun.tagihan', ['id' => $id, 'bulan' => 3]) }}">Maret</a>
                        <a class="dropdown-item"
                            href="{{ route('admin.buku_tahun.tagihan', ['id' => $id, 'bulan' => 4]) }}">April</a>
                        <a class="dropdown-item"
                            href="{{ route('admin.buku_tahun.tagihan', ['id' => $id, 'bulan' => 5]) }}">Mei</a>
                        <a class="dropdown-item"
                            href="{{ route('admin.buku_tahun.tagihan', ['id' => $id, 'bulan' => 6]) }}">Juni</a>
                        <a class="dropdown-item"
                            href="{{ route('admin.buku_tahun.tagihan', ['id' => $id, 'bulan' => 7]) }}">Juli</a>
                        <a class="dropdown-item"
                            href="{{ route('admin.buku_tahun.tagihan', ['id' => $id, 'bulan' => 8]) }}">Agustus</a>
                        <a class="dropdown-item"
                            href="{{ route('admin.buku_tahun.tagihan', ['id' => $id, 'bulan' => 9]) }}">September</a>
                        <a class="dropdown-item"
                            href="{{ route('admin.buku_tahun.tagihan', ['id' => $id, 'bulan' => 10]) }}">Oktober</a>
                        <a class="dropdown-item"
                            href="{{ route('admin.buku_tahun.tagihan', ['id' => $id, 'bulan' => 11]) }}">November</a>
                        <a class="dropdown-item"
                            href="{{ route('admin.buku_tahun.tagihan', ['id' => $id, 'bulan' => 12]) }}">Desember</a>
                    </div>
                </div>
                {{-- <a href="{{ route('admin.pelanggan.tambah') }}" class="btn btn-success btn-sm">Tambah</a> --}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {!! $table->table(['class' => 'table table-bordered']) !!}
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/rowGroup.bootstrap4.min.css') }}" />
@stop

@section('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>

    {!! $table->scripts() !!}

    <script>
        $(document).ready(function() {
            $('body').on('click', '.btn-hapus', function(event) {
                var el = $(this);

                swal.fire({
                    title: "Lanjutkan hapus?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Hapus",
                    preConfirm: false
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: el.data('href'),
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function() {
                                swal.fire({
                                    title: "Berhasil!",
                                    text: "Data berhasil dihapus.",
                                    icon: "success"
                                }).then(function(result) {
                                    window.location =
                                        '{{ route('admin.pelanggan.index') }}';
                                });
                            }
                        });
                    }
                });
            });
        });

    </script>
@stop
