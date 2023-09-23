@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title fs-4">#ANTRIAN-0{{ $no_antrian }}</h2>
                    <div class="pt-2">
                        <div class="row">
                            <label for="nama_pelanggan" class="col-sm-2 col-lg-4">Nama</label>
                            <div class="col-sm-10 col-lg-8">
                                <p>: {{ $create->nama }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <label for="nama_pelanggan" class="col-sm-2 col-lg-4">Alamat</label>
                            <div class="col-sm-10 col-lg-8">
                                <p>: {{ $create->alamat }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <label for="nama_pelanggan" class="col-sm-2 col-lg-4">Jenis Kelamin</label>
                            <div class="col-sm-10 col-lg-8">
                                <p>: {{ $create->jenis_kelamin }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <label for="nama_pelanggan" class="col-sm-2 col-lg-4">Golongan Darah</label>
                            <div class="col-sm-10 col-lg-8">
                                <p>: {{ $create->gol_darah }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('download-antrian/' . $create->id) }}" class="btn btn-success"><i class="bi bi-download"></i> Unduh Antrian</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection