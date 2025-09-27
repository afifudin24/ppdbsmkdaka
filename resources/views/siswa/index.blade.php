@extends('l-p-t.m-p')
@section('content')
    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Dashboard</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/siswa') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Dashboard</li>
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
    @php
        $ceknotif = 0;
    @endphp
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
                        $ceknotif++;
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
                                $ceknotif++;
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
                                    $ceknotif++;
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
            @php
                $ceknotif++;
            @endphp
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
                                Selamat! Anda dinyatakan lulus dalam Pendaftaran <strong>Tahun Angkatan {{ $notif->pendaftaran->tahun_angkatan }} Gelombang Ke-{{ $notif->pendaftaran->gelombang }}</strong>.<br>
                                Bukti lulus pendaftaran bisa anda cetak di menu Pendaftaran
                            </p>
                            <a href="{{ url('/siswa/notif') }}/{{ $notif->id }}" class="btn btn-danger">Tutup Notifikasi</a>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $ceknotif++;
            @endphp
        @endif
    @endforeach

    @if ($ceknotif == 0)
    <div class="row">
        <div class="col-lg-12">
            <div class="card w-100">
                <div class="card-header text-bg-warning">
                    <h4 class="mb-0 text-white card-title">NOTIFIKASI</h4>
                </div>
                <div class="card-body">
                    <h3 class="card-title">Belum Ada Notifikasi</h3>
                    <p class="card-text">
                        Notifikasi Gelombang Pendaftaran, status lulus & tidak lulus Pendaftaran akan tampil disini
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    {!! session('pesan') !!}

@endsection