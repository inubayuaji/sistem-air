@extends('adminlte::page')

@section('title', ($isEdit ? 'Ubah' : 'Tambah') . ' Tagihan')

@section('content_header')
    <h1>{{$isEdit ? 'Edit' : 'Tambah'}} Tagihan</h1>
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">{{ $isEdit ? 'Ubah' : 'Tambah' }} Tagihan</h3>
        </div>
        <div class="card-body">
            <form role="form" method="POST"
                action="{{ $isEdit ? route('admin.pendataan.update', ['id' => $data->pelanggan->id, 'tagihan_id' => $data->id]) : route('admin.pendataan.simpan') }}">
                @csrf
                <div class="form-group">
                    <label>Meter lalu</label>
                    <input id="meter_lalu" type="number" class="form-control" name="meter_lalu" value="{{ $isEdit ? $data->meter_lalu : '' }}" readonly>
                </div>
                <div class="form-group">
                    <label>Meter sekarang</label>
                    <input id="meter_sekarang" type="number" class="form-control" name="meter_sekarang" value="{{ $isEdit ? $data->meter_sekarang : '' }}" required>
                </div>
                <div class="form-group">
                    <label>Jumlah meter</label>
                    <input id="jumlah_meter" type="number" class="form-control" name="jumlah_meter" value="{{ $isEdit ? $data->jumlah_meter : '' }}" readonly>
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

@section('js')
<script>
    const meterLalu = document.querySelector('#meter_lalu');
    const meterSekarang = document.querySelector('#meter_sekarang');
    const jumlahMeter = document.querySelector('#jumlah_meter');

    meterSekarang.addEventListener('keyup', function() {
        jumlahMeter.value = meterSekarang.value - meterLalu.value;
    });
</script>
@endsection