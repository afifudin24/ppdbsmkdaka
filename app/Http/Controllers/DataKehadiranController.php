<?php

namespace App\Http\Controllers;
use App\Exports\DataKehadiranExport;
use App\Models\DataKehadiran;
use App\Models\AgendaKehadiran;
use App\Http\Requests\StoreDataKehadiranRequest;
use App\Http\Requests\UpdateDataKehadiranRequest;
use Maatwebsite\Excel\Facades\Excel;
class DataKehadiranController extends Controller
{
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
    public function store(StoreDataKehadiranRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DataKehadiran $dataKehadiran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataKehadiran $dataKehadiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDataKehadiranRequest $request, DataKehadiran $dataKehadiran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataKehadiran $dataKehadiran)
    {
        //
    }
    public function cetakdatakehadiran($id){
        
         $datakehadiran = DataKehadiran::with(['siswa.pendaftaran', 'siswa.guru'])
    ->where('agenda_id', $id)
    ->get();
    // dd($datakehadiran);
    $agenda = AgendaKehadiran::where('id', $id)->first();
        // $sekolah = ProfileSekolahModel::first();


        return Excel::download(new DataKehadiranExport($datakehadiran, $agenda), $agenda->nama_agenda . "-".  date('Y-m-d'). "data-kehadiran.xlsx");
    
    }
}
