@include('layout.header')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Data Mahasiswa</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="py-4 d-flex justify-content-between alignitems-center">
                    <h2>Tabel Mahasiswa</h2>
                </div>
                <a href="{{ url('/mahasiswa/create') }}" class="btn btn-sm btn-primary">
                    Tambah Mahasiswa
                </a>
                @if(session()->has('pesan'))
                <div class="alert alert-success">
                    {{ session()->get('pesan')}}
                </div>
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nim</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Jurusan</th>
                            <th>Alamat</th>
                            <th>Opsi</th>

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
                            <td>{{$mahasiswa->alamat == '' ? 'N/A' :$mahasiswa->alamat}}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('mahasiswa.show',['mahasiswa' => $mahasiswa->id])}}">Detail</a> |
                                <a class="btn btn-sm btn-warning" href="{{ route('mahasiswa.edit',['mahasiswa' => $mahasiswa->id])}}">Edit</a> |
                                <a href="/mahasiswa/delete/{{ $mahasiswa->id }}" class="btn btn-danger">Hapus</a>
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
@include('layout.footer')
