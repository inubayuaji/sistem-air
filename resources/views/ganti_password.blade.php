@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Ganti Password</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ganti password</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.password.ubah') }}">
                @if (\Session::has('berhasil'))
                    <div class="alert alert-success">
                        {{ \Session::get('berhasil') }}
                    </div>
                @endif
                @if (\Session::has('gagal'))
                    <div class="alert alert-warning">
                        {{ \Session::get('gagal') }}
                    </div>
                @endif
                @csrf
                <div class="form-group">
                    <label>Password lama</label>
                    <input type="password" class="form-control" name="old_password" required>
                </div>
                <div class="form-group">
                    <label>Password baru</label>
                    <input type="password" class="form-control" name="new_password" required>
                </div>
                <div class="form-group">
                    <label>Ketik ulang password</label>
                    <input type="password" class="form-control" name="re_password" required>
                </div>

                <div class="mb-0 form-group">
                    <button class="btn btn-sm btn-primary" type="submit">Ubah</button>
                </div>
            </form>
        </div>
    </div>
@stop
