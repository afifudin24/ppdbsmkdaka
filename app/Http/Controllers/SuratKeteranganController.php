<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiswaModel;
use App\Models\ProfileSekolahModel;
use App\Models\PendaftaranModel;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratKeteranganController extends Controller
{
public function index($noregis)
{
    $siswa = SiswaModel::firstWhere('no_regis', $noregis);
    $sekolah = ProfileSekolahModel::first();
    $pendaftaran = PendaftaranModel::firstWhere('tutup', 0);
    $pdf = PDF::loadView('surat.suket', compact('siswa', 'sekolah', 'pendaftaran'));

    $filename = 'SPMB-SUKET-' . $siswa->nama . '-' . $siswa->no_regis . '.pdf';

    return $pdf->stream($filename);
}
}
