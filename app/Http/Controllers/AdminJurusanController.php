<?php

namespace App\Http\Controllers;

use App\Models\JurusanModel;
use App\Models\ProfileSekolahModel;
use Illuminate\Http\Request;

class AdminJurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.jurusan.index', [
            'plugins' => '
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
                <script src="' . url('/assets/template') . '/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
                <link rel="stylesheet" href="' . url('/assets/template') . '/dist/assets/libs/prismjs/themes/prism-okaidia.min.css">
                <script src="' . url('/assets/template') . '/dist/assets/libs/prismjs/prism.js"></script>
            ',
            'menu_master' => 'false',
            'menu' => 'jurusan',
            'judul' => 'Data Jurusan',
            'sekolah' => ProfileSekolahModel::first(),
            'data_jurusan' => JurusanModel::all()
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
            'nama' => $request->nama
        ];

        JurusanModel::create($data);
        return redirect('/admin/jurusan')->with('pesan', "
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
    public function show(JurusanModel $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JurusanModel $jurusan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JurusanModel $jurusan)
    {
        $data = [
            'nama' => $request->enama
        ];

        JurusanModel::where('id', $jurusan->id)
            ->update($data);

        return redirect('/admin/jurusan')->with('pesan', "
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
    public function destroy(JurusanModel $jurusan)
    {
        JurusanModel::destroy($jurusan->id);

        return redirect('/admin/jurusan')->with('pesan', "
            <script>
                Swal.fire(
                    {
                        title: 'Berhasil',
                        text: 'Data di hapus',
                        icon: 'success',
                    }
                );
            </script>
        ");
    }
}
