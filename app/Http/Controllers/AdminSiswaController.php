<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranDetailModel;
use App\Models\ProfileSekolahModel;
use App\Models\SiswaModel;
use App\Models\JurusanModel;
use Illuminate\Http\Request;

class AdminSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index(Request $request)
{
    // Ambil nilai filter dari request (misal ?status=1)
    $status = $request->input('status');

    // Query dasar dengan relasi pendaftaran
   $query = SiswaModel::with([
    'pendaftaran',
    'datakehadiran.agenda'
   ]);

    // Jika ada filter status, tambahkan kondisi
    if ($status !== null && $status !== '') {
        $query->whereHas('pendaftaran', function ($q) use ($status) {
            $q->where('status', $status);
        });
    }

    $data_siswa = $query->get();
//   dd($data_siswa);

    return view('admin.siswa.index', [
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
        'status_selected' => $status, // dikirim agar option tetap terpilih
        'jurusan' => JurusanModel::all()
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
    public function store(Request $request)
    {
        //
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
    // Validasi input
    $request->validate([
        'jurusan' => 'required|string|max:100',
    ]);

    // Update kolom jurusan
    $siswa->update([
        'jurusan' => $request->jurusan,
    ]);

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Data siswa diperbarui',
                        icon: 'success',
                    }
                );
            </script>
        ");
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SiswaModel $siswa)
    {
        PendaftaranDetailModel::where('siswa_id', $siswa->id)
            ->delete();
        SiswaModel::destroy($siswa->id);

        return redirect('/admin/siswa')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Data siswa di hapus',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }
}
