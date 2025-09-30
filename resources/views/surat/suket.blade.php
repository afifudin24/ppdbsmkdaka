<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Diterima</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body {
            font-family: "Times New Roman", serif;
            font-size: 14px;
            line-height: 1.6;
            padding: 30px 10px;
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
            font-size: 20px;
          
        }
        .identitas {
            margin: 10px 0;
        }
        .identitas table {
            width: 100%;
        }
        .identitas td {
            padding: 1px 0;
        }
        .footer {
            margin-top: 30px;
            float: right;
            text-align: center;
        }
        .ttd {
            margin-top: 70px;
        }
        .qr {
            margin-top: 30px;
            text-align: left;
        }
        .qr img {
            width: 100px;
        }
          .tableheader th, .tableheader td{
            border : none;
        }
    </style>
</head>
<body>
   <table width="100%" class="tableheader" style="border-collapse: collapse; margin-bottom: 10px; border : none !important">
    <tr border='none'>
        <td width="120" style="text-align: center;">
            <img src="{{ public_path('assets/files/'.$sekolah->favicon) }}" alt="Logo Sekolah" style="width: 120px; text-align: center;">
        </td>
        <td style="text-align: center;">
            <h3 style="margin: -10px 0 !important; font-size: 18px;">
               YAYASAN DARUSSALAM AL-FATAH KABUPATEN CILACAP
            </h3>
            <h2 style="margin: 0 !important; font-size: 28px; text-transform: uppercase;">
                {{ $sekolah->nama }}
            </h2>

            <p style="font-weight: bold; margin: 2px 0 0 0; font-size: 13px;">
               {{ $sekolah->alamat }}<br>
              Telp. {{ $sekolah->telpon }} |
                Website : {{ $sekolah->website }} | Email : {{ $sekolah->email }}
            </p>
        </td>
    </tr>
</table>
<hr style="border: 2px solid #000; margin-top: -3px; margin-bottom: 5px;">
    <div class="content">
        <div class="">
            <h4 class="judul">
                SURAT KETERANGAN 
            </h4>
            <p style="margin-top: 0px; text-align: center">No. {{$siswa->id}}/421.5/SPMB/SMK.Krpc/VI/2025</p>
        </div>

        <p style="margin-top: 20px">
            Yang bertanda tangan dibawah ini :
        </p>

        <div class="identitas">
            <table>
                <tr>
                    <td style="width: 180px;">Nama</td>
                    <td>: {{ $sekolah->kepsek }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>: Kepala Sekolah</td>
                </tr>
             
            </table>
        </div>
          <p style="margin-top: 20px">
            Dengan ini menerangkan bahwa :
        </p>

        <div class="identitas">
             <table>
                <tr>
                    <td style="width: 180px;">No. Registrasi</td>
                    <td>: {{ $siswa->no_regis }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: {{$siswa->nama}}</td>
                </tr>
                <tr>
                    <td style="width: 180px;">Tempat, Tanggal Lahir</td>
                    <td>: {{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                </tr>
            
                <tr>
                    <td style="width: 180px;">Alamat</td>
                    <td>: {{ $siswa->alamat }}</td>
                </tr>
                <tr>
                    <td>Asal Sekolah</td>
                    <td>: {{$siswa->sekolah_asal}}</td>
                </tr>
             
            </table>
        </div>

        <div class="identitas">
             <table>
                <tr>
                    <td style="width: 180px;">Dinyatakan</td>
                    <td>: <span style="font-weight: bold">Diterima</span></td>
                </tr>
                <tr>
                    <td>Gelombang</td>
                    <td>: {{$pendaftaran->gelombang}}</td>
                </tr>
               
                <tr>
                    <td>Program Keahlian</td>
                    <td>: {{$siswa->jurusan}}</td>
                </tr>
                <tr>
                    <td style="width: 180px;">Tahun Pelajaran</td>
                    <td>: {{ $pendaftaran->tahun_angkatan }}</td>
                </tr>
               
             
            </table>
        </div>
        <p>Demikian surat keterangan ini dibuat untuk dapat digunakan sebagaimana mestinya.</p>

        <div class="footer">
            Karangpucung, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}  
            <br>
            Kepala Sekolah
            <div class="ttd">
                <u><strong>Nama Kepala Sekolah</strong></u>  
                
            </div>
        </div>

        <div class="qr">
            <p><strong>QR Code Identitas</strong></p>
           <img src="{{ $siswa->qr_code }}" width="120" alt="QR Code">

        </div>

        <div style="margin-top: 50px"></div>
         <p style="font-weight: bold">Lampiran yang harus dilengkapi</p>
  <table>
    <thead>
    
   
      <tr>
        <td>1. </td>
        <td>Kartu Keluarga</td>
        <td>: 1 lembar (photocopy)</td>
      </tr>
      <tr>
        <td>2. </td>
        <td>KIP/PKH (bagi yang punya)</td>
        <td>: 1 lembar (photocopy)</td>
      </tr>
      <tr>
        <td>3. </td>
        <td>KTP Orang Tua</td>
        <td>: 1 lembar (photocopy)</td>
      </tr>
      <tr>
        <td>4. </td>
        <td>Akta Kelahiran</td>
        <td>: 1 lembar (photocopy)</td>
      </tr>
    
  </table>

  <p style="font-weight: bold">Keterangan Pembayaran</p>
  <table>
     <tr>
        <td>1. </td>
        <td>Melalui Bank BRI atas nama SMK Darussalam dengan No. Rekening: 6787-01-031735-53-5</td>
       
      </tr>
       <tr>
        <td>2. </td>
        <td>Besaran biaya akan kami informasikan lebih lanjut.</td>
       
      </tr>
    
  </table>

    </div>
</body>
</html>
