<table style="border-collapse: collapse; width: 100%; table-layout: auto;">
    <tr>
        <td colspan="6" align="center" style="font-weight: bold; font-size: 14pt;">
            DATA KEHADIRAN SISWA
        </td>
    </tr>
    <tr>
        <td colspan="6" align="center" style="font-weight: bold;">
            {{ $agenda->nama_agenda ?? '-' }}
        </td>
    </tr>
    <tr>
        <td colspan="6" align="center">
            Tanggal: {{ \Carbon\Carbon::parse($agenda->tanggal ?? now())->format('d/m/Y') }}
        </td>
    </tr>

    <tr><td colspan="5" style="height: 10px;"></td></tr>

    <tr style="background-color: #e8f1ff; font-weight: bold;" align="center">
        <th>No</th>
        <th>Nama Siswa</th>
        <th>No Regis</th>
        <th>Asal Sekolah</th>
        <th>Jurusan</th>
        <th>Referral</th>
    </tr>

    @foreach ($data_kehadiran as $index => $data)
        <tr align="center">
            <td>{{ $index + 1 }}</td>
            <td align="left">{{ $data->siswa->nama ?? '-' }}</td>
            <td>{{ $data->siswa->no_regis ?? '-' }}</td>
            <td>{{ $data->siswa->sekolah_asal ?? '-' }}</td>
            <td>{{ $data->siswa->jurusan ?? '-' }}</td>
            <td>{{ $data->siswa->guru->nama ?? '-' }}</td>
        </tr>
    @endforeach
</table>
