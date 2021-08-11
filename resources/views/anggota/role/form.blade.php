@extends('adminlte::page')

@section('title', ($isEdit ? 'Ubah' : 'Tambah') . ' Role')

@section('content_header')
    <h1>{{$isEdit ? 'Edit' : 'Tambah'}} Role</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">{{ $isEdit ? 'Ubah' : 'Tambah' }} Role</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="pl-2 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form role="form" method="POST"
                action="{{ $isEdit ? route('admin.anggota.role.update', ['id' => $data->id]) : route('admin.anggota.role.simpan') }}">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="name" value="{{ $isEdit ? $data->name : '' }}" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi"
                        value="{{ $isEdit ? $data->deskripsi : '' }}"></textarea>
                </div>
                <div class="form-group">
                    <label>Perimision</label>
                    <select class="form-control" id="permission-list" name="permission[]" multiple>
                        @foreach (Spatie\Permission\Models\Permission::all() as $permission)
                            <option value="{{ $permission->name }}"
                                {{ ($isEdit and $data->hasPermissionTo($permission->name)) ? 'selected' : '' }}>
                                {{ $permission->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="hr-line-dashed"></div>

                <div class="mb-0 form-group">
                    <button class="btn btn-sm btn-default" type="reset">Reset</button>
                    <button class="btn btn-sm btn-primary" type="submit">{{ $isEdit ? 'Ubah' : 'Tambah' }}</button>
                </div>
            </form>
        </div>
    </div>
@stop

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}" />
@endpush

@push('js')
    <script src="{{ asset('vendor/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#permission-list').bootstrapDualListbox();
        });

    </script>
@endpush
