<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Data Mahasiswa Yang Mengambil Mata Kuliah</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="py-4 d-flex justify-content-between alignitems-center">
                    <h2>Data Mahasiswa Yang Mengambil Mata Kuliah</h2>
                    <a href="{{ url('/mahasiswa/tampil_matakuliah') }}" class="btn btn-sm btn-primary">
                        Kembali
                    </a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>

                            <th>Nim</th>
                            <th>Nama Mahasiswa</th>
                            <th>Jurusan</th>
                            <th>Mata Kuliah Yang Diambil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$KurirData->nim}}</td>
                            <td>{{$KurirData->nama}}</td>
                            <td>{{$KurirData->jurusan}}</td>
                            <td>
                                @foreach($KurirData->Matakuliah as $matkul)
                                <div class="card shadow-sm mb-2">
                                    <div class="card-body">
                                        <i class="fa fa-comments"></i>
                                        {{$matkul->kode}}
                                    </div>
                                </div>
                                @endforeach
                            </td>
                            <td>
                                @foreach($KurirData->Matakuliah as $matkul)
                                <div class="card shadow-sm mb-2">
                                    <div class="card-body sm">
                                        <i class="fa fa-comments"></i>
                                        {{$matkul->nama}}
                                    </div>
                                </div>
                                @endforeach
                            </td>
                            <td>
                                @foreach($KurirData->Matakuliah as $matkul)
                                <div class="card shadow-sm mb-2">
                                    <div class="card-body sm">
                                        <i class="fa fa-comments"></i>
                                        {{$matkul->jumlah_sks}}
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