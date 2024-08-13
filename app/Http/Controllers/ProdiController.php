<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function tampil_prodi(){
        $prodi = prodi::all();
        return view('prodi.halaman_prodi', ['KurirData' => $prodi]);
    }
    public function tampil_dosen_prodi($prodi){
        $dosenprodi = prodi::find($prodi);
        return view('prodi.halaman_dosen_prodi', ['KurirData' => $dosenprodi]);
    }
}
