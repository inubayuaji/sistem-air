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
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
@stop

@section('js')
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
                                        '{{ route('admin.desa.index') }}';
                                });
                            }
                        });
                    }
                });
            });
        });

    </script>
@stop
