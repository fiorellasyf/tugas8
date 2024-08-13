<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Biodata {{$KurirData->nama}}</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="pt-3">
                    <h1 class="h2">Biodata {{$KurirData->nama}}</h1>
                </div>
                <hr>
                <ul>
                    <li>NIDN: {{$KurirData->nidn}} </li>
                    <li>Nama: {{$KurirData->nama}} </li>
                    <li>Alamat:
                        {{$KurirData->alamat == '' ? 'N/A' : $KurirData->alamat}}
                    </li>
                    <li>No Telepon: {{$KurirData->notelp}} </li>
                </ul>
            </div>
            <div>
                <a class="btn btn-sm btn-info" href="{{ route('dosen.index')}}">Kembali</a>
            </div>
        </div>
    </div>
</body>

</html>