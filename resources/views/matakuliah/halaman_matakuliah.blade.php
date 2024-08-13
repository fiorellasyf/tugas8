@include('layout.header')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Data Matakuliah</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="py-4 d-flex justify-content-between alignitems-center">
                    <h2>Tabel Program Matakuliah</h2>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode </th>
                            <th>Nama Matakuliah</th>
                            <th>Jumlah SKS</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($KurirData as $matkul)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td>{{$matkul->kode}}</td>
                            <td>{{$matkul->nama}}</td>
                            <td>{{$matkul->jumlah_sks}}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('matakuliah.tampil_mahasiswa_matakuliah',$matkul->id)}}">
                                    Lihat Mahasiswa</a>
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
