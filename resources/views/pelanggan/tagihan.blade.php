@extends('adminlte::page')

@section('title', 'Daftar Tagihan Pelanggan')

@section('content_header')
    <h1>Daftar Tagihan Pelanggan</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Daftar Tagihan Pelanggan</h3>

            <div class="card-tools">
                {{-- <a href="{{ route('admin.pelanggan.tambah') }}" class="btn btn-success btn-sm">Tambah</a> --}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {!! $table->table(['class' => 'table table-bordered']) !!}
            </div>
        </div>
    </div>

    <div id="print-invoice" class="d-none">
        <p class="mb-4">Struct bukti pembayaran</p>
        <table>
            <tr>
                <td>Tanggal</td>
                <td>: <span id="tagihan-tanggal"></span></td>
            </tr>
            <tr>
                <td>Penggunaan</td>
                <td>: <span id="tagihan-meter"></span>m<sup>2</sup></td>
            </tr>
            <tr>
                <td>Total</td>
                <td>: Rp <span id="tagihan-total"></span></td>
            </tr>
            <tr>
                <td>Bayar</td>
                <td>: Rp <span id="tagihan-bayar"></span></td>
            </tr>
            <tr>
                <td>Sisa</td>
                <td>: Rp <span id="tagihan-kurang"></span></td>
            </tr>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/rowGroup.bootstrap4.min.css') }}" />

    <style>
        #print-invoice {
            @media print {
                @page {
                    font-family: 'lucida console';
                    font-size: 12px;
                }

                #print-invoice {
                    display: block;
                }
                #print-invoice table, tr, td {
                    border: none;
                }
            }
        }
    </style>
@stop

@section('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendor/print.min.js') }}"></script>

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

            $('body').on('click', '.btn-print', function(e) {
                var tagihan = $(this).data('tagihan');

                $('#tagihan-meter').text(tagihan.jumlah_meter);
                $('#tagihan-tanggal').text(tagihan.tanggal);
                $('#tagihan-total').text(tagihan.total);
                $('#tagihan-bayar').text(tagihan.bayar);
                $('#tagihan-kurang').text(tagihan.kurang);

                printJS({printable: 'print-invoice', type: 'html'});
            });
        });

    </script>
@stop
