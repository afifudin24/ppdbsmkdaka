<?php

namespace App\Http\Controllers;

use App\Exports\PendaftaranExport;
use App\Models\PendaftaranDetailModel;
use App\Models\PendaftaranModel;
use App\Models\ProfileSekolahModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Http;
class AdminPendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pendaftaran.index', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
                <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
            ',
            'menu_master' => 'false',
            'menu' => 'pendaftaran',
            'judul' => 'Data Pendaftaran',
            'sekolah' => ProfileSekolahModel::first(),
            'data_pendaftaran' => PendaftaranModel::all()->sortByDesc('id')
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
        $data = [
            'tahun_angkatan' => $request->tahun_angkatan,
            'gelombang' => $request->gelombang,
            'kuota' => $request->kuota,
            'tutup' => 0
        ];

        PendaftaranModel::create($data);
        return redirect('/admin/pendaftaran')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Data disimpan',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }

    /**
     * Display the specified resource.
     */
    public function show(PendaftaranModel $pendaftaran)
    {
        return view('admin.pendaftaran.show', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
                <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
            ',
            'menu_master' => 'false',
            'menu' => 'pendaftaran',
            'judul' => 'Detail Pendaftaran',
            'sekolah' => ProfileSekolahModel::first(),
            'pendaftaran' => $pendaftaran
        ]);
    }
    public function show_siswa($id_pendaftaran, $id_siswa)
    {
      $pendaftaran_siswa = PendaftaranDetailModel::with(['siswa.guru'])
    ->where('pendaftaran_id', $id_pendaftaran)
    ->where('siswa_id', $id_siswa)
    ->first();
      

    return view('admin.pendaftaran.show-siswa', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
                <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
            ',
            'menu_master' => 'false',
            'menu' => 'pendaftaran',
            'judul' => 'Form Pendaftaran Siswa',
            'sekolah' => ProfileSekolahModel::first(),
            'pendaftaran' => PendaftaranModel::firstWhere('id', $id_pendaftaran),
            'pendaftaran_siswa' => $pendaftaran_siswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendaftaranModel $pendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PendaftaranModel $pendaftaran)
    {
        $data = [
            'tahun_angkatan' => $request->etahun_angkatan,
            'gelombang' => $request->egelombang,
            'kuota' => $request->ekuota,
            'tutup' => $request->tutup
        ];

        PendaftaranModel::where('id', $pendaftaran->id)
            ->update($data);
        return redirect('/admin/pendaftaran')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Data di edit',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }
    public function pendaftaran_status(Request $request)
    {
        $id = $request->id;
        $tutup = $request->tutup;
        $data = [
            'tutup' => $tutup,
        ];

        PendaftaranModel::where('id', $id)
            ->update($data);
    }
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


    public function lulus($status, $id_detail_pendaftaran)
    {
        $detail_pendaftaran = PendaftaranDetailModel::firstWhere('id', $id_detail_pendaftaran);
        $siswa = SiswaModel::firstWhere('id', $detail_pendaftaran->siswa_id);
        $no_registrasi = 'REG-' . str_pad($siswa->id, 5, '0', STR_PAD_LEFT);
    $siswa->no_regis = $no_registrasi;
    $dataqr = [
    'id' => $siswa->id,
    'no_registrasi' => $siswa->no_regis,
    'nik' => $siswa->nik,
    'nama' => $siswa->nama,
    'alamat' => $siswa->alamat,
    'asal_sekolah' => $siswa->sekolah_asal
];

// Simpan QR ke storage/public/qr_code/{id}.png
 // --- Simpan QR ke public/qr_code ---
  $qrFile = "qr_code/{$siswa->no_regis}.svg";
file_put_contents(public_path($qrFile), QrCode::format('svg')->size(200)->generate(json_encode($dataqr)));

$siswa->qr_code = $qrFile; // cukup simpan path

    // --- Simpan PDF ke public/suket ---
    // $pdfPath = public_path("suket/{$siswa->no_regis}.pdf");
    // $pdf = PDF::loadView('surat.suket', compact('siswa'));
    // file_put_contents($pdfPath, $pdf->output());
    // $siswa->suket = "suket/{$siswa->id}.pdf";

    $siswa->save();
    // ambil url pdf dan qr ke wa

    $qrUrl = url('/qr-code/' . $siswa->no_regis);
    $pdfUrl = url('/cetak_surat_keterangan/' . $siswa->no_regis );
   $pesan = "Selamat, anda dinyatakan *DITERIMA* dan telah diverifikasi.\n\n"
       . "📌 Silakan cek QR Code di: $qrUrl\n"
       . "📄 Cetak Surat Keterangan di: $pdfUrl";

    // Kirim ke wa disini
       Http::get(config('services.wa.url'), [
    'api_key' => config('services.wa.api_key'),
    'sender'  => config('services.wa.sender'),
    'number'  => $this->fixNoHp($siswa->hp),
    'message' => $pesan,
    'footer'  => 'SPMB SMK Darussalam Karangpucung'
]);

     

        $data = [
            'status' => $status,
        ];

        PendaftaranDetailModel::where('id', $id_detail_pendaftaran)
            ->update($data);

        return redirect('/admin/pendaftaran' . '/' . $detail_pendaftaran->pendaftaran_id)->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Status di ubah',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }

   public function pdf_pendaftaran($id, $status)
{
    $pendaftaran = PendaftaranModel::firstWhere('id', $id);

    $detail_pendaftaran = PendaftaranDetailModel::where('pendaftaran_id', $id)
        ->when($status !== '*', function ($query) use ($status) {
            return $query->where('status', $status);
        })
        ->get();

    $pdf = Pdf::loadView('admin.pendaftaran.pdf-pendaftaran', [
        'pendaftaran' => $pendaftaran,
        'sekolah' => ProfileSekolahModel::first(),
        'detail_pendaftaran' => $detail_pendaftaran
    ])->setPaper('A4', 'portrait'); // bisa 'landscape' juga

    return $pdf->stream('pendaftaran-'.$pendaftaran->tahun_angkatan.'.pdf');
    // kalau mau langsung download:
    // return $pdf->download('pendaftaran-'.$pendaftaran->tahun_angkatan.'.pdf');
}
    public function pendaftaran_excel($id, $status)
    {
        $pendaftaran = PendaftaranModel::firstWhere('id', $id);
        $sekolah = ProfileSekolahModel::first();

        $detail_pendaftaran = PendaftaranDetailModel::where('pendaftaran_id', $id)
            ->where('status', $status)
            ->get();

        if ($status == '*') {
            $detail_pendaftaran = PendaftaranDetailModel::where('pendaftaran_id', $id)
                ->get();
        }

        return Excel::download(new PendaftaranExport($detail_pendaftaran, $sekolah), "data-pendaftaran.xlsx");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendaftaranModel $pendaftaran)
    {
        PendaftaranDetailModel::where('pendaftaran_id', $pendaftaran)
            ->delete();
        PendaftaranModel::destroy($pendaftaran->id);

        return redirect('/admin/pendaftaran')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Pendaftaran di hapus',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }
}
