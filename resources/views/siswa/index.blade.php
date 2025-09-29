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
                                Selamat! Anda dinyatakan lulus dalam Pendaftaran <strong>Tahun Angkatan {{ $notif->pendaftaran->tahun_angkatan }} Gelombang Ke-{{ $notif->pendaftaran->gelombang }}</strong>.<br>
                                Bukti lulus pendaftaran bisa anda cetak di menu Pendaftaran
                            </p>
                            <a href="{{ url('/siswa/notif') }}/{{ $notif->id }}" class="btn btn-danger">Tutup Notifikasi</a>
                        </div>
                    </div>
                </div>
            </div>

              
         
        @endif
      @endforeach
@if($status_lulus->status == 2)
        <div class="row">
                <div class="col-lg-12">
                    <div class="card w-100">
                        <div class="card-header text-bg-danger">
                            <h4 class="mb-0 text-white card-title">Status Terkini</h4>
                        </div>
                        <div class="card-body">
                             
                            <h3 class="card-title">Pendaftaranmu Tidak Diterima</h3>
                            <p class="card-text">
                              Silahkan coba daftar kembali di gelombang berikutnya
                            </p>
                         
                        </div>
                    </div>
                </div>
            </div>
                @elseif($status_lulus->status == 1)
                <div class="row">
                <div class="col-lg-12">
                    <div class="card w-100">
                        <div class="card-header text-bg-success">
                            <h4 class="mb-0 text-white card-title">Status Terkini</h4>
                        </div>
                        <div class="card-body">
                             
                            <h3 class="card-title">Pendaftaranmu Diterima</h3>
                             <p class="card-text">
        Silakan simpan atau cetak <strong>Surat Keterangan Diterima</strong> sebagai bukti resmi bahwa pendaftaranmu telah diterima dan kamu siap menjadi siswa SMK Darussalam Karangpucung.  
        <br><br>
        <strong>QR Code Identitas</strong> berfungsi sebagai tanda pengenal digital yang akan digunakan untuk presensi pada berbagai agenda kehadiran di lingkungan SMK Darussalam Karangpucung.
    </p>
                            <a href="{{ url('/suket/' . $status_lulus->siswa->no_regis . '.pdf')}}" class="btn btn-secondary" target="_blank"><i class="ti ti-printer"></i> Cetak Surat Keterangan</a>
                            <!-- <a href="{{url('/qr_code/' . $status_lulus->siswa->no_regis . '.svg') }}" class="btn btn-info" target="_blank"><i class="ti ti-qrcode"></i> QR Code Identitas</a> -->
                            <a href="{{ url('/qr-code/' . $status_lulus->siswa->no_regis) }}" 
   class="btn btn-info" target="_blank">
   <i class="ti ti-qrcode"></i> QR Code Identitas
</a>


                        </div>
                    </div>
                </div>
            </div>

            @else 
             <div class="row">
                <div class="col-lg-12">
                    <div class="card w-100">
                        <div class="card-header text-bg-success">
                            <h4 class="mb-0 text-white card-title">Status Terkini</h4>
                        </div>
                        <div class="card-body">
                             
                            <h3 class="card-title">Menunggu Verifikasi</h3>
                            <p class="card-text">
                              Silahkan menunggu verifikasi
                            </p>
                         
                        </div>
                    </div>
                </div>
            </div>
                @endif
    

    {!! session('pesan') !!}

@endsection