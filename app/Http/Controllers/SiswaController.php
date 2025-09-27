<?php

namespace App\Http\Controllers;

use App\Models\JurusanModel;
use App\Models\PendaftaranDetailModel;
use App\Models\PendaftaranModel;
use App\Models\ProfileSekolahModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index()
    {
        $notifikasi = PendaftaranDetailModel::where('siswa_id', session()->get('id'))
            ->where('notif', 0)
            ->get();

        $cek_lulus =  PendaftaranDetailModel::where('siswa_id', session()->get('id'))
            ->where('status', 1)
            ->first();

        return view('siswa.index', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('assets/template/dist') . '/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('assets/template/dist') . '/assets/libs/prismjs/prism.js"></script>
                <script src="' . url('assets/template/dist') . '/assets/js/widget/ui-card-init.js"></script>
            ',
            'menu' => 'dashboard',
            'judul' => 'Dashboard',
            'user' => SiswaModel::firstWhere('id', session()->get('id')),
            'sekolah' => ProfileSekolahModel::first(),
            'notifikasi' => $notifikasi,
            'cek_lulus' => $cek_lulus,
            'data_pendaftaran' => PendaftaranModel::where('tutup', 0)->get(),
            'detail_pendaftaran' => PendaftaranDetailModel::where('siswa_id', session()->get('id'))->get()
        ]);
    }

    public function profile()
    {
        return view('siswa.profile', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('assets/template/dist') . '/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('assets/template/dist') . '/assets/libs/prismjs/prism.js"></script>
            ',
            'menu' => 'profile',
            'judul' => 'My Profile',
            'user' => SiswaModel::firstWhere('id', session()->get('id')),
            'sekolah' => ProfileSekolahModel::first(),
        ]);
    }
    public function edit_foto(Request $request)
    {
        if ($request->file('foto')) {
            if ($request->foto_lama) {
                if ($request->foto_lama != 'default.png') {
                    Storage::delete('assets/files/' . $request->foto_lama);
                }
            }
            $data['foto'] = str_replace('assets/files/', '', $request->file('foto')->store('assets/files'));
        }

        SiswaModel::where('id', session()->get('id'))
            ->update($data);
        return redirect('/siswa/profile')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Foto profile di edit',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }
    public function update_profile(Request $request)
    {

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
        ];

        SiswaModel::where('id', session()->get('id'))
            ->update($data);

        return redirect('/siswa/profile')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Akun di edit',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }

    public function pendaftaran()
    {
        $notifikasi = PendaftaranDetailModel::where('siswa_id', session()->get('id'))
            ->where('notif', 0)
            ->get();

        $cek_lulus =  PendaftaranDetailModel::where('siswa_id', session()->get('id'))
            ->where('status', 1)
            ->first();

        return view('siswa.pendaftaran.index', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('assets/template/dist') . '/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('assets/template/dist') . '/assets/libs/prismjs/prism.js"></script>
                <script src="' . url('assets/template/dist') . '/assets/js/widget/ui-card-init.js"></script>

                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
                <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
            ',
            'menu' => 'pendaftaran',
            'judul' => 'Pendaftaran',
            'user' => SiswaModel::firstWhere('id', session()->get('id')),
            'sekolah' => ProfileSekolahModel::first(),
            'notifikasi' => $notifikasi,
            'cek_lulus' => $cek_lulus,
            'data_pendaftaran' => PendaftaranModel::where('tutup', 0)->get(),
            'detail_pendaftaran' => PendaftaranDetailModel::where('siswa_id', session()->get('id'))->get()
        ]);
    }
    public function input_pendaftaran(PendaftaranModel $pendaftaran)
    {
        $lagi_daftar = PendaftaranDetailModel::where('siswa_id', session()->get('id'))
            ->where('status', 0)
            ->first();

        if ($lagi_daftar) {
            return redirect('/siswa/pendaftaran')->with('pesan', "
                <script>
                    Swal.fire(
                        {
                            title: 'Error',
                            text: 'Anda sudah mendaftar dan sedang di verifikasi!',
                            icon: 'error',
                        }
                    );
                </script>
            ");
        }
        return view('siswa.pendaftaran.create', [
            'plugins' => '
                
            ',
            'menu' => 'pendaftaran',
            'judul' => 'Input Pendaftaran',
            'user' => SiswaModel::firstWhere('id', session()->get('id')),
            'sekolah' => ProfileSekolahModel::first(),
            'pendaftaran' => $pendaftaran,
            'jurusan' => JurusanModel::all()
        ]);
    }
    public function store_pendaftaran(Request $request, PendaftaranModel $pendaftaran)
    {
        $data = [
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'jurusan' => $request->jurusan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'anak_ke' => $request->anak_ke,
            'jumlah_saudara' => $request->jumlah_saudara,
            'hobi' => $request->hobi,
            'cita_cita' => $request->cita_cita,
            'hp' => $request->hp,
            'email' => $request->email,
            'jenis_tempat_tinggal' => $request->jenis_tempat_tinggal,
            'alamat' => $request->alamat,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'pos' => $request->pos,
            'jarak' => $request->jarak,
            'transportasi' => $request->transportasi,
            'no_kk' => $request->no_kk,
            'kepala_kk' => $request->kepala_kk,
            'nama_ayah' => $request->nama_ayah,
            'nik_ayah' => $request->nik_ayah,
            'tahun_lahir_ayah' => $request->tahun_lahir_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah' => $request->penghasilan_ayah,
            'pendidikan_ayah' => $request->pendidikan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'nik_ibu' => $request->nik_ibu,
            'tahun_lahir_ibu' => $request->tahun_lahir_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu' => $request->penghasilan_ibu,
            'pendidikan_ibu' => $request->pendidikan_ibu,
            'sekolah_asal' => $request->sekolah_asal,
            'jenjang_sekolah' => $request->jenjang_sekolah,
            'npsn_sekolah' => $request->npsn_sekolah,
            'foto' => $request->foto_lama,
        ];

        if ($request->file('foto')) {
            if ($request->gambar_lama) {
                if ($request->gambar_lama != 'default.png') {
                    Storage::delete('assets/files/' . $request->gambar_lama);
                }
            }
            $data['foto'] = str_replace('assets/files/', '', $request->file('foto')->store('assets/files'));
        }

        $data_pendaftaran = [
            'pendaftaran_id' => $pendaftaran->id,
            'siswa_id' => session()->get('id'),
            'status' => 0,
            'notif' => 0,
        ];

        SiswaModel::where('id', session()->get('id'))
            ->update($data);
        PendaftaranDetailModel::create($data_pendaftaran);

        return redirect('/siswa/pendaftaran')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Form Pendaftaran dikirim',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }

    public function edit_pendaftaran(PendaftaranModel $pendaftaran)
    {
        return view('siswa.pendaftaran.edit', [
            'plugins' => '
                
            ',
            'menu' => 'pendaftaran',
            'judul' => 'Edit Form Pendaftaran',
            'user' => SiswaModel::firstWhere('id', session()->get('id')),
            'sekolah' => ProfileSekolahModel::first(),
            'pendaftaran' => $pendaftaran,
            'jurusan' => JurusanModel::all()
        ]);
    }
    public function update_pendaftaran(Request $request, PendaftaranModel $pendaftaran)
    {
        $data = [
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'jurusan' => $request->jurusan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'anak_ke' => $request->anak_ke,
            'jumlah_saudara' => $request->jumlah_saudara,
            'hobi' => $request->hobi,
            'cita_cita' => $request->cita_cita,
            'hp' => $request->hp,
            'email' => $request->email,
            'jenis_tempat_tinggal' => $request->jenis_tempat_tinggal,
            'alamat' => $request->alamat,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'pos' => $request->pos,
            'jarak' => $request->jarak,
            'transportasi' => $request->transportasi,
            'no_kk' => $request->no_kk,
            'kepala_kk' => $request->kepala_kk,
            'nama_ayah' => $request->nama_ayah,
            'nik_ayah' => $request->nik_ayah,
            'tahun_lahir_ayah' => $request->tahun_lahir_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah' => $request->penghasilan_ayah,
            'pendidikan_ayah' => $request->pendidikan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'nik_ibu' => $request->nik_ibu,
            'tahun_lahir_ibu' => $request->tahun_lahir_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu' => $request->penghasilan_ibu,
            'pendidikan_ibu' => $request->pendidikan_ibu,
            'sekolah_asal' => $request->sekolah_asal,
            'jenjang_sekolah' => $request->jenjang_sekolah,
            'npsn_sekolah' => $request->npsn_sekolah,
            'foto' => $request->foto_lama,
        ];

        if ($request->file('foto')) {
            if ($request->gambar_lama) {
                if ($request->gambar_lama != 'default.png') {
                    Storage::delete('assets/files/' . $request->gambar_lama);
                }
            }
            $data['foto'] = str_replace('assets/files/', '', $request->file('foto')->store('assets/files'));
        }

        SiswaModel::where('id', session()->get('id'))
            ->update($data);

        return redirect('/siswa/pendaftaran')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Form Pendaftaran di edit',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }
    public function detail_pendaftaran(PendaftaranModel $pendaftaran)
    {
        $detail_pendaftaran = PendaftaranDetailModel::where('pendaftaran_id', $pendaftaran->id)
            ->where('siswa_id', session()->get('id'))
            ->first();
        return view('siswa.pendaftaran.detail', [
            'plugins' => '
                
            ',
            'menu' => 'pendaftaran',
            'judul' => 'Detail Form Pendaftaran',
            'user' => SiswaModel::firstWhere('id', session()->get('id')),
            'sekolah' => ProfileSekolahModel::first(),
            'pendaftaran' => $pendaftaran,
            'jurusan' => JurusanModel::all(),
            'detail_pendaftaran' => $detail_pendaftaran
        ]);
    }
    public function cetak_pendaftaran(PendaftaranModel $pendaftaran)
    {

        $detail_pendaftaran = PendaftaranDetailModel::where('pendaftaran_id', $pendaftaran->id)
            ->where('siswa_id', session()->get('id'))
            ->first();

        return view('siswa.pendaftaran.cetak-formulir', [
            'plugins' => '
                
            ',
            'menu' => 'pendaftaran',
            'judul' => 'Detail Form Pendaftaran',
            'user' => SiswaModel::firstWhere('id', session()->get('id')),
            'sekolah' => ProfileSekolahModel::first(),
            'pendaftaran' => $pendaftaran,
            'jurusan' => JurusanModel::all(),
            'detail_pendaftaran' => $detail_pendaftaran
        ]);
    }
    public function cetak_bukti(PendaftaranModel $pendaftaran)
    {


        $detail_pendaftaran = PendaftaranDetailModel::where('pendaftaran_id', $pendaftaran->id)
            ->where('siswa_id', session()->get('id'))
            ->first();

        return view('siswa.pendaftaran.cetak-bukti', [
            'plugins' => '
                
            ',
            'menu' => 'pendaftaran',
            'judul' => 'SURAT PENGUMUMAN',
            'user' => SiswaModel::firstWhere('id', session()->get('id')),
            'sekolah' => ProfileSekolahModel::first(),
            'pendaftaran' => $pendaftaran,
            'jurusan' => JurusanModel::all(),
            'detail_pendaftaran' => $detail_pendaftaran
        ]);
    }

    public function notif($id)
    {
        $data = [
            'notif' => 1
        ];

        PendaftaranDetailModel::where('id', $id)
            ->update($data);

        return redirect('/siswa/pendaftaran');
    }
}
