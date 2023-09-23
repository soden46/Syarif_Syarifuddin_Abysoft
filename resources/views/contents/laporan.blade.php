@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Data Penduduk</h6>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
    </div>
    <div class="card-body">
        <div class="row">
            <form action="{{route('excel')}}" method="GET">
                <div class="col-6 ms-4 float-right">
                    <button type="submit" class="btn btn-md btn-success" onclick="laporan();" id="btnexport" name="btnexport">Export Excel</button>
                    <input type="text" name="prvs" id="prvs" value="{{request()->input('provinsi')}}" hidden>
                    <input type="text" name="kbptn" id="kbptn" value="{{request()->input('kabupaten')}}" hidden>
                </div>
            </form>
            <form action="{{route('laporan/cari')}}" method="GET" class="col-1 d-flex mx-auto mb-3 float-left">
                <div class="form-inline">
                    <div class="col-3 d-flex">
                        <select class="form-control" id="provinsi" name="provinsi">
                            <option value="">Pilih Provinsi</option>
                            @foreach($provinsi as $data)
                            <option value="{{$data->Nama_Provinsi}}" {{request()->input('provinsi')==$data->Nama_Provinsi ? 'selected' : '' }}>{{$data->Nama_Provinsi}}</option>
                            @endforeach
                        </select>
                        <select class="form-control ms-2" id="kabupaten" name="kabupaten" class="form-control col-2 px-3">
                            <option value="">Pilih Kabupaten</option>
                            @foreach($kabupaten as $data)
                            <option value="{{$data->Nama_Kabupaten}}" {{request()->input('kabupaten')==$data->Nama_Kabupaten ? 'selected' : '' }}>{{$data->Nama_Kabupaten}}</option>
                            @endforeach
                        </select>
                        <input class="form-control col-2 ms-2" type="text" id="nama" name="nama" placeholder="Pencarian Nama">
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" name="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datawarga as $data)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$data->Nama}}</td>
                        <td>{{$data->NIK}}</td>
                        <td>{{$data->tgl_lahir}}</td>
                        <td>{{$data->Alamat.", ".$data->Kabupaten.", ".$data->Provinsi}}</td>
                        <td>{{$data->Jenis_kelamin}}</td>
                        <td>{{$data->created_at}}</td>

                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="7" class="text-center">
                            Total Penduduk: {!!$jumlah!!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex">
                {!! $datawarga->links() !!}
            </div>
        </div>
    </div>
    <!-- Filter Data Tabel Berdasarkan Provinsi atau Kabupaten -->
    <script>
        // Filter Data Tabel Laporan
        $(document).ready(function() {

            var prov = $("#provinsi");
            var kab = $("#kabupaten");
            var nama = $("#nama");

            // Filter Tabel Berdasarkan Provinsi
            if (prov !== "") {
                $("#provinsi").change(function() {
                    var the_selected_prov = $(this).val();
                    window.location = "/laporan/cari?provinsi=" + the_selected_prov;
                });
            }
            if (kab !== "") {
                // Filter Tabel Berdasarkan Kabupaten
                $("#kabupaten").change(function() {
                    var the_selected_kab = $(this).val();
                    window.location = "/laporan/cari?kabupaten=" + the_selected_kab;
                });
            }

        });
        // Filter Data Ekport Excel
        function laporan() {
            $(document).ready(function() {

                var prov = $("#provinsi");
                var kab = $("#kabupaten");
                // Filter Tabel Berdasarkan Provinsi
                if (prov !== "") {
                    $("#btnexport").click(function() {
                        var the_selected_prov = $(this).val();
                        window.location = "/excel?provinsi=" + the_selected_prov;
                    });
                }
                if (kab !== "") {
                    // Filter Tabel Berdasarkan Kabupaten
                    $("#btnexport").click(function() {
                        var the_selected_kab = $(this).val();
                        window.location = "/excel?kabupaten=" + the_selected_kab;
                    });
                }
            });
        }
    </script>
    @endsection