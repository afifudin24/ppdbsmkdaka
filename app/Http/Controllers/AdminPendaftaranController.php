<?php

namespace App\Http\Controllers;

use App\Exports\PendaftaranExport;
use App\Models\PendaftaranDetailModel;
use App\Models\PendaftaranModel;
use App\Models\ProfileSekolahModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


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

    public function lulus($status, $id_detail_pendaftaran)
    {
        $detail_pendaftaran = PendaftaranDetailModel::firstWhere('id', $id_detail_pendaftaran);

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
