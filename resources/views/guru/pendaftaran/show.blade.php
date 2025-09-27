@extends('l-p-t.m-p')
@section('content')
    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Data Pendaftaran</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/admin') }}">Master Data</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/admin/pendaftaran') }}">Pendaftaran</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Detail Pendaftaran</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Jurusan --}}
    <div class="row">
        <div class="col-12">
            <!-- ---------------------
            start Zero Configuration
            ---------------- -->
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="mb-0">Detail Pendaftaran</h5>
                    </div>
                    <p class="card-subtitle mb-3">
                        Detail pendaftaran <strong>Tahun Angkatan {{ $pendaftaran->tahun_angkatan }} Gelombang Ke-{{ $pendaftaran->gelombang }}</strong>
                    </p>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="my-2">
                                <label for="cetak">Cetak Data</label>
                                <div class="input-group">
                                    <select name="cetak" id="cetak" class="form-control">
                                        <option value="*">Semua</option>
                                        <option value="1">Lulus</option>
                                        <option value="2">Tidak Lulus</option>
                                    </select>
                                    <div class="input-group-append">
                                        <a href="" class="btn btn-warning cetak-pdf" target="_blank" style="border-radius: 0px; padding-top: 8px; padding-bottom: 8px;">PDF</a>
                                    </div>
                                    <div class="input-group-append">
                                        <a href="" class="btn btn-success cetak-excel" target="_blank" style="border-bottom-left-radius: 0px; border-top-left-radius: 0px; padding-top: 8px; padding-bottom: 8px;">EXCEL</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table id="zero_config" class="table border table-bordered text-nowrap align-middle">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Siswa</th>
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th class="text-center">jurusan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Opsi</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                                @foreach ($pendaftaran->detail_pendaftaran as $dp)
                                    <!-- start row -->
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dp->siswa->nama }}</td>
                                        <td>{{ $dp->siswa->jenis_kelamin }}</td>
                                        <td>{{ $dp->siswa->jurusan }} </td>
                                        <td>
                                            @if ($dp->status == 0)
                                                <span class="badge bg-warning-subtle text-warning fw-bold">Belum Diproses</span>
                                            @else
                                                @if ($dp->status == 1)
                                                    <span class="badge bg-success-subtle text-success fw-bold">Lulus</span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger fw-bold">Tidak Lulus</span>
                                                @endif
                                            @endif
                                        </td>
                                        {{-- <td>{{ $pendaftaran->created_at }}</td> --}}
                                        <td>
                                            @if ($dp->status == 0)
                                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                    <a href="{{ url('/admin/pendaftaran_siswa') }}/{{ $pendaftaran->id }}/{{ $dp->siswa_id }}" class="btn bg-success-subtle btn-sm text-success font-medium">
                                                        Lihat Data
                                                    </a>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button type="button" class="btn bg-primary-subtle text-primary font-medium dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Proses
                                                        </button>
                                                        <div class="dropdown-menu" style="">
                                                            <a class="dropdown-item" href="{{ url('/admin/pendaftaran_siswa/lulus') }}/1/{{ $dp->id }}">Lulus</a>
                                                            <a class="dropdown-item" href="{{ url('/admin/pendaftaran_siswa/lulus') }}/2/{{ $dp->id }}">Tidak Lulus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                    <a href="{{ url('/admin/pendaftaran_siswa') }}/{{ $pendaftaran->id }}/{{ $dp->siswa_id }}" class="btn bg-success-subtle btn-sm text-success font-medium">
                                                        Lihat Data
                                                    </a>
                                                    
                                                    <a href="{{ url('/admin/pendaftaran_siswa/lulus') }}/0/{{ $dp->id }}" class="btn bg-danger-subtle btn-sm text-danger font-medium fw-bold">
                                                        Batalkan
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- end row -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ url('/admin/pendaftaran') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
          <!-- ---------------------
                end Zero Configuration
            ---------------- -->
        </div>
    </div>

      {!! session('pesan') !!}
      <script>
        $("#zero_config").DataTable();

        $('.cetak-pdf').click(function (e) {
            e.preventDefault();
            var status = $('select[name=cetak]').val();
            var url = "{{ url('/admin/pendaftaran_pdf') }}/{{ $pendaftaran->id }}/" + status;

            document.location.href = url;
        });
        $('.cetak-excel').click(function (e) {
            e.preventDefault();
            var status = $('select[name=cetak]').val();
            var url = "{{ url('/admin/pendaftaran_excel') }}/{{ $pendaftaran->id }}/" + status;

            document.location.href = url;
        });

      </script>

@endsection