<?php

namespace App\Http\Controllers;

use App\Models\AgendaKehadiran;
use App\Http\Requests\StoreAgendaKehadiranRequest;
use App\Http\Requests\UpdateAgendaKehadiranRequest;

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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreAgendaKehadiranRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AgendaKehadiran $agendaKehadiran)
    {
        //
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
    public function update(UpdateAgendaKehadiranRequest $request, AgendaKehadiran $agendaKehadiran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AgendaKehadiran $agendaKehadiran)
    {
        //
    }
}
