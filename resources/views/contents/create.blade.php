@extends('layouts.app')
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Registrasi Peserta Vaksin</h3>
            </div>
            <div class="card-body">
                <form action="/create/store " method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama')is-invalid @enderror" id="nama" value="{{old('nama')}}" required>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="nomor_ktp" class="form-label">NO KTP</label>
                        <input type="number" name="nomor_ktp" class="form-control @error('nomor_ktp')is-invalid @enderror" id="nomor_ktp" value="{{old('nomor_ktp')}}" required>
                        @error('nomor_ktp')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="provinsi" class="form-label">Provinsi</label>
                        <select class="form-control" id="provinsi" name="provinsi" required>
                            <option>Pilih Provinsi</option>
                            @foreach($provinsi as $prov)
                            <option value="{{$prov->code}}">{{$prov->name}}</option>
                            @endforeach
                        </select>
                        @error('provinsi')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kabupaten" class="form-label">Kabupaten</label>
                        <select class="form-control" name="kabupaten" id="kabupaten" required></select>
                    </div>
                    <div class="mb-3">
                        <label for="kecamatan" class="form-label">Kecamatan</label>
                        <select class="form-control" name="kecamatan" id="kecamatan" required></select>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control @error('pekerjaan')is-invalid @enderror" id="pekerjaan" value="{{old('pekerjaan')}}" required>
                        @error('pekerjaan')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="pria" name="jenis_kelamin" value="pria" required>
                        <label class="form-check-label" for="pria">Pria</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="wanita" name="jenis_kelamin" value="wanita" required>
                        <label class="form-check-label" for="wanita">Wanita</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="gol_darah" class="form-label">Golongan Darah</label>
                        <input type=" text" name="gol_darah" class="form-control @error('gol_darah')is-invalid @enderror" id="gol_darah" value="{{old('gol_darah')}}" required>
                        @error('gol_darah')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button class="btn btn-primary mt-12" type="submit">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Dependent Select -->
<script>
    // Pilih Kabupaten Berdasarkan Provinsi
    $(document).ready(function() {
        $('#provinsi').on('change', function() {
            var prov = $(this).val();
            if (prov) {
                $.ajax({
                    url: '/getKab/' + prov,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#kabupaten').empty();
                            $('#kabupaten').append('<option hidden>Pilih Kabupaten</option>');
                            $.each(data, function(code, kabupaten) {
                                $('select[name="kabupaten"]').append('<option value="' + kabupaten.code + '">' + kabupaten.name + '</option>');
                            });
                        } else {
                            $('#kabupaten').empty();
                        }
                    }
                });
            } else {
                $('#kabupaten').empty();
            }
        });
    });
    // Pilih Kecamatan Berdasarkan Kabupaten
    $(document).ready(function() {
        $('#kabupaten').on('change', function() {
            var kab = $(this).val();
            if (kab) {
                $.ajax({
                    url: '/getKec/' + kab,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#kecamatan').empty();
                            $('#kecamatan').append('<option hidden>Pilih Kecamatan</option>');
                            $.each(data, function(code, kecamatan) {
                                $('select[name="kecamatan"]').append('<option value="' + kecamatan.code + '">' + kecamatan.name + '</option>');
                            });
                        } else {
                            $('#kecamatan').empty();
                        }
                    }
                });
            } else {
                $('#kecamatan').empty();
            }
        });
    });
</script>
@endsection