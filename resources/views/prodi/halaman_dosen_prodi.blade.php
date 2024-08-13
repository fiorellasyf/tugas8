<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Data jurusan</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="py-4 d-flex justify-content-between alignitems-center">
                    <h2>Data Dosen Program Studi</h2>
                    <a href="{{ url('/prodi') }}" class="btn btn-sm btn-primary">
                        Kembali
                    </a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>

                            <th>Nama</th>
                            <th>Kepala Jurusan</th>
                            <th>Dosen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td>{{$KurirData->nama}}</td>
                            <td>{{$KurirData->ketua_prodi}}</td>
                            <td>
                                @foreach($KurirData->dosen as $dosen)
                                <div class="card shadow-sm mb-2">
                                    <div class="card-body">
                                        <i class="fa fa-comments"></i>
                                        {{$dosen->nama}},
                                    </div>
                                </div>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>