@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Antrian</h6>
        <div class="jam">
            <h3 id="clock">23:57:00</h3>
            <p class="mb-0" id="day">Sabtu, 23 September 2023</p>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
    </div>
    <div class="container">
        <div class="row">
            @foreach($antrian as $data)
            <div class="col-3">
                <div class="card">
                    <h4>Nomor Antrian</h4>
                    <h2 class="display">#Antrian-0{{$data->nomor_antrian}}</h2>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" name="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nomor Antrian</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Golongan Darah</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datapeserta as $data)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td class="idpeserta" hidden>{{$data->id}}</td>
                        <td>{{'#Antrian-0'.$data->nomor_antrian}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{$data->jenis_kelamin}}</td>
                        <td>{{$data->gol_darah}}</td>
                        <td>{{$data->alamat}}</td>
                        <td>{{$data->status}}</td>
                        <td>
                            <form action="{{route('konfirmasi',$data->id)}}" method="POST">
                                @method("POST")
                                @csrf
                                <button type="submit" class="btn btn-success" id="konfirmasi" name="konfirmasi">
                                    <span class="glyphicon glyphicon-ok"> Konfirmasi</span>
                                </button>
                            </form>
                            <form action="" method="GET">
                                <input type="text" name="nomor_antri" id="nomor_antri" value="{{$data->nomor_antrian}}" hidden>
                                @csrf
                                <button type="submit" class="btn btn-primary">Selanjutnya</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Penghitung Antrian -->
    <script src="{{ asset('js/jam.js') }}"></script>
    <script>
        function updateNomorAntrian() {
            $('.display').each(function() {
                var layananElement = $(this);
                var antrianId = layananElement.data('antrian-id');
                var kodeContainer = layananElement.find('h1');

                // Ganti 'URL_ANTRIAN' dengan URL endpoint yang mengambil nomor antrian saat ini dari backend
                $.get('/antrian-selanjutnya', {
                    nomor_antrian: antrianId
                }, function(data) {
                    kodeContainer.text(data.kode);
                });
            });
        }

        // Panggil fungsi updateNomorAntrian setiap 5 detik
        setInterval(updateNomorAntrian, 5000);

        // Panggil fungsi updateNomorAntrian saat halaman pertama kali dimuat
        $(document).ready(function() {
            updateNomorAntrian();
        });
    </script>

    @endsection