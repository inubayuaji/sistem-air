@extends('adminlte::page')

@section('title', 'Daftar Pelanggan')

@section('content_header')
    <h1>Daftar Pelanggan</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Daftar Pelanggan</h3>

            <div class="card-tools">
                @can('pelanggan.urutkan')
                    <button type="button" id="urutkan" class="btn btn-default btn-sm">Urutkan</button>
                @endcan
                <div class="dropdown d-inline">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        {{ \App\Models\Desa::find($desaId)->nama }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach (\App\Models\Desa::all() as $desa)
                            <a class="dropdown-item"
                                href="{{ route('admin.pelanggan.index', ['desa_id' => $desa->id]) }}">{{ $desa->nama }}</a>
                        @endforeach
                    </div>
                </div>
                @can('pelanggan.tambah')
                    <a href="{{ route('admin.pelanggan.tambah') }}" class="btn btn-success btn-sm">Tambah</a>
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

            $('#urutkan').on('click', function(event){
                swal.fire({
                    title: "Lanjutkan pengurutan?",
                    text: "Nomer urut baru tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FFC107",
                    confirmButtonText: "Urutkan",
                    preConfirm: false
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('admin.pelanggan.no_urut') }}',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function() {
                                swal.fire({
                                    title: "Berhasil!",
                                    text: "No berhasil diurutkan.",
                                    icon: "success"
                                }).then(function(result) {
                                    window.location.reload();
                                });
                            }
                        });
                    }
                });
            });
        });

    </script>
@stop
