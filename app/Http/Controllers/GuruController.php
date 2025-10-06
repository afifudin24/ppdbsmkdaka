<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use App\Models\PendaftaranDetailModel;
use App\Models\PendaftaranModel;
use App\Models\JurusanModel;
use App\Models\AgendaKehadiran;
use App\Models\ProfileSekolahModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(session()->get('user'));
        $user = session()->get('user');
        $total_lulus = PendaftaranDetailModel::where('status', 1)
    ->whereHas('siswa', function ($q) use ($user) {
        $q->where('referral_id', $user->id);
    })
    ->count();

$total_tidak_lulus = PendaftaranDetailModel::where('status', 2)
    ->whereHas('siswa', function ($q) use ($user) {
        $q->where('referral_id', $user->id);
    })
    ->count();
        $siswabawaan = SiswaModel::where('referral_id', $user->id)->count();
        return view('guru.index', [
            'plugins' => '',
            'menu_master' => 'false',
            'menu' => 'dashboard',
            'judul' => 'Dashboard',
            'sekolah' => ProfileSekolahModel::first(),
            'data_siswa' => $siswabawaan,
            'data_pendaftaran' => PendaftaranModel::all(),
            'total_lulus' => $total_lulus,
            'total_tidak_lulus' => $total_tidak_lulus,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuruRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuruRequest $request, Guru $guru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        //
    }

    public function siswa(Request $request){
          // Ambil nilai filter dari request (misal ?status=1)
    $status = $request->input('status');
    $user = session()->get('user');
  
    

    // Query dasar dengan relasi pendaftaran
    $query = SiswaModel::with('pendaftaran')->where('referral_id', $user->id);

    // Jika ada filter status, tambahkan kondisi
    if ($status !== null && $status !== '') {
        $query->whereHas('pendaftaran', function ($q) use ($status) {
            $q->where('status', $status);
        });
    }

    $data_siswa = $query->get();

    return view('guru.siswa.index', [
        'plugins' => '
            <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
            <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
            <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
        ',
        'menu_master' => 'false',
        'menu' => 'siswa',
        'judul' => 'Data Siswa',
        'sekolah' => ProfileSekolahModel::first(),
        'data_siswa' => $data_siswa,
        'status_selected' => $status // dikirim agar option tetap terpilih
    ]);
    }

    public function daftarkan_siswa(PendaftaranModel $pendaftaran){
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
        return view('guru.siswa.create', [
            'plugins' => '
                
            ',
            'menu' => 'pendaftaran',
            'judul' => 'Input Pendaftaran',
            'sekolah' => ProfileSekolahModel::first(),
            'pendaftaran' => $pendaftaran,
            'jurusan' => JurusanModel::all()
        ]);
    }

    public function daftarkan_siswa_store(Request $request){
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
    $loginverif = url("/auth/guru");
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
}

    public function agenda_kehadiran(){
        $data_agenda = AgendaKehadiran::all();
      
         return view('guru.agenda_kehadiran.index', [
             'plugins' => '
            <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
            <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
            <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
        ',
            'menu_master' => 'false',
            'menu' => 'kehadiran siswa',
            'judul' => 'Kehadiran Siswa',
            'sekolah' => ProfileSekolahModel::first(),
            'data_agenda' => $data_agenda,
           
        ]);
    }

    public function verificator_siswa(Request $request){
        $user = session()->get('user');
       $guru = Guru::with(['user', 'verificator', 'seksipresensi'])
            ->where('id', $user->id)
            ->first();
            // dd($guru);
         if ($guru->verificator == null) {
    return abort(403, 'Akses ditolak');
}

  // Ambil nilai filter dari request (misal ?status=1)
    $status = $request->input('status');

    // Query dasar dengan relasi pendaftaran
    $query = SiswaModel::with('pendaftaran');

    // Jika ada filter status, tambahkan kondisi
    if ($status !== null && $status !== '') {
        $query->whereHas('pendaftaran', function ($q) use ($status) {
            $q->where('status', $status);
        });
    }

    $data_siswa = $query->get();

    return view('guru.verificator.siswa.index', [
        'plugins' => '
            <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
            <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
            <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
        ',
        'menu_master' => 'false',
        'menu' => 'siswa pendaftar',
        'judul' => 'Data Siswa',
        'sekolah' => ProfileSekolahModel::first(),
        'data_siswa' => $data_siswa,
        'status_selected' => $status // dikirim agar option tetap terpilih
    ]);

    }
}
