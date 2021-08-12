@extends('adminlte::page')

@section('title', 'Daftar Buku Tahun')

@section('content_header')
    <h1>Daftar Buku Tahun</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Daftar Buku Tahun</h3>

            <div class="card-tools">
                @can('buku_tahun.tahun_aktif')
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                        data-target="#gantiTahunAktifModal">Ganti tahun aktif</button>
                @endcan
                @can('buku_tahun.tambah')
                    <a href="{{ route('admin.buku_tahun.tambah') }}" class="btn btn-success btn-sm">Tambah</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {!! $table->table(['class' => 'table table-bordered']) !!}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="gantiTahunAktifModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ganti Tahun Aktif</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="ganti_tahun" method="POST" action="{{ route('admin.buku_tahun.ganti_tahun') }}">
                        @csrf
                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control" name="ganti_tahun">
                                @foreach (\App\Models\BukuTahun::all() as $bukuTahun)
                                    <option value="{{ $bukuTahun->id }}"
                                        {{ $bukuTahun == \App\Models\BukuTahun::getTahunAktif() ? 'selected' : '' }}>
                                        {{ $bukuTahun->tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="ganti_tahun">Ganti</button>
                </div>
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
                                        '{{ route('admin.buku_tahun.index') }}';
                                });
                            }
                        });
                    }
                });
            });
        });

    </script>
@stop
