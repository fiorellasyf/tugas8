<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Edit</title>
</head>

<body>
    <div class="container pt-4 bg-white">
        <div class="row">
            <div class="col-md-8 col-xl-6">
                <h1>Edit Dosen</h1>
                <hr>
                <form action="{{ route('dosen.update',['dosen' => $dosen->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="nim">NIDN</label>
                        <input type="text" id="nidn" name="nidn" value="{{ old('nidn') ?? $dosen->nidn }}" class="form-control @error('nidn') is-invalid @enderror">
                        @error('nidn')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') ?? $dosen->nama }}" class="form-control @error('nama') is-invalid @enderror">
                        @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                        <div class="mb-3">
                            <label class="form-label" for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" rows="3" name="alamat">{{ old('alamat') ?? $dosen->alamat}}</textarea>
                        </div>
                        <div class="mb-3">
                        <label class="form-label" for="notelp">No Telepon</label>
                        <input type="text" id="notelp" name="notelp" value="{{ old('notelp') ?? $dosen->notelp }}" class="form-control @error('notelp') is-invalid @enderror">
                        @error('notelp')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                        <button type="submit" class="btn btn-primary mb-2">Update</button>
                </form>
            </div>
        </div>