<table style="border-collapse: collapse; width: 100%; table-layout: auto;">
    <tr>
        <td colspan="8" align="center" style="font-weight: bold; font-size: 14pt;">
            DATA SISWA PENDAFTAR
        </td>
    </tr>
 
 

    <tr><td colspan="8" style="height: 10px;"></td></tr>

    <tr style="background-color: #e8f1ff; font-weight: bold;" align="center">
        <th>No</th>
        <th>Nama Siswa</th>
        <th>No Regis</th>
        <th>Asal Sekolah</th>
        <th>Jurusan</th>
        <th>Referral</th>
        <th>Status Pendaftaran</th>
        <th>Kehadiran</th>
    </tr>

    @foreach ($data_siswa as $index => $data)
        <tr align="center">
            <td>{{ $index + 1 }}</td>
            <td align="left">{{ $data->nama ?? '-' }}</td>
            <td>{{ $data->no_regis ?? '-' }}</td>
            <td>{{ $data->sekolah_asal ?? '-' }}</td>
            <td>{{ $data->jurusan ?? '-' }}</td>
            <td>{{ $data->guru->nama ?? '-' }}</td>
           <td>
    {{ 
        $data->pendaftaran->status == 0 ? 'Belum Diverifikasi' :
        ($data->pendaftaran->status == 1 ? 'Diterima' :
        ($data->pendaftaran->status == 2 ? 'Tidak Diterima' : '-'))
    }}
</td>

            <td>{{ $data->datakehadiran[0]->agenda->nama_agenda ?? '-' }}</td>
        </tr>
    @endforeach
</table>
