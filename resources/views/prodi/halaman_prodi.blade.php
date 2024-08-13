@include('layout.header')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Data Prodi</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="py-4 d-flex justify-content-between alignitems-center">
                    <h2>Tabel Program Studi</h2>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Ketua Program Studi</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($KurirData as $prodi)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td>{{$prodi->nama}}</td>
                            <td>{{$prodi->ketua_prodi}}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{route('prodi.tampil_dosen_prodi',$prodi->id) }}">Lihat Dosen Prodi</a>
                            </td>
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
@include('layout.footer')
