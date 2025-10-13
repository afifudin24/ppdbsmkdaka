<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminJurusanController;
use App\Http\Controllers\AdminPendaftaranController;
use App\Http\Controllers\AgendaKehadiranController;
use App\Http\Controllers\AdminSiswaController;
use App\Http\Controllers\AdminGuruController;
use App\Http\Controllers\SuratKeteranganController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\DataKehadiranController;
use App\Models\PendaftaranModel;
use App\Models\ProfileSekolahModel;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing.index', [
        'data_pendaftaran' => PendaftaranModel::where('tutup', 0)->get(),
        'sekolah' => ProfileSekolahModel::first()
    ]);
});

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);




Route::get('/auth/daftar', [AuthController::class, 'daftar']);
Route::post('/auth/daftar', [AuthController::class, 'store']);

// ekspor siswa
Route::get('/admin/siswa/ekspor', [SiswaController::class, 'admin_ekspor'])->name('admin_ekspor')->middleware('is_admin');
Route::get('/admin', [AdminController::class, 'index'])->middleware('is_admin');
Route::get('/admin/profile', [AdminController::class, 'profile'])->middleware('is_admin');
Route::post('/admin/profile/foto', [AdminController::class, 'profile_foto'])->middleware('is_admin');
Route::post('/admin/profile/akun', [AdminController::class, 'profile_akun'])->middleware('is_admin');
Route::post('/admin/profile/info', [AdminController::class, 'profile_info'])->middleware('is_admin');

Route::resource('/admin/jurusan', AdminJurusanController::class)->middleware('is_admin');
Route::resource('/admin/agendakehadiran', AgendaKehadiranController::class)->middleware('is_admin');
Route::get('/admin/agendakehadiran/cetak/{id}', [DataKehadiranController::class, 'cetakdatakehadiran'])->middleware('role:admin,guru');
Route::resource('/admin/siswa', AdminSiswaController::class)->middleware('is_admin');

// Guru
Route::resource('/admin/guru', AdminGuruController::class)->middleware('is_admin');
// verificator
Route::get('/admin/verificator', [AdminGuruController::class, 'verificator'])
    ->middleware('is_admin');
Route::post('/admin/store_verificator', [AdminGuruController::class, 'store_verificator'])
    ->middleware('is_admin');
Route::delete('/admin/delete_verificator/{id}', [AdminGuruController::class, 'delete_verificator'])->middleware('is_admin');

// seksi presensi
Route::get('/admin/seksi_presensi', [AdminGuruController::class, 'seksi_presensi'])
    ->middleware('is_admin');
Route::post('/admin/store_seksi_presensi', [AdminGuruController::class, 'store_seksi_presensi'])
    ->middleware('is_admin');
Route::delete('/admin/delete_seksi_presensi/{id}', [AdminGuruController::class, 'delete_seksi_presensi'])->middleware('is_admin');

Route::resource('/admin/pendaftaran', AdminPendaftaranController::class)->middleware('is_admin');
Route::get('/admin/pendaftaran_siswa/{id_pendaftaran}/{id_siswa}', [AdminPendaftaranController::class, 'show_siswa'])->middleware('is_admin');
Route::get('/admin/pendaftaran_siswa/lulus/{status}/{id_detail_pendaftaran}', [AdminPendaftaranController::class, 'lulus'])->middleware('is_admin');
Route::get('/admin/pendaftaran_pdf/{id}/{status}', [AdminPendaftaranController::class, 'pdf_pendaftaran'])->middleware('is_admin');
Route::post('/admin/pendaftaran_status/', [AdminPendaftaranController::class, 'pendaftaran_status'])->middleware('is_admin');
Route::get('/admin/pendaftaran_excel/{id}/{status}', [AdminPendaftaranController::class, 'pendaftaran_excel'])->middleware('is_admin');

Route::get('/siswa', [SiswaController::class, 'index'])->middleware('is_siswa');
Route::get('/siswa/pendaftaran', [SiswaController::class, 'pendaftaran']);


Route::get('/siswa/pendaftaran_edit/{pendaftaran:id}', [SiswaController::class, 'edit_pendaftaran'])->middleware('is_siswa');
Route::post('/siswa/pendaftaran_edit/{pendaftaran:id}', [SiswaController::class, 'update_pendaftaran'])->middleware('is_siswa');
Route::get('/siswa/pendaftaran_detail/{pendaftaran:id}', [SiswaController::class, 'detail_pendaftaran'])->middleware('is_siswa');
Route::get('/siswa/cetak_pendaftaran/{pendaftaran:id}', [SiswaController::class, 'cetak_pendaftaran'])->middleware('is_siswa');
Route::get('/siswa/pendaftaran_cetak/{pendaftaran:id}', [SiswaController::class, 'cetak_bukti'])->middleware('is_siswa');
Route::get('/siswa/notif/{id}', [SiswaController::class, 'notif'])->middleware('is_siswa');

Route::get('/siswa/datadiri', [SiswaController::class, 'datadiri'])->middleware('is_siswa');

Route::get('/siswa/profile', [SiswaController::class, 'profile'])->middleware('is_siswa');
Route::post('/siswa/profile', [SiswaController::class, 'update_profile'])->middleware('is_siswa');
Route::post('/siswa/edit_foto', [SiswaController::class, 'edit_foto'])->middleware('is_siswa');

// cetak surat 
Route::get('/cetak_surat_keterangan/{no_regis}', 
    [SuratKeteranganController::class, 'index']
)->middleware('role:admin,siswa,guru');


// Belum login
Route::get('/inputdaftar', [SiswaController::class, 'input_pendaftaran']);
Route::get('/login', [AuthController::class, 'index']);
Route::get('/auth/siswa', [AuthController::class, 'loginsiswa']);
Route::get('/auth/guru', [AuthController::class, 'loginguru']);

// siswa daftar
Route::post('/siswa/pendaftaran', [SiswaController::class, 'store_pendaftaran']);

// cek qr
Route::get('/qr-code/{no_regis}', function ($no_regis) {
    $path = public_path("qr_code/{$no_regis}.svg");

    if (!file_exists($path)) {
        abort(404);
    }

    $qrSvg = file_get_contents($path);

    return view('qr.show', compact('qrSvg', 'no_regis'));
});

// Dashboard Guru
Route::get('/guru', [GuruController::class, 'index'])->middleware('is_guru');
Route::get('/guru/siswa', [GuruController::class, 'siswa'])->middleware('is_guru');
Route::get('/guru/daftarkansiswa', [GuruController::class, 'daftarkan_siswa'])->middleware('is_guru');
Route::get('/guru/kehadiransiswa', [GuruController::class, 'kehadiran_siswa'])->middleware('is_guru');

// agenda kehadiran siswa
Route::get('/guru/agendakehadiran', [GuruController::class, 'agenda_kehadiran'])->middleware('is_guru');
Route::get('/guru/agendakehadiran/{id}', [GuruController::class, 'agenda_kehadiran_detail'])->middleware('is_guru');

// verificator
Route::get('/guru/verificator/siswa', [GuruController::class, 'verificator_siswa'])->middleware('is_guru');
Route::get('/guru/verificator/verifikasi', [GuruController::class, 'verifikasipendaftar'])->middleware('is_guru');
Route::get('/guru/verificator/pendaftaran', [GuruController::class, 'verificator_pendaftaran'])->middleware('is_guru');
Route::get('/guru/verificator/lihatpendaftaran/{id}', [GuruController::class, 'verificator_lihat_pendaftaran'])->middleware('is_guru');
Route::get('/guru/verificator/pendaftaran_siswa/{id}/{siswaId}', [GuruController::class, 'verificator_siswa_pendaftaran'])->middleware('is_guru');
Route::get('/guru/verificator/pendaftaran_siswa/lulus/{status}/{id_detail_pendaftaran}', [GuruController::class, 'lulus'])->middleware('is_guru');

// ekspor siswa
Route::get('/guru/verificator/siswa/ekspor', [SiswaController::class, 'ekspor'])->middleware('is_guru');

// seksi presensi
Route::get('/guru/seksipresensi/agendakehadiran', [AgendaKehadiranController::class, 'agenda_kehadiran'])->middleware('is_guru');
Route::get('/guru/seksipresensi/presensikehadiran', [AgendaKehadiranController::class, 'presensi'])->middleware('is_guru');
Route::post('/guru/seksipresensi/simpanpresensi', [AgendaKehadiranController::class, 'simpanpresensi'])->middleware('is_guru');