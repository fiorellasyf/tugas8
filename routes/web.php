<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MatakuliahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::get('/mahasiswa/wali', [MahasiswaController::class, 'tampil_wali_mahasiswa']);
Route::get('/mahasiswa/tampil_matakuliah', [MahasiswaController::class, 'tampil_matakuliah'])->name('mahasiswa.tampil_matakuliah');
Route::get('/mahasiswa/mahasiswa_yg_ambil_matakuliah/{id}', [MahasiswaController::class, 'mahasiswa_yg_ambil_matakuliah'])->name('mahasiswa.mahasiswa_yg_ambil_matakuliah');
Route::get('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::get('/mahasiswa/delete/{mahasiswa}', [MahasiswaController::class, 'delete'])->name('mahasiswa.delete');

Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
Route::post('/dosen/store', [DosenController::class, 'store'])->name('dosen.store');
Route::get('/dosen/{dosen}', [DosenController::class, 'show'])->name('dosen.show');
Route::get('/dosen/{dosen}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
Route::put('/dosen/{dosen}', [DosenController::class, 'update'])->name('dosen.update');
Route::get('/dosen/delete/{dosen}', [DosenController::class, 'delete'])->name('dosen.delete');

Route::get('/prodi', [ProdiController::class, 'tampil_prodi'])->name('prodi.tampil_prodi');
Route::get('/prodi/dosen/{id}', [ProdiController::class, 'tampil_dosen_prodi'])->name('prodi.tampil_dosen_prodi');

Route::get('/matakuliah', [MatakuliahController::class, 'tampil_matakuliah'])->name('matakuliah.tampil_matakuliah');
Route::get('/matakuliah/tampil_mahasiswa_matakuliah/{id}', [MatakuliahController::class, 'tampil_mahasiswa_matakuliah'])->name('matakuliah.tampil_mahasiswa_matakuliah');




