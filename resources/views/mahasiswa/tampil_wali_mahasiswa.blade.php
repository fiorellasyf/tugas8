<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Data Mahasiswa</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="py-4 d-flex justify-content-between alignitems-center">
                    <h2>Tabel Wali Mahasiswa</h2>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nim</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Jurusan</th>
                            <th>Nama Wali</th>
                            <th>Pekerjaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($KurirData as $mahasiswa)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td>{{$mahasiswa->nim}}</td>
                            <td>{{$mahasiswa->nama}}</td>
                            <td>{{$mahasiswa->jenis_kelamin =='P'?'Perempuan':'Laki-laki'}}</td>
                            <td>{{$mahasiswa->jurusan}}</td>
                            <td>{{$mahasiswa->wali->nama_wali ??''}}</td>
                            <td>{{$mahasiswa->wali->pekerjaan ??''}}</td>
                        </tr>
                        @empty
                        <td colspan="6" class="text-center">Tidak ada
                            data...</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>