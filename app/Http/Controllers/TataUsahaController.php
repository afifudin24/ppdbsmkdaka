<?php

namespace App\Http\Controllers;

use App\Models\TataUsaha;
use App\Models\Guru;
use App\Models\ProfileSekolahModel;
use App\Models\Atribut;
use App\Models\DaftarUlang;
use App\Models\SiswaModel;
use App\Http\Requests\StoreTataUsahaRequest;
use App\Http\Requests\UpdateTataUsahaRequest;
// gunakan request
use Illuminate\Http\Request;

class TataUsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $tatausaha = TataUsaha::with('guru')->get();
         return view('admin.tatausaha.index', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
                <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
            ',
            'menu_master' => 'false',
            'menu' => 'tata usaha',
            'judul' => 'Data Tata Usaha',
            'guru' => Guru::all(),
            'sekolah' => ProfileSekolahModel::first(),
            'data_tata_usaha' => $tatausaha
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
         $tatausaha = new TataUsaha();
        $tatausaha->guru_id = $request->guru_id;

        $hasil = $tatausaha->save();
    
         return redirect()->back()->with('success', 'Data seksi presensi berhasil ditambahkan');
    }

 public function data_siswa(Request $request)
{
    $query = SiswaModel::with([
        'guru',
        'pendaftaran',
        'datakehadiran',
        'atribut',
        'daftarulang'
    ]);

    // Filter berdasarkan request
    if ($request->has('filter') && $request->filter != '') {
        switch ($request->filter) {
            case 'atribut':
                // Sudah ambil atribut
                $query->whereHas('atribut');
                break;

            case 'lunas':
                // Sudah bayar lunas
                $query->whereHas('daftarulang', function ($q) {
                    $q->where('status', 'lunas');
                });
                break;

            case 'cicil':
                // Masih cicil (tidak ada data lunas, tapi ada data cicil)
                $query->whereHas('daftarulang', function ($q) {
                    $q->where('status', 'cicil');
                })
                ->whereDoesntHave('daftarulang', function ($q) {
                    $q->where('status', 'lunas');
                });
                break;

            case 'belum':
                // Belum bayar sama sekali (tidak punya daftarulang)
                $query->whereDoesntHave('daftarulang');
                break;
        }
    }

    $datasiswa = $query->get();
    
    return view('admin.tatausaha.data_siswa', [
        'plugins' => '
            <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
            <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
            <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
        ',
        'menu_master' => 'false',
        'menu' => 'data siswa tu',
        'judul' => 'Data Siswa',
        'guru' => Guru::all(),
        'sekolah' => ProfileSekolahModel::first(),
        'data_siswa' => $datasiswa
    ]);
}

    /**
     * Display the specified resource.
     */
    public function show(TataUsaha $tataUsaha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TataUsaha $tataUsaha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTataUsahaRequest $request, TataUsaha $tataUsaha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tatausaha = TataUsaha::find($id);
        $tatausaha->delete();

        return redirect()->back()->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Data Tata Usaha Dihapus',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }
 public function ceklistAtribut(Request $request, $id)
{
    // Cek apakah siswa sudah punya data atribut
    $cek = Atribut::where('siswa_id', $id)->first();

    if ($cek) {
        // Jika sudah ada → hapus
        $cek->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Atribut diceklist dibatalkan (data dihapus)'
        ]);
    } else {
        // Jika belum ada → tambahkan data baru
        Atribut::create([
            'siswa_id' => $id,
            'tanggal' => now(), // opsional, isi jika kamu punya kolom tanggal
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Atribut sudah diceklist (data ditambahkan)'
        ]);
    }
}

public function daftarulang(Request $request){
        // Validasi input
        $validated = $request->validate([
            'id' => 'required|exists:siswa,id',
            'jumlah' => 'required|numeric|min:1000',
            'status' => 'required|in:lunas,cicil',
            'keterangan' => 'required|string|max:255',
        ], [
            'id.required' => 'Data siswa tidak ditemukan.',
            'id.exists' => 'Siswa yang dipilih tidak valid.',
            'jumlah.required' => 'Nominal harus diisi.',
            'jumlah.numeric' => 'Nominal harus berupa angka.',
            'jumlah.min' => 'Nominal minimal Rp1.000.',
            'status.required' => 'Status pembayaran harus dipilih.',
            'status.in' => 'Status pembayaran tidak valid.',
            'keterangan.required' => 'Keterangan harus diisi.',
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
        ]);

        // Simpan data ke database
        DaftarUlang::create([
            'siswa_id' => $validated['id'],
            'jumlah' => $validated['jumlah'],
            'status' => $validated['status'],
            'tanggal' => now(),
            'keterangan' => $validated['keterangan'],
        ]);

       return redirect()->back()->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Daftar Ulang Berhasil',
                        icon: 'success',
                    }
                );
            </script>
        ");
}

}
