<?php

namespace App\Http\Controllers;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function tampil_matakuliah(){
        $matakuliah = Matakuliah::all();
        return view('matakuliah.halaman_matakuliah', ['KurirData' => $matakuliah]);
    }
    public function tampil_mahasiswa_matakuliah($matakuliah){
        $mahasiswa_matakuliah    = Matakuliah::find($matakuliah);
        return view('matakuliah.halaman_matakuliah_yg_diambil_mahasiswa', ['KurirData' => $mahasiswa_matakuliah]);
    }
}
