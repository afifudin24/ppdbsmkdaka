<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Diterima</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 14px;
            line-height: 1.6;
        }
        .kop {
            text-align: center;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .kop h2, .kop h3 {
            margin: 0;
            padding: 0;
        }
        .content {
            margin: 0 40px;
        }
        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin: 20px 0;
        }
        .identitas {
            margin: 20px 0;
        }
        .identitas table {
            width: 100%;
        }
        .identitas td {
            padding: 4px 0;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .ttd {
            margin-top: 70px;
        }
        .qr {
            margin-top: 20px;
            text-align: left;
        }
        .qr img {
            width: 100px;
        }
    </style>
</head>
<body>
    <div class="kop">
        <h2>SMK DARUSSALAM KARANGPUCUNG</h2>
        <h3>Jl. Raya Karangpucung No. 123, Cilacap</h3>
    </div>

    <div class="content">
        <div class="judul">
            SURAT KETERANGAN DITERIMA
        </div>

        <p>
            Dengan ini menerangkan bahwa:
        </p>

        <div class="identitas">
            <table>
                <tr>
                    <td style="width: 180px;">No Registrasi</td>
                    <td>: {{ $siswa->no_regis }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: {{ $siswa->nama }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: {{ $siswa->nik }}</td>
                </tr>
                <tr>
                    <td>Asal Sekolah</td>
                    <td>: {{ $siswa->sekolah_asal }}</td>
                </tr>
                <tr>
                    <td>ID Siswa</td>
                    <td>: {{ $siswa->id }}</td>
                </tr>
            </table>
        </div>

        <p>
            Dinyatakan <strong>DITERIMA</strong> sebagai siswa SMK Darussalam Karangpucung pada tahun ajaran {{ date('Y') }}/{{ date('Y')+1 }}.  
            Surat keterangan ini berlaku sebagai bukti resmi penerimaan siswa baru.
        </p>

        <div class="footer">
            Karangpucung, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}  
            <br>
            Kepala Sekolah
            <div class="ttd">
                <u><strong>Nama Kepala Sekolah</strong></u>  
                <br>NIP. 1234567890
            </div>
        </div>

        <div class="qr">
            <p><strong>QR Code Identitas:</strong></p>
           <img src="{{ $siswa->qr_code }}" width="120" alt="QR Code">

        </div>
    </div>
</body>
</html>
