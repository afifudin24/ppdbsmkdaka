<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pendaftaran</title>
    <link rel="stylesheet" href="{{ url('assets/template') }}/dist/assets/fonts/font-awesome/css/fontawesome-all.css" />
    <style>
        *{
            font-family: arial;
        }
        .f-12{
            font-size: 15px;
        }
        .cop-surat-gambar{
            width: 100px;
            float: left;
        }
    </style>
</head>
<body>
    <img src="{{ url('/assets/files') }}/{{ $sekolah->foto }}" class="cop-surat-gambar" alt="Cop Gambar">
    <h3 style="padding-left: 110px;">
        PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)
        <br>
        {{ $sekolah->nama }}
        <br>
        TAHUN ANGKATAN {{ $pendaftaran->tahun_angkatan }}
    </h3>
    <p class="f-12" style="padding-left: 110px; margin-top: -15px; font-weight: bold">
        Kantor : {{ $sekolah->alamat }} <i class="fas fa-phone"></i>( {{ $sekolah->telpon }} )
        <br>
        Website : {{ $sekolah->website }} | Email : {{ $sekolah->email }}
    </p>
    <div style="clear: both"></div>
    <hr style="border-width: 3px; margin-top: -5px;">
    <center>
        <h4 style="text-decoration: underline;">DATA PENDAFTARAN</h4>
    </center>
    <p>Berikut merupakan data status pendaftaran calon siswa</p>
    <table style="width: 100%" border="1" cellspacing="0" cellpadding="3">
        <thead>
            <th>NO</th>
            <th>NAMA</th>
            <th>JURUSAN DIPILIH</th>
            <th>SEKOLAH ASAL</th>
            <th>STATUS</th>
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
                            Sedang di verifikasi
                        @else
                            {{ ($dp->status == 1) ? 'LULUS' : 'TIDAK LULUS'; }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="clear: both"></div>
    <table border="0" style="margin-top: 35px; float: right">
        <tr style="text-align: left">
            <td>Karawang {{ date('d M Y', time()) }}</td>
        </tr>
        <tr style="text-align: left">
            <td>Ketua Panitia PPDB</td>
        </tr>
        <tr style="text-align: left">
            <td>
                <img src="{{ url('/assets/files') }}/{{ $sekolah->ttd_panitia }}" alt="TTD Panitia" style="width: 100px;">
            </td>
        </tr>
        <tr style="text-align: left">
            <th>
                <span style="text-decoration: underline">{{ $sekolah->panitia }}</span>
                <br>
                NIP : {{ $sekolah->nip_panitia }}
            </th>
        </tr>
    </table>

    <script>
        window.print();
    </script>
</body>
</html>