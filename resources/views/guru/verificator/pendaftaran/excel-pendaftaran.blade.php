<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pendaftaran</title>
</head>
<body>
    <table border="1" style="border: 1px solid #000">
        <thead>
            <tr>
                <td colspan="5">Pendaftaran Tahun Angkatan {{ $pendaftaran_detail[0]->pendaftaran->tahun_angkatan }} Gelombang Ke-{{ $pendaftaran_detail[0]->pendaftaran->gelombang }}</td>
            </tr>
            <tr>
                <td bgcolor="#FFFF00">No</td>
                <td bgcolor="#FFFF00">Siswa</td>
                <td bgcolor="#FFFF00">Asal Sekolah</td>
                <td bgcolor="#FFFF00">Jurusan Dipilih</td>
                <td bgcolor="#FFFF00">Status Pendaftaran</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendaftaran_detail as $pendaftaran)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pendaftaran->siswa->nama }}</td>
                    <td>{{ $pendaftaran->siswa->sekolah_asal }}</td>
                    <td>{{ $pendaftaran->siswa->jurusan }}</td>
                    <td>{{ ($pendaftaran->status == 1) ? 'LULUS' : 'TIDAK LULUS' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>