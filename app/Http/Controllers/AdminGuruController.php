<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranDetailModel;
use App\Models\ProfileSekolahModel;
use App\Models\SiswaModel;
use App\Models\Guru;
use App\Models\User;
use App\Models\Verificator;
use App\Models\SeksiPresensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.guru.index', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
                <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
            ',
            'menu_master' => 'false',
            'menu' => 'guru',
            'judul' => 'Data Guru',
            'sekolah' => ProfileSekolahModel::first(),
            'data_guru' => Guru::with('user')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    private function fixNoHp($nohp)
{
    $nohp = preg_replace('/[^0-9]/', '', $nohp);

    if (substr($nohp, 0, 1) === '0') {
        return '62' . substr($nohp, 1);
    } elseif (substr($nohp, 0, 2) === '62') {
        return $nohp;
    } elseif (substr($nohp, 0, 1) === '8') {
        return '62' . $nohp;
    }

    return $nohp;
}
    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $messages = [
        'nama.required'   => 'Nama wajib diisi.',
        'nip.required'    => 'NIP wajib diisi.',
        'nip.unique'      => 'NIP sudah digunakan.',
        'no_hp.required'  => 'Nomor HP wajib diisi.',
        'email.required'  => 'Email wajib diisi.',
        'email.email'     => 'Format email tidak valid.',
        'email.unique'    => 'Email sudah terdaftar.',
        'alamat.required' => 'Alamat wajib diisi.',
        'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
    ];

    $validated = $request->validate([
        'nama'          => 'required|string|max:100',
        'nip'           => 'required|string|max:30|unique:gurus,nip',
        'no_hp'         => 'required|string|max:15',
        'email'         => 'required|email|unique:gurus,email',
        'tanggal_lahir' => 'required|date',
        'alamat'        => 'required|string|max:255',
    ], $messages);
    $user = new User();
    $user->username = $validated['email']; 
   $passwordDefault = $validated['tanggal_lahir'];
    $user->password = Hash::make($passwordDefault);
    $user->role = 'guru';
    $user->save();
    $validated['user_id'] = $user->id;
    $validated['no_hp'] = $this->fixNoHp($request->no_hp);
    Guru::create($validated);

    return redirect()->back()->with('success', 'Data guru berhasil ditambahkan');
}
    /**
     * Display the specified resource.
     */
    public function show(SiswaModel $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SiswaModel $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SiswaModel $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        
        Guru::destroy($guru->id);

        return redirect('/admin/guru')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Data guru di hapus',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }

    public function verificator(){
        $verificator = Verificator::with('guru')->get();
         return view('admin.verificator.index', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
                <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
            ',
            'menu_master' => 'false',
            'menu' => 'verificator',
            'judul' => 'Data Guru',
            'guru' => Guru::all(),
            'sekolah' => ProfileSekolahModel::first(),
            'data_verificator' => $verificator
        ]);
    }

    public function store_verificator(Request $request){
        $verificator = new Verificator();
        $verificator->guru_id = $request->guru_id;
        $verificator->start_char = $request->start_char;
        $verificator->end_char = $request->end_char;
        $verificator->save();
         return redirect()->back()->with('success', 'Data verificator berhasil ditambahkan');
    }

   public function delete_verificator($id)
{
    // Cari data berdasarkan id
    $verificator = Verificator::find($id);

    if ($verificator) {
        $verificator->delete();

        return redirect('/admin/verificator')->with('pesan', "
            <script>
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Data verificator berhasil dihapus',
                    icon: 'success',
                });
            </script>
        ");
    }

    return redirect('/admin/verificator')->with('pesan', "
        <script>
            Swal.fire({
                title: 'Gagal',
                text: 'Data tidak ditemukan',
                icon: 'error',
            });
        </script>
    ");
}

 public function seksi_presensi(){
        $seksipresensi = SeksiPresensi::with('guru')->get();
         return view('admin.seksi_presensi.index', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
                <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
            ',
            'menu_master' => 'false',
            'menu' => 'seksi_presensi',
            'judul' => 'Data Seksi Presensi',
            'guru' => Guru::all(),
            'sekolah' => ProfileSekolahModel::first(),
            'data_seksi_presensi' => $seksipresensi
        ]);
    }

    public function store_seksi_presensi(Request $request){
        $seksipresensi = new SeksiPresensi();
        $seksipresensi->guru_id = $request->guru_id;

        $seksipresensi->save();
         return redirect()->back()->with('success', 'Data seksi presensi berhasil ditambahkan');
    }

   public function delete_seksi_presensi($id)
{
    // Cari data berdasarkan id
    $seksipresensi = SeksiPresensi::find($id);

    if ($seksipresensi) {
        $seksipresensi->delete();

        return redirect('/admin/seksi_presensi')->with('pesan', "
            <script>
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Data seksi presensi berhasil dihapus',
                    icon: 'success',
                });
            </script>
        ");
    }

    return redirect('/admin/seksi_presensi')->with('pesan', "
        <script>
            Swal.fire({
                title: 'Gagal',
                text: 'Data tidak ditemukan',
                icon: 'error',
            });
        </script>
    ");
}
}
