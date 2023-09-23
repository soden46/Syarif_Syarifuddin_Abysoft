<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Antrian</title>
    <style>
        body {
            font-size: 18px;
            font-family: Verdana, Tahoma, "DejaVu Sans", sans-serif;
        }

        .table,
        .td,
        .th {
            border: 1px solid black;
            text-align: center
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .text-center {
            text-align: center;
        }

        .text-success {
            color: green
        }

        .text-danger {
            color: red
        }

        .fw-bold {
            font-weight: bold
        }

        footer {
            position: fixed;
            bottom: 20px;
            left: 0px;
            right: 0px;
            height: 150px;
            text-align: center;
            vertical-align: top
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title fs-4 text-center">#ANTRIAN-0{{ $antrian->id }}</h2>
            <div class="pt-2">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td class="text-center">:</td>
                        <td>{{ $antrian->nama }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td class="text-center">:</td>
                        <td>{{ $antrian->alamat }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td class="text-center">:</td>
                        <td>{{ $antrian->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td>Golongan Darah</td>
                        <td class="text-center">:</td>
                        <td>{{ $antrian->gol_darah }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>