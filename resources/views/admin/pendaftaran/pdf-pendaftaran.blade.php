<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Pendaftaran</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
        }
        .header img {
            width: 100px;
            float: left;
        }
        .header h3 {
            padding-left: 120px;
            margin: 0;
        }
        .header p {
            padding-left: 120px;
            margin-top: -5px;
            font-weight: bold;
            font-size: 11px;
        }
        hr {
            border: 2px solid #000;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            border: 1px solid #000;
            padding: 5px;
        }
        .tableheader th, .tableheader td{
            border : none;
        }
        table th {
            background: #f2f2f2;
        }
        .ttd {
            margin-top: 40px;
            width: 250px;
            float: right;
            text-align: left;
        }
        .ttd img {
            width: 100px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
<table width="100%" class="tableheader" style="border-collapse: collapse; margin-bottom: 10px; border : none !important">
    <tr border='none'>
        <td width="100" style="text-align: center;">
            <img src="{{ public_path('assets/files/'.$sekolah->favicon) }}" alt="Logo Sekolah" style="width: 100px;">
        </td>
        <td style="text-align: center;">
            <h3 style="margin: 0; font-size: 16px;">
                PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)
            </h3>
            <h2 style="margin: 0; font-size: 18px; text-transform: uppercase;">
                {{ $sekolah->nama }}
            </h2>
            <h4 style="margin: 0; font-size: 14px;">
                TAHUN ANGKATAN {{ $pendaftaran->tahun_angkatan }}
            </h4>
            <p style="margin: 5px 0 0 0; font-size: 11px;">
                Kantor : {{ $sekolah->alamat }} ({{ $sekolah->telpon }})<br>
                Website : {{ $sekolah->website }} | Email : {{ $sekolah->email }}
            </p>
        </td>
    </tr>
</table>
<hr style="border: 2px solid #000; margin-top: -5px; margin-bottom: 15px;">

    

    <h4 style="text-align: center; text-decoration: underline; margin-bottom: 5px;">
        DATA PENDAFTARAN
    </h4>
    <p>Berikut merupakan data status pendaftaran calon siswa:</p>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;">NO</th>
                <th>NAMA</th>
                <th>JURUSAN DIPILIH</th>
                <th>SEKOLAH ASAL</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail_pendaftaran as $dp)
                <tr style="text-align: center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dp->siswa->nama }}</td>
                    <td>{{ $dp->siswa->jurusan }}</td>
                    <td>{{ $dp->siswa->sekolah_asal }}</td>
                    <td>
                        @if ($dp->status == 0)
                            Sedang diverifikasi
                        @elseif ($dp->status == 1)
                            LULUS
                        @else
                            TIDAK LULUS
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd">
        <p>Karangpucung, {{ date('d M Y') }}</p>
        <p>Ketua Panitia SMPB</p>
        <img src="{{ public_path('assets/files/'.$sekolah->ttd_panitia) }}" alt="TTD Panitia">
        <p style="text-decoration: underline; margin: 0;">{{ $sekolah->panitia }}</p>
        <p style="margin: 0;">NIP : {{ $sekolah->nip_panitia }}</p>
    </div>
</body>
</html>
