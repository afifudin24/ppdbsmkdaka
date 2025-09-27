<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Pengumuman</title>
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
        <h4 style="text-decoration: underline;">S U R A T P E N G U M U M A N</h4>
        <p style="margin-top: -17px;" class="f-12">No : 789/SMAN.666/AKP.001/VII/{{ date('y', time()) }}</p>
    </center>
    <p>Yang bertanda tangan dibawah ini Kepala {{ $sekolah->nama }} menerangkan bahwa : </p>
    {{-- <img src="{{ url('/assets/files') }}/{{ $user->foto }}" alt="Profile" class="img-thumbnail" style="width: 135px;"> --}}
    <table border="0" cellpadding="4" class="f-12" style="text-align: left; margin-top: 5px;">
        <tr>
            <th>NO REGISTRASI</th>
            <td style="width: 20px;"></td>
            <td> : {{ $user->no_regis }}</td>
        </tr>
        <tr>
            <th>TGL PENDAFTARAN</th>
            <td style="width: 20px;"></td>
            <td> : {{ $detail_pendaftaran->created_at }}</td>
        </tr>
        <tr>
            <th>NISN</th>
            <td style="width: 20px;"></td>
            <td> : {{ $user->nisn }}</td>
        </tr>
        <tr>
            <th>NIS</th>
            <td style="width: 20px;"></td>
            <td> : {{ $user->nis }}</td>
        </tr>
        <tr>
            <th>NAMA LENGKAP</th>
            <td style="width: 20px;"></td>
            <td> : {{ $user->nama }}</td>
        </tr>
        <tr>
            <th>JENIS KELAMIN</th>
            <td style="width: 20px;"></td>
            <td> : {{ $user->jenis_kelamin }}</td>
        </tr>
        <tr>
            <th>TEMPAT, TANGGAL LAHIR</th>
            <td style="width: 20px;"></td>
            <td> : {{ $user->tempat_lahir }} {{ $user->tgl_lahir }}</td>
        </tr>
        <tr>
            <th>AGAMA</th>
            <td style="width: 20px;"></td>
            <td> : {{ $user->agama }}</td>
        </tr>
        <tr>
            <th>NAMA ORANGTUA / WALI</th>
            <td style="width: 20px;"></td>
            <td> : </td>
        </tr>
        <tr>
            <th style="text-align: center">AYAH</th>
            <td style="width: 20px;"></td>
            <td> : {{ $user->nama_ayah }}</td>
        </tr>
        <tr>
            <th style="text-align: center">IBU</th>
            <td style="width: 20px;"></td>
            <td> : {{ $user->nama_ibu }}</td>
        </tr>
        <tr>
            <th>NO. TELEPON/HP</th>
            <td style="width: 20px;"></td>
            <td> : {{ $user->hp }}</td>
        </tr>
        <tr>
            <th>ALAMAT EMAIL</th>
            <td style="width: 20px;"></td>
            <td> : {{ $user->email }}</td>
        </tr>
        <tr>
            <th>ASAL SEKOLAH</th>
            <td style="width: 20px;"></td>
            <td> : {{ $user->sekolah_asal }}</td>
        </tr>
    </table>
    <center>
        <p>Dinyatakan : </p>
        <div style="width: 200px; height: 50px; line-height: 10px; border: 3px solid #000;">
            <h4>LULUS</h4>
        </div>
    </center>
    <p>Demikian surat keterangan lulus ini dibuat untuk dapat dipergunakan sebagaimana mestinya</p>
    {{-- <div style="padding: 30px;">
    </div> --}}
    <div style="clear: both"></div>
    <table border="0" style="margin-top: 35px; float: right">
        <tr style="text-align: left">
            <td>Karawang {{ date('d M Y', time()) }}</td>
        </tr>
        <tr style="text-align: left">
            <td>Kepala Sekolah</td>
        </tr>
        <tr style="text-align: left">
            <td>
                <img src="{{ url('/assets/files') }}/{{ $sekolah->ttd_kepsek }}" alt="TTD Kepsek" style="width: 100px;">
            </td>
        </tr>
        <tr style="text-align: left">
            <th>
                <span style="text-decoration: underline">{{ $sekolah->kepsek }}</span>
                <br>
                NIP : {{ $sekolah->nip_kepsek }}
            </th>
        </tr>
    </table>

    <script>
        window.print();
    </script>
</body>
</html>