<?php

namespace App\Http\Controllers;

use App\Models\AgendaKehadiran;
use App\Models\DataKehadiran;
use App\Http\Requests\StoreAgendaKehadiranRequest;
use App\Http\Requests\UpdateAgendaKehadiranRequest;
use App\Models\ProfileSekolahModel;
use Illuminate\Http\Request;
class AgendaKehadiranController extends Controller
{
    public function agenda_kehadiran(){
        $agendakehadiran = AgendaKehadiran::paginate(10);
         return view('guru.seksipresensi.agendakehadiran.index', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
                <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
            ',
            'menu_master' => 'false',
            'menu' => 'agenda kehadiran',
            'judul' => 'Agenda Kehadiran',
            'sekolah' => ProfileSekolahModel::first(),
            'agendakehadiran' => $agendakehadiran
        ]);
    }

    public function presensi(){
        $agendakehadiran = AgendaKehadiran::where('tanggal', date('Y-m-d'))->first();
        return view('guru.seksipresensi.presensi.index', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
                <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
            ',
            'menu_master' => 'false',
            'menu' => 'presensi kehadiran',
            'judul' => 'Presensi',
            'sekolah' => ProfileSekolahModel::first(),
            'agendakehadiran' => $agendakehadiran
        ]);
    }
 public function simpanpresensi(Request $request)
{
    // 🔹 Validasi input
    $validated = $request->validate([
        'agenda_id' => 'required|exists:agenda_kehadiran,id',
        'siswa_id' => 'required|exists:siswa,id',
   
    ]);

    // 🔹 Cek apakah siswa sudah presensi pada agenda ini
    $cekPresensi = DataKehadiran::where('agenda_id', $request->agenda_id)
        ->where('siswa_id', $request->siswa_id)
        ->first();

    if ($cekPresensi) {
        return response()->json([
            'status' => false,
            'message' => 'Siswa sudah melakukan presensi untuk agenda ini.'
        ], 400);
    }

    // 🔹 Simpan presensi baru
    $presensi = new DataKehadiran();
    $presensi->agenda_id = $request->agenda_id;
    $presensi->siswa_id = $request->siswa_id;
    $presensi->status_kehadiran = 'Hadir';
    $presensi->save();

    // 🔹 Response sukses
    return response()->json([
        'status' => true,
        'message' => 'Presensi berhasil disimpan.'
    ]);
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $agendakehadiran = AgendaKehadiran::paginate(10);
         return view('admin.agenda_kehadiran.index', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
                <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
            ',
            'menu_master' => 'false',
            'menu' => 'agenda kehadiran',
            'judul' => 'Agenda Kehadiran',
            'sekolah' => ProfileSekolahModel::first(),
            'agendakehadiran' => $agendakehadiran
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
        $role = session()->get('role');
        if($role != 'admin'){
            // berikan eror 403 tidak memiliki akses
              return abort(403, 'Akses ditolak');
        }
        // 🔹 Validasi input
        $validated = $request->validate([
            'nama_agenda' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ], [
            'nama_agenda.required' => 'Nama agenda kehadiran wajib diisi.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
        ]);

        try {
            // 🔹 Simpan data ke database
            AgendaKehadiran::create([
                'nama_agenda' => $request->nama_agenda,
                'tanggal' => $request->tanggal,
            ]);

            // 🔹 Redirect dengan pesan sukses
            // return redirect()->back()->with('success', 'Agenda kehadiran berhasil ditambahkan.');
              return redirect('/admin/agendakehadiran')->with('pesan', "
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
        } catch (\Exception $e) {
            // 🔹 Jika terjadi error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $role = session()->get('role');
     $datakehadiran = DataKehadiran::with(['siswa.pendaftaran'])
    ->where('agenda_id', $id)
    ->get();
    $agenda = AgendaKehadiran::where('id', $id)->first();
        if($role == 'admin'){

      
        return view('admin.agenda_kehadiran.show', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
                <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
            ',
            'menu_master' => 'false',
            'menu' => 'agenda kehadiran',
            'judul' => 'Agenda Kehadiran',
            'sekolah' => ProfileSekolahModel::first(),
            'datakehadiran' => $datakehadiran,
            'agenda' => $agenda
        ]);
          }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AgendaKehadiran $agendaKehadiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AgendaKehadiran $agendakehadiran)
    {
        $data = [
            'nama_agenda' => $request->nama_agenda,
            'tanggal' => $request->tanggal
        ];

        AgendaKehadiran::where('id', $agendakehadiran->id)
            ->update($data);

        return redirect('/admin/agendakehadiran')->with('pesan', "
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

    /**
     * Remove the specified resource from storage.
     */
 public function destroy($id)
{
    $agendaKehadiran = AgendaKehadiran::find($id);

    if (!$agendaKehadiran) {
        return redirect('/admin/agendakehadiran')->with('pesan', "
            <script>
                Swal.fire({
                    title: 'Gagal',
                    text: 'Data tidak ditemukan',
                    icon: 'error',
                });
            </script>
        ");
    }

    // Hapus data dan cek apakah berhasil
    $deleted = $agendaKehadiran->delete();

    if ($deleted) {
        return redirect('/admin/agendakehadiran')->with('pesan', "
            <script>
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Data berhasil dihapus',
                    icon: 'success',
                });
            </script>
        ");
    } else {
        return redirect('/admin/agendakehadiran')->with('pesan', "
            <script>
                Swal.fire({
                    title: 'Gagal',
                    text: 'Data gagal dihapus',
                    icon: 'error',
                });
            </script>
        ");
    }
}
}
