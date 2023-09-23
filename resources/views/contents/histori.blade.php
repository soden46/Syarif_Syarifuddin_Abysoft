@extends('layouts.app')
@section('content')
<div class="container" id="content">

    <div class="row">
        <div class="col-xs-5" style="padding-right:10px">
            <div class="card-queue">
                <div class="body">
                    <div class="avatar" align="center">
                        <img src="https://image.flaticon.com/icons/png/512/146/146022.png" class="img-responsive" alt="Cinque Terre">
                    </div>
                    <div class="text">
                        <hr>
                        <div class="card-text">
                            <strong>Nama:</strong>
                            {{ $peserta->nama}}
                        </div>
                        <hr>
                        <div class="card-text">
                            <strong>Alamat:</strong>
                            {{ $peserta->alamat}}
                        </div>
                        <hr>
                        <div class="card-text">
                            <strong>Jenis Kelamin:</strong>
                            {{ $peserta->jenis_kelamin}}
                        </div>
                        <hr>
                        <div class="card-text">
                            <strong>Golongan Darah:</strong>
                            {{ $peserta->gol_darah}}
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-7" style="padding-left:0px">
            <div class="btn-group btn-group-justified btn-tab-managt-queue">
                <a href="javascript:checkout()" class="btn btn-default">
                    <span class="glyphicon glyphicon-chevron-left"></span></a>
                <a href="#" class="btn btn-default">
                    <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>


            @foreach ($visits as $key => $visit)
            <div class="card-station">
                <div class="body">
                    <div class="row">
                        <div class="col-xs-5 left">
                            {{$key + 1}}
                        </div>
                        <div class="col-xs-5 center">
                            <div class="text">
                                <div class="card-text">
                                    <span class="glyphicon glyphicon-flag"></span> {{
                                    $visit->status }}
                                </div>
                                <div class="card-text">
                                    <span class="glyphicon glyphicon-time"> </span> {{ date('d/m/Y', strtotime($visit->date)) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-2 right">
                            <span class="glyphicon {{ $visit->status == 'Sudah Diperiksa' ? 'glyphicon-ok-circle ' : 'glyphicon-option-horizontal'}} text-green"></span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

@endsection