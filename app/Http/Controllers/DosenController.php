<?php

namespace App\Http\Controllers;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(){
        $DataDosen = Dosen::all();
        return view('dosen.dashboard_dosen', ['KurirData' => $DataDosen]);
    }
    public function create(){
        return view('dosen.form_tambah_dosen');
    }
    public function store(request $request){
        $validateData = $request->validate([
            'nidn' => 'required|size:8|unique:dosens',
            'nama' => 'required|min:3|max:50',
            'alamat' => '',
            'notelp' => 'required|min:11|max:13',
        ]);
        Dosen::create($validateData);
        return redirect('dosen')->with('pesan', "Tambah data {$validateData['nama']} berhasil");
    }
    public function show($dosen){
        $DataDosen = Dosen::find($dosen);
        return view('dosen.halaman_profil',['KurirData' => $DataDosen]);
    }
    public function edit(Dosen $dosen){
        return view('dosen.form_edit',['dosen' => $dosen]);
    }
    public function update(Request $request, Dosen $dosen){
        $validateData = $request->validate([
            'nidn' => 'required|size:8|unique:dosens,nidn,' . $dosen->id,
            'nama' => 'required|min:3|max:50',
            'alamat' => '',
            'notelp' => 'required|min:11|max:13',
        ]);
        Dosen::where('id', $dosen->id)->update($validateData);
        return redirect('dosen')->with('pesan', "Update data {$validateData['nama']} berhasil");
    }
    public function delete($dosen){
        $dosen = Dosen::find($dosen);
        $dosen->delete();
        return redirect('dosen')->with('pesan', "Hapus data $dosen->nama berhasil");
    }
}
