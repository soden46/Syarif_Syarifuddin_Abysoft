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
                <h3 class="card-title">Edit Data Penduduk</h3>
            </div>
            <div class="card-body">
                <form action="{{route('update',$datawarga->id)}} " method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama')is-invalid @enderror" id="nama" value="{{$datawarga->Nama}}" required>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type=" text" name="nik" class="form-control @error('nik')is-invalid @enderror" id="nik" value="{{$datawarga->NIK}}" required>
                        @error('nik')
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
                    <div class="form-group">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input class="form-control" type="date" name="tgl_lahir" id="tgl_lahir" value="{{$datawarga->tgl_lahir}}" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" required>{{$datawarga->Alamat}}
                        </textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="provinsi" class="form-label">Provinsi</label>
                        <select class="form-control" id="provinsi" name="provinsi" required>
                            <option>Pilih Provinsi</option>
                            @foreach($provinsi as $prov)
                            <option value="{{$prov->id}}">{{$prov->Nama_Provinsi}}</option>
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
                    <button class="btn btn-primary mt-12" type="submit">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Dependent Select -->
<script>
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
                            $.each(data, function(key, kabupaten) {
                                $('select[name="kabupaten"]').append('<option value="' + key + '">' + kabupaten.Nama_Kabupaten + '</option>');
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
</script>
@endsection