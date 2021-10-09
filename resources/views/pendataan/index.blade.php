@extends('adminlte::page')

@section('title', 'Daftar Pendataan')

@section('content_header')
    <h1>Daftar Pendataan</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Daftar Pendataan</h3>

            <div class="card-tools">
                @if($desaId)
                <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        {{ \App\Models\Desa::find($desaId)->nama }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach (\App\Models\Desa::all() as $desa)
                            <a class="dropdown-item"
                                href="{{ route('admin.pendataan.index', ['desa_id' => $desa->id]) }}">{{ $desa->nama }}</a>
                        @endforeach
                    </div>
                </div>
                @endif
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

        });

    </script>
@stop
