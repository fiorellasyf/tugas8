@include('layout.header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Data Dosen</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="py-4 d-flex justify-content-between alignitems-center">
                    <h2>Tabel Dosen</h2>
                </div>
                <a href="{{ url('/dosen/create') }}" class="btn btn-sm btn-primary">
                    Tambah Dosen
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
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>Opsi</th>

                        </tr>
                    </thead>                    <tbody>
                        @forelse ($KurirData as $dosen)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td>{{$dosen->nidn}}</td>
                            <td>{{$dosen->nama}}</td>
                            <td>{{$dosen->alamat == '' ? 'N/A' :$dosen->alamat}}</td>
                            <td>{{$dosen->notelp}}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('dosen.show',['dosen' => $dosen->id])}}">Detail</a> |
                                <a class="btn btn-sm btn-warning" href="{{ route('dosen.edit',['dosen' => $dosen->id])}}">Edit</a> |
                                <a href="/dosen/delete/{{ $dosen->id }}" class="btn btn-danger">Hapus</a>
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
