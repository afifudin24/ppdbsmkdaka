<?php

namespace App\Http\Controllers;

use App\Models\JurusanModel;
use App\Models\PendaftaranDetailModel;
use App\Models\PendaftaranModel;
use App\Models\ProfileSekolahModel;
use App\Models\Verificator;
use App\Models\SiswaModel;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;
class SiswaController extends Controller
{
    public function index()
    {
        // dd(session()->get('user')->id);
        $notifikasi = PendaftaranDetailModel::where('siswa_id',session()->get('user')->id)
            ->where('notif', 0)
            ->get();

        $cek_lulus =  PendaftaranDetailModel::where('siswa_id', session()->get('user')->id)
            ->where('status', 1)
            ->first();

        $status_lulus = PendaftaranDetailModel::with('siswa')->where('siswa_id', session()->get('user')->id)->first();

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
            'status_lulus' => $status_lulus,
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
    public function store_pendaftaran(Request $request)
    {
        $pendaftaran = PendaftaranModel::where('tutup', 0)->first();

        function fixNoHp($nohp)
{
    // Hilangkan semua karakter non-angka
    $nohp = preg_replace('/[^0-9]/', '', $nohp);

    // Jika diawali "0", ganti dengan "62"
    if (substr($nohp, 0, 1) === '0') {
        $nohp = '62' . substr($nohp, 1);
    }

    // Jika diawali "62", biarkan
    elseif (substr($nohp, 0, 2) === '62') {
        $nohp = $nohp;
    }

    // Jika diawali "8" langsung, tambahkan "62"
    elseif (substr($nohp, 0, 1) === '8') {
        $nohp = '62' . $nohp;
    }

    return $nohp;
}

    $request->validate([
        'nama'          => 'required|string|max:100',
        'nik'           => 'required|digits:16|numeric|unique:siswa,nik',
        'referral_id'   => 'nullable|string|max:50',
        'jurusan'       => 'required|string',
        'jenis_kelamin' => 'required|in:L,P',
        'tempat_lahir'  => 'required|string|max:100',
        'tgl_lahir'     => 'required|date',
        'hp' => 'required|numeric|digits_between:10,15',
        'alamat'        => 'required|string|max:255',
        'desa'          => 'required|string|max:100',
        'kecamatan'     => 'required|string|max:100',
        'kabupaten'     => 'required|string|max:100',
        'provinsi'      => 'required|string|max:100',
        'no_kk'         => 'required|digits:16|numeric',
        'nama_ayah'     => 'required|string|max:100',
        'nama_ibu'      => 'required|string|max:100',
        'sekolah_asal'  => 'required|string|max:150',
      
    'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    'kk'            => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
    'akta'          => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
    'kip'           => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
    ], [
        'nama.required'          => 'Nama wajib diisi.',
        'nik.required'           => 'NIK wajib diisi.',
        'nik.digits'             => 'NIK harus terdiri dari 16 digit angka.',
        'nik.numeric'            => 'NIK hanya boleh berisi angka.',
        'nik.unique'             => 'NIK sudah terdaftar.',
        'jurusan.required'       => 'Jurusan wajib dipilih.',
        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        'jenis_kelamin.in'       => 'Jenis kelamin hanya boleh L atau P.',
        'tempat_lahir.required'  => 'Tempat lahir wajib diisi.',
        'tgl_lahir.required'     => 'Tanggal lahir wajib diisi.',
        'tgl_lahir.date'         => 'Format tanggal lahir tidak valid.',
        'hp.required'            => 'Nomor HP wajib diisi.',
        'hp.regex'               => 'Format nomor HP tidak valid.',
        'alamat.required'        => 'Alamat wajib diisi.',
        'desa.required'          => 'Nama desa wajib diisi.',
        'kecamatan.required'     => 'Nama kecamatan wajib diisi.',
        'kabupaten.required'     => 'Nama kabupaten wajib diisi.',
        'provinsi.required'      => 'Nama provinsi wajib diisi.',
        'no_kk.required'         => 'Nomor KK wajib diisi.',
        'no_kk.digits'           => 'Nomor KK harus terdiri dari 16 digit angka.',
        'no_kk.numeric'          => 'Nomor KK hanya boleh berisi angka.',
        'nama_ayah.required'     => 'Nama ayah wajib diisi.',
        'nama_ibu.required'      => 'Nama ibu wajib diisi.',
        'sekolah_asal.required'  => 'Sekolah asal wajib diisi.',
       'kk.required'   => 'Kartu Keluarga (KK) wajib diupload.',
    'kk.mimes'      => 'KK harus berupa file gambar (jpg, jpeg, png) atau PDF.',
    'kk.max'        => 'Ukuran file KK maksimal 2 MB.',

    'akta.required' => 'Akta Kelahiran wajib diupload.',
    'akta.mimes'    => 'Akta harus berupa file gambar (jpg, jpeg, png) atau PDF.',
    'akta.max'      => 'Ukuran file Akta maksimal 2 MB.',

    'kip.mimes'     => 'KIP harus berupa file gambar (jpg, jpeg, png) atau PDF.',
    'kip.max'       => 'Ukuran file KIP maksimal 2 MB.',

    'foto.image'    => 'File foto harus berupa gambar.',
    'foto.mimes'    => 'Foto hanya boleh berformat jpg, jpeg, atau png.',
    'foto.max'      => 'Ukuran foto maksimal 2 MB.',
    ]);


    $loginUrl = url("/auth/siswa");

    // Pesan WA template
    $pesan = "Halo {$request->nama},\n\n".
             "Terima kasih sudah mendaftar di SMK Darussalam Karangpucung!\n".
             "Klik link berikut untuk login ke akun kamu:\n".
             "{$loginUrl}\n\n".
             "Username : {$request->nik} \n" .
             "Passsword : {$request->tgl_lahir} \n" .
             "Jika kamu tidak merasa mendaftar, abaikan pesan ini.";

$hurufAwal = strtoupper(substr($request->nama, 0, 1));
$verificator = Verificator::with('guru')->where('start_char', '<=', $hurufAwal)
                          ->where('end_char', '>=', $hurufAwal)
                          ->first();

if ($verificator) {
    $loginverif = url("/guru/verificator/verifikasi");
    $nohpverif = $verificator->guru->no_hp;
    $pesan_ke_verificator = "Halo {$verificator->guru->nama},\n\n".
             "Ada calon siswa yang perlu diverifikasi!\n".
             "Nama : {$request->nama}\n".
             "NIK : {$request->nik}\n".
             "Cepat login dan cek segera\n".
             "{$loginverif}\n\n";
              Http::get(config('services.wa.url'), [
    'api_key' => config('services.wa.api_key'),
    'sender'  => config('services.wa.sender'),
    'number'  => fixNoHp($nohpverif),
    'message' => $pesan_ke_verificator,
    'footer'  => 'SPMB SMK Darussalam Karangpucung'
]);

}

// pesan ke siswa
  Http::get(config('services.wa.url'), [
    'api_key' => config('services.wa.api_key'),
    'sender'  => config('services.wa.sender'),
    'number'  => fixNoHp($request->hp),
    'message' => $pesan,
    'footer'  => 'SPMB SMK Darussalam Karangpucung'
]);


          $usersiswa = new User();
        $usersiswa->username = $request->nik;
        $usersiswa->password = Hash::make($request->tgl_lahir);
        $usersiswa->role = 'siswa';
        $usersiswa->save();

    $data = [
        'nama'          => $request->nama,
        'user_id'       => $usersiswa->id,
        'nik'           => $request->nik,
        'referral_id'   => $request->referral_id,
        'jurusan'       => $request->jurusan,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tempat_lahir'  => $request->tempat_lahir,
        'tgl_lahir'     => $request->tgl_lahir,
        'hp'            => fixNoHp($request->hp),
        'alamat'        => $request->alamat,
        'desa'          => $request->desa,
        'kecamatan'     => $request->kecamatan,
        'kabupaten'     => $request->kabupaten,
        'provinsi'      => $request->provinsi, 
        'no_kk'         => $request->no_kk,
        'nama_ayah'     => $request->nama_ayah,
        'nama_ibu'      => $request->nama_ibu,
        'sekolah_asal'  => $request->sekolah_asal,   
        // 'foto'          => $request->foto,
        // 'kk'            => $request->kk,
        // 'akta'          => $request->akta,
        // 'kip'           => $request->kip
    ];

    
    

    // === Upload file ===
    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('foto', 'public');
        $data['foto'] = basename($path);
    }

    if ($request->hasFile('kk')) {
        $path = $request->file('kk')->store('kk', 'public');
        $data['kk'] = basename($path);
    }

    if ($request->hasFile('akta')) {
        $path = $request->file('akta')->store('akta', 'public');
        $data['akta'] = basename($path);
    }

    if ($request->hasFile('kip')) {
        $path = $request->file('kip')->store('kip', 'public');
        $data['kip'] = basename($path);
    }

    // === Simpan ke database ===
    $siswa = SiswaModel::create($data);

        $data_pendaftaran = [
            'pendaftaran_id' => $pendaftaran->id,
            'siswa_id' => $siswa->id,
            'status' => 0,
            'notif' => 0,
        ];

       
        PendaftaranDetailModel::create($data_pendaftaran);

      return redirect('/auth/siswa')->with('success', 'Pendaftaran Berhasil! Silahkan Login');

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

        if ($request->hasFile('kk')) {
    $data['kk'] = $request->file('kk')->store('kk', 'public');
}

if ($request->hasFile('akta')) {
    $data['akta'] = $request->file('akta')->store('akta', 'public');
}

if ($request->hasFile('kip')) {
    $data['kip'] = $request->file('kip')->store('kip', 'public');
}

        SiswaModel::where('id', session()->get('id'))
            ->update($data);

        return redirect('/inputdaftar')->with('pesan', "
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

    public function ekspor(){
    
         $role = session()->get('role');
         $user = session()->get('user');
         if($role != 'admin'){
               $guru = Guru::with(['user', 'verificator', 'seksipresensi'])
            ->where('id', $user->id)
            ->first();
            // dd($guru);
         if ($guru->verificator == null) {
    return abort(403, 'Akses ditolak');
}
         }
         $datasiswa = SiswaModel::with([
            'guru',
            'pendaftaran',
            'datakehadiran.agenda'
         ])->get();
    


        return Excel::download(new SiswaExport($datasiswa), "Data-Siswa" . "-".  date('Y-m-d'). ".xlsx");
    }
    
    public function admin_ekspor(){
      
         $role = session()->get('role');
         $user = session()->get('user');
         if($role != 'admin'){
               $guru = Guru::with(['user', 'verificator', 'seksipresensi'])
            ->where('id', $user->id)
            ->first();
            // dd($guru);
         if ($guru->verificator == null) {
    return abort(403, 'Akses ditolak');
}
         }
         $datasiswa = SiswaModel::with([
            'guru',
            'pendaftaran',
            'datakehadiran.agenda'
         ])->get();
    


        return Excel::download(new SiswaExport($datasiswa), "Data-Siswa" . "-".  date('Y-m-d'). ".xlsx");
    }
}
