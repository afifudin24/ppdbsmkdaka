@extends('l-p-t.m-p')
@section('content')
    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Verifikasi Pendaftar</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/guru') }}">Master Data</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/guru/verificator/verifikasi') }}">Verifikasi Pendaftar</a>
                            </li>
                          
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
                                @foreach ($pendaftaran as $dp)
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
                                                    <a href="{{ url('/guru/verificator/pendaftaran_siswa') }}/{{ $dp->pendaftaran->id }}/{{ $dp->siswa_id }}" class="btn bg-success-subtle btn-sm text-success font-medium">
                                                        Lihat Data
                                                    </a>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button type="button" class="btn bg-primary-subtle text-primary font-medium dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Proses
                                                        </button>
                                                        <div class="dropdown-menu" style="">
                                                            <a class="dropdown-item" href="{{ url('/guru/verificator/pendaftaran_siswa/lulus') }}/1/{{ $dp->id }}">Terima</a>
                                                            <a class="dropdown-item" href="{{ url('/guru/verificator/pendaftaran_siswa/lulus') }}/2/{{ $dp->id }}">Tidak Diterima</a>
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

    
      </script>

@endsection