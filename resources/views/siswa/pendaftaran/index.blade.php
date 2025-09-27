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
                                <a class="text-muted text-decoration-none" href="{{ url('/siswa') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Data Pendaftaran</li>
                        </ol>
                    </nav>
                </div>
                {{-- <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ url('assets/template') }}/dist/assets/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

     @if ($cek_lulus == null)

        <div class="row">
            @if ($detail_pendaftaran->count() == 0)
                @foreach ($data_pendaftaran as $pendaftaran)
                    <div class="col-md-4 single-note-item all-category note-social" style="">
                        <div class="card card-body">
                            <span class="side-stick"></span>
                            <h6 class="note-title w-75 mb-0">
                                Tahun Angkatan {{ $pendaftaran->tahun_angkatan }}
                            </h6>
                            <p class="note-date fs-2">{{ $pendaftaran->created_at }}</p>
                            <div class="note-content">
                                <p class="note-inner-content">
                                    Pendaftaran <strong>Gelombang Ke-{{ $pendaftaran->gelombang }}</strong> telah dibuka dengan kuota <strong>{{ $pendaftaran->kuota }} Peserta</strong>
                                </p>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="ms-auto">
                                    <div class="category-selector btn-group">
                                        @if ($pendaftaran->kuota == $pendaftaran->detail_pendaftaran->count())
                                            <a class="nav-link badge bg-danger" href="javascript:void(0);">
                                                Kuota Penuh
                                            </a>
                                        @else
                                            <a class="nav-link badge bg-info" href="{{ url('/siswa/pendaftaran') }}/{{ $pendaftaran->id }}">
                                                Daftar Sekarang
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        
                    @endphp
                @endforeach
            @else
                @foreach ($data_pendaftaran as $pendaftaran)

                    @foreach ($detail_pendaftaran as $dp)
                        @if ($pendaftaran->id != $dp->pendaftaran_id)
                            <div class="col-md-4 single-note-item all-category note-social" style="">
                                <div class="card card-body">
                                    <span class="side-stick"></span>
                                    <h6 class="note-title w-75 mb-0">
                                        Tahun Angkatan {{ $pendaftaran->tahun_angkatan }}
                                    </h6>
                                    <p class="note-date fs-2">{{ $pendaftaran->created_at }}</p>
                                    <div class="note-content">
                                        <p class="note-inner-content">
                                            Pendaftaran <strong>Gelombang Ke-{{ $pendaftaran->gelombang }}</strong> telah dibuka dengan kuota <strong>{{ $pendaftaran->kuota }} Peserta</strong>
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-auto">
                                            <div class="category-selector btn-group">
                                                @if ($pendaftaran->kuota == $pendaftaran->detail_pendaftaran->count())
                                            <a class="nav-link badge bg-danger" href="javascript:void(0);">
                                                Kuota Penuh
                                            </a>
                                        @else
                                            <a class="nav-link badge bg-info" href="{{ url('/siswa/pendaftaran') }}/{{ $pendaftaran->id }}">
                                                Daftar Sekarang
                                            </a>
                                        @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php
                                
                            @endphp
                        @else

                            @if ($dp->status == 0)
                                <div class="col-md-4 single-note-item all-category note-social" style="">
                                    <div class="card card-body" style="border-left: 3px solid rgba(var(--bs-warning-rgb)">
                                        <span class="side-stick"></span>
                                        <h6 class="note-title w-75 mb-0">
                                            Tahun Angkatan {{ $pendaftaran->tahun_angkatan }}
                                        </h6>
                                        <p class="note-date fs-2">{{ $pendaftaran->created_at }}</p>
                                        <div class="note-content">
                                            <p class="note-inner-content">
                                                Pendaftaran <strong>Gelombang Ke-{{ $pendaftaran->gelombang }}</strong> <br>
                                                Pendaftaran Anda sedang di <strong>Verifikasi</strong>, silahkan cek secara berkala
                                            </p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-auto">
                                                <div class="category-selector btn-group">
                                                    <a class="nav-link badge bg-warning" href="{{ url('/siswa/pendaftaran') }}">
                                                        Lihat Detail
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    
                                @endphp
                            @endif

                        @endif
                        
                    @endforeach

                @endforeach
            @endif
        </div>
    @endif

    @foreach ($notifikasi as $notif)
        @if ($notif->status == 2)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card w-100">
                        <div class="card-header text-bg-danger">
                            <h4 class="mb-0 text-white card-title">Notifikasi Pendaftaran</h4>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Anda Tidak Lulus</h3>
                            <p class="card-text">
                                Maaf anda dinyatakan tidak lulus dalam Pendaftaran <strong>Tahun Angkatan {{ $notif->pendaftaran->tahun_angkatan }} Gelombang Ke-{{ $notif->pendaftaran->gelombang }}</strong>.<br>
                                Jangan patah semangat, anda bisa mencoba daftar kembali di kesempatan berikutnya!
                            </p>
                            <a href="{{ url('/siswa/notif') }}/{{ $notif->id }}" class="btn btn-danger">Tutup Notifikasi</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($notif->status == 1)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card w-100">
                        <div class="card-header text-bg-success">
                            <h4 class="mb-0 text-white card-title">Notifikasi Pendaftaran</h4>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Anda Lulus</h3>
                            <p class="card-text">
                                Selamat! anda dinyatakan lulus dalam Pendaftaran <strong>Tahun Angkatan {{ $notif->pendaftaran->tahun_angkatan }} Gelombang Ke-{{ $notif->pendaftaran->gelombang }}</strong>.<br>
                                Bukti lulus pendaftaran bisa anda cetak di menu Pendaftaran
                            </p>
                            <a href="{{ url('/siswa/notif') }}/{{ $notif->id }}" class="btn btn-danger">Tutup Notifikasi</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="mb-0">Data Riwayat Pendaftaran</h5>
                    </div>
                    <p class="card-subtitle mb-3">
                        Berisikan riwayat data pendaftaran yang pernah dikirim
                    </p>
    
    
                  <div class="table-responsive mt-3">
                        <table id="zero_config" class="table border table-bordered text-nowrap align-middle text-center">
                        <thead>
                            <!-- start row -->
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Angkatan</th>
                                <th class="text-center">Gelombang</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                            <tbody>
                                @foreach ($detail_pendaftaran as $pendaftaran)
                                    <!-- start row -->
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>Tahun {{ $pendaftaran->pendaftaran->tahun_angkatan }}</td>
                                        <td>Gelombang Ke-{{ $pendaftaran->pendaftaran->gelombang }}</td>
                                        <td>
                                            @if ($pendaftaran->status == 0)
                                                <span class="badge bg-warning-subtle text-warning fw-bold">Proses Verifikasi</span>
                                            @endif
                                            @if ($pendaftaran->status == 1)
                                                <span class="badge bg-success-subtle text-success fw-bold">Lulus</span>
                                            @endif
                                            @if ($pendaftaran->status == 2)
                                                <span class="badge bg-danger-subtle text-danger fw-bold">Tidak Lulus</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($pendaftaran->status == 0)
                                                <a href="{{ url('/siswa/pendaftaran_edit') }}/{{ $pendaftaran->pendaftaran->id }}" class="mb-1 badge font-medium bg-success-subtle text-success">Edit</a>
                                            @endif
                                            @if ($pendaftaran->status == 1)
                                                <a href="{{ url('/siswa/pendaftaran_cetak') }}/{{ $pendaftaran->pendaftaran->id }}" class="mb-1 badge font-medium bg-success-subtle text-success" target="_blank">Cetak</a>
                                            @endif
                                            <a href="{{ url('/siswa/pendaftaran_detail') }}/{{ $pendaftaran->pendaftaran->id }}" class="mb-1 badge font-medium bg-info-subtle text-info">Lihat</a>
                                        </td>
                                    </tr>
                                    <!-- end row -->
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
    </script>
@endsection