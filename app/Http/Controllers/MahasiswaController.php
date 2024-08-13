<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(){
        $DataMahasiswa = Mahasiswa::all();
        return view('mahasiswa.dashboard_mahasiswa', ['KurirData' => $DataMahasiswa]);
    }
    public function create(){
        return view('mahasiswa.form_tambah_mahasiswa');
    }
    public function store(request $request){
        $validateData = $request->validate([
            'nim' => 'required|size:8|unique:mahasiswas',
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => '',
        ]);
        Mahasiswa::create($validateData);
        return redirect('mahasiswa')->with('pesan', "Tambah data {$validateData['nama']} berhasil");
    }
    public function show($mahasiswa){
        $DataMahasiswa = Mahasiswa::find($mahasiswa);
        return view('mahasiswa.halaman_profil',['KurirData' => $DataMahasiswa]);
    }
    public function edit(Mahasiswa $mahasiswa){
        return view('mahasiswa.form_edit',['mahasiswa' => $mahasiswa]);
    }
    public function update(Request $request, Mahasiswa $mahasiswa){
        $validateData = $request->validate([
            'nim' => 'required|size:8|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => '',
        ]);
        Mahasiswa::where('id', $mahasiswa->id)->update($validateData);
        return redirect('mahasiswa')->with('pesan', "Update data {$validateData['nama']} berhasil");
    }
    public function delete($mahasiswa){
        $mahasiswa = Mahasiswa::find($mahasiswa);
        $mahasiswa->delete();
        return redirect('mahasiswa')->with('pesan', "Hapus data $mahasiswa->nama berhasil");
    }
    public function tampil_wali_mahasiswa(){
        $DataWali = Mahasiswa::all();
        return view('mahasiswa.tampil_wali_mahasiswa', ['KurirData' => $DataWali]);
    }
    public function tampil_matakuliah(){
        $matakuliah_mahasiswa = Mahasiswa::all();
        return view('mahasiswa.halaman_mahasiswa_matakuliah', ['KurirData' => $matakuliah_mahasiswa]);
    }
    public function mahasiswa_yg_ambil_matakuliah($matakuliah){
        $matakuliah_mahasiswa = Mahasiswa::find($matakuliah);
        return view('mahasiswa.halaman_mahasiswa_yg_ambil_matakuliah', ['KurirData' => $matakuliah_mahasiswa]);
    }
}
