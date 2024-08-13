<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{assets('css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Data Matakuliah Yang Diambil Mahasiswa</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="py-4 d-flex justify-content-between alignitems-center">
                    <h2>Data Matakuliah Yang Diambil Mahasiswa</h2>
                    <a href="{{ url('/matakuliah') }}" class="btn btn-sm btn-primary">
                        Kembali
                    </a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>

                            <th>Kode</th>
                            <th>Nama Matakuliah</th>
                            <th>Jumlah SKS</th>
                            <th>Mahasiswa Yang Memprogram</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$KurirData->kode}}</td>
                            <td>{{$KurirData->nama}}</td>
                            <td>{{$KurirData->jumlah_sks}}</td>
                            <td>
                                @foreach($KurirData->Mahasiswa as $mahasiswa)
                                <div class="card shadow-sm mb-2">
                                    <div class="card-body">
                                        <i class="fa fa-comments"></i>
                                        {{$mahasiswa->nama}}
                                    </div>
                                </div>
                                @endforeach
                            </td>
                            <td>
                                @foreach($KurirData->Mahasiswa as $mahasiswa)
                                <div class="card shadow-sm mb-2">
                                    <div class="card-body">
                                        <i class="fa fa-comments"></i>
                                        {{$mahasiswa->nim}}
                                    </div>
                                </div>
                                @endforeach
                            </td>
                            <td>
                                @foreach($KurirData->Mahasiswa as $mahasiswa)
                                <div class="card shadow-sm mb-2">
                                    <div class="card-body">
                                        <i class="fa fa-comments"></i>
                                        {{$mahasiswa->jurusan}}
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