@extends('l-p-t.m-p')
@section('content')

    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Data Siswa</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/admin') }}">Master Data</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Siswa</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Jurusan --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="mb-0">Data Siswa</h5>
                        {{-- filter siswa  --}}
                        <div class="row"> 
                            <div class="col-md-4 my-3">
                                {{-- kasih select option Siswa diterima, menunggu verifikasi dan tidak diterima --}}
                               <form action="{{ url('/admin/siswa') }}" method="GET">
    <div class="form-group">
        <select class="form-control" id="status" name="status" onchange="this.form.submit()">
            <option value="">Semua</option>
            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Diterima</option>
            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Menunggu Verifikasi</option>
            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Tidak Diterima</option>
        </select>
    </div>
</form>


                            </div>
                            <div class="col-md-2 my-3">
                                <a href="{{ url('/guru/verificator/siswa/ekspor') }}" class="btn btn-success">Ekspor Excel</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="zero_config" class="table border table-bordered text-nowrap align-middle">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                    <th>No Regis</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                          <tbody>
        @foreach ($data_siswa as $siswa)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->jurusan }}</td>
                <td>{{ $siswa->no_regis }}</td>
                <td> @switch($siswa->pendaftaran->status)
        @case(1)
            Diterima
            @break
        @case(0)
            Menunggu Verifikasi
            <a href="{{ url('verifikasi/'.$siswa->pendaftaran->id) }}" class="btn btn-success btn-sm">Terima</a>
            @break
        @case(2)
            Tidak Diterima
            @break
        @default
            -
    @endswitch</td>
                <td>
                    <!-- Tombol Detail -->
                    <button type="button" class="btn btn-sm btn-primary" 
                        data-bs-toggle="modal" 
                        data-bs-target="#detailModal{{ $siswa->id }}">
                        Detail
                    </button>

                    {{-- modal --}}
                        
                        <!-- Modal Detail -->
            <div class="modal fade" id="detailModal{{ $siswa->id }}" tabindex="-1" aria-labelledby="detailLabel{{ $siswa->id }}" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="detailLabel{{ $siswa->id }}">Detail Siswa</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                       <div class="modal-body">
    <div class="row">
        
        <div class="col-md-4 text-center mb-3">
            <!-- Foto Identitas -->
            @if($siswa->foto)
                <img src="{{asset('foto/' . $siswa->foto) }}" alt="Foto Siswa" class="img-thumbnail rounded" width="120">
            @else
                <img src="{{ asset('files/default.png') }}" alt="Tidak ada foto" class="img-thumbnail rounded" width="120">
            @endif
            <p class="mt-2 text-muted">Foto Identitas</p>
            
        </div>

        <div class="col-md-8">
            <table class="table table-sm">
                <tr>
                    <th width="40%">Nama</th>
                    <td>: {{ $siswa->nama }}</td>
                </tr>
                <tr>
                    <th>Jurusan</th>
                    <td>: {{ $siswa->jurusan }}</td>
                </tr>
                <tr>
                    <th>No Registrasi</th>
                    <td>: {{ $siswa->no_regis }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                   <td>:
    @switch($siswa->pendaftaran->status)
        @case(1)
            Diterima
            @break
        @case(0)
            Menunggu Verifikasi
            <a href="{{ url('verifikasi/'.$siswa->pendaftaran->id) }}" class="btn btn-success btn-sm">Terima</a>
            @break
        @case(2)
            Tidak Diterima
            @break
        @default
            -
    @endswitch
</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>: {{ $siswa->jenis_kelamin ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td>: {{ $siswa->tempat_lahir ?? '-' }}, @php
$format_tanggal = function ($tanggal) {
    if (!$tanggal) return '-';
    try {
        $date = \Carbon\Carbon::parse($tanggal);
    } catch (\Exception $e) {
        return '-';
    }
    return $date->translatedFormat('d F Y');
};
@endphp

{{ $format_tanggal($siswa->tgl_lahir) }}</td>
                </tr>
                <tr>
                    <th>No HP</th>
                    <td>: {{ $siswa->no_hp ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>: {{ $siswa->alamat ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Sekolah Asal</th>
                    <td>: {{ $siswa->sekolah_asal ?? '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <hr>

    <div class="row text-center">
        <!-- Foto KK -->
        <div class="col-md-3 col-6 mb-3">
            @if($siswa->kk)
                <a href="{{ asset('kk/'.$siswa->kk) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                    <i class="bi bi-card-image"></i> Lihat Foto KK
                </a>
            @else
                <button class="btn btn-outline-secondary btn-sm w-100" disabled>Tidak Ada KK</button>
            @endif
        </div>

        <!-- Foto Akta -->
        <div class="col-md-3 col-6 mb-3">
            @if($siswa->akta)
                <a href="{{ asset('akta/'.$siswa->akta) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                    <i class="bi bi-card-image"></i> Lihat Akta
                </a>
            @else
                <button class="btn btn-outline-secondary btn-sm w-100" disabled>Tidak Ada Akta</button>
            @endif
        </div>

        <!-- Foto KIP -->
        <div class="col-md-3 col-6 mb-3">
            @if($siswa->kip)
                <a href="{{ asset('kip/'.$siswa->kip) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                    <i class="bi bi-card-image"></i> Lihat KIP
                </a>
            @else
                <button class="btn btn-outline-secondary btn-sm w-100" disabled>Tidak Ada KIP</button>
            @endif
        </div>

        <!-- Tombol Download Suket & QR -->
        @if($siswa->pendaftaran->status == 1)
            <div class="col-md-3 col-6 mb-3">
                <a target="_blank" href="{{ url('cetak_surat_keterangan/'.$siswa->no_regis.'') }}" class="btn btn-success btn-sm w-100">
                    <i class="bi bi-download"></i> Download Suket
                </a>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <a href="{{ url('qr-code/'.$siswa->no_regis) }}" target="_blank" class="btn btn-info btn-sm w-100">
                    <i class="bi bi-qr-code"></i> Lihat QR
                </a>
            </div>
        @endif
    </div>
</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
                    {{-- akhir modal --}}
                    <!-- Tombol Edit -->
                    <button type="button" class="btn btn-sm btn-warning" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editModal{{ $siswa->id }}">
                        Edit
                    </button>

                    <!-- Tombol Hapus -->
                    <form action="{{ url('/admin/siswa/' . $siswa->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger hapus">Hapus</button>
                    </form>
                </td>
            </tr>


            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $siswa->id }}" tabindex="-1" aria-labelledby="editLabel{{ $siswa->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ url('/admin/siswa/' . $siswa->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title" id="editLabel{{ $siswa->id }}">Edit Data Siswa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $siswa->nama }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jurusan</label>
                                    <input type="text" name="jurusan" class="form-control" value="{{ $siswa->jurusan }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">No Registrasi</label>
                                    <input type="text" name="no_regis" class="form-control" value="{{ $siswa->no_regis }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

      {!! session('pesan') !!}
      <script>
        $("#zero_config").DataTable();

        $('.hapus').click(function (e) {
            e.preventDefault();
            var tombol_ini = $(this);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                // confirmButtonColor: "#3085d6",
                // cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Tidak!"
            }).then((result) => {
                if (result.isConfirmed) {
                    tombol_ini.parent('form').submit();
                }
            });
        });
      </script>

@endsection