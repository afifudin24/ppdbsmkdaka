<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme">
  
<head>
    <!-- Required meta tags -->
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- Favicon icon-->
<link
  rel="shortcut icon"
  type="image/png"
  href="{{ url('assets/files') }}/{{ $sekolah->favicon}}"
/>
<!-- Core Css -->
<link rel="stylesheet" href="{{ url('assets/template/dist') }}/assets/css/styles.css" />
    <title>SPMB ONLINE DAKA</title>
    <!-- Owl Carousel  -->
    <link
      rel="stylesheet"
      href="{{ url('assets/template/dist') }}/assets/libs/owl.carousel/dist/assets/owl.carousel.min.css"
    />
    <link rel="stylesheet" href="{{ url('assets/template/dist') }}/assets/libs/aos/dist/aos.css" />
    <style>
        @media (max-width: 991.98px) {
            .my-hero{
                height: 300px;
            }
        }
        .side-stick {
            position: absolute;
            width: 3px;
            height: 35px;
            left: 0;
            background-color: var(--bs-info);
        }
    </style>
  </head>
  <body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ url('assets/files') }}/{{ $sekolah->favicon }}" alt="loader" class="lds-ripple img-fluid"/>
    </div>
    <div id="main-wrapper flex-column">
        
        <header class="header">
            <nav class="navbar navbar-expand-lg py-0">
                <div class="container">
                    <a class="navbar-brand me-0 py-0" href="">
                        <img src="{{ url('assets/files') }}/{{ $sekolah->logo_dark }}" alt="img-fluid" style="width: 174px;" />
                    </a>
                    <button class="navbar-toggler d-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti ti-menu-2 fs-9"></i>
                    </button>
                    <button class="navbar-toggler border-0 p-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" >
                        <i class="ti ti-menu-2 fs-9"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav align-items-center mb-2 mb-lg-0 ms-auto">
                            <li class="nav-item">
                                <a class="nav-link scroll-link" href="#cara_daftar" >Cara Mendaftar</a>
                            </li>
                            <li class="nav-item ms-2">
                              
    <button type="button" class="btn btn-warning w-100 py-2" data-bs-toggle="modal" data-bs-target="#loginModal">
        Login
    </button>

                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="body-wrapper overflow-hidden pt-0">
            <div class="container">
                <div class="card rounded-2 overflow-hidden">
                    <div class="position-relative">
                        <a href="javascript:void(0)" style="cursor: auto">
                            <img src="{{ url('assets/files') }}/hero-1.jpg" class="card-img-top rounded-0 object-fit-cover my-hero" alt="..." height="600" style="filter: brightness(0.6)">
                        </a>
                        <div class="text-hero position-absolute bottom-0 left-0" style="width: 100%; height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center">
                            <img src="{{ url('assets/files') }}/{{ $sekolah->favicon }}" alt="img-fluid" style="width: 100px;" />
                            <h2 class="fs-9 fw-semibold text-white" style="text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5); text-align: center">
                                SELAMAT DATANG DI<br>SPMB ONLINE {{ $sekolah->nama }}
                            </h2>
                            
                            <a href="{{ url('/inputdaftar') }}" class="btn btn-success">
                                <i class="ti ti-user"></i> Daftar Sekarang
                            </a>
                        </div>
                        {{-- <a href="" class="btn btn-primary position-absolute" style="bottom: 40%; left: calc(50% - 37px);">
                            <i class="ti ti-user"></i> Daftar Akun
                        </a> --}}
                    </div>
                </div>
                {{-- Gelombang Pendaftaran --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card w-100 pb-4">
                            <div class="card-body">
                                <h3 class="fs-8 fw-semibold mb-7 text-center">GELOMBANG PENDAFTARAN</h3>
                                @if ($data_pendaftaran->count() == 0)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="alert customize-alert rounded-pill alert-light-danger bg-danger-subtle text-danger" role="alert">
                                                <div class="d-flex align-items-center font-medium me-3 me-md-0">
                                                    <i class="ti ti-info-circle fs-5 me-2 text-danger"></i>
                                                    Belum ada gelombang Pendaftaran yang dibuka, silahkan cek secara berkala
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
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
                                                                <a class="nav-link badge bg-info" href="{{ url('/inputdaftar') }}">
                                                                    Daftar Sekarang
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Cara Mendaftar --}}
                <div class="row" id="cara_daftar">
                    <div class="col-lg-12">
                        <div class="card w-100 pb-4">
                            <div class="card-body">
                                <h3 class="fs-8 fw-semibold mb-7 text-center">CARA MENDAFTAR</h3>
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-7">
                                        <ul class="timeline-widget mb-0 position-relative mb-n5">
                                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                                <div class="timeline-time text-dark flex-shrink-0 text-end">Langkah Ke-1</div>
                                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                    <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                                </div>
                                                <div class="timeline-desc fs-4 text-dark mt-n1" style="text-align: justify">Akses halaman pendaftaran dengan klik <a class="fs-4 text-primary" href="/inputdaftar">disini</a></div>
                                            </li>
                                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                                <div class="timeline-time text-dark flex-shrink-0 text-end">Langkah Ke-2</div>
                                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                    <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                                </div>
                                                <div class="timeline-desc fs-4 text-dark mt-n1" style="text-align: justify">
                                                   Pendaftaran tidak bisa dilakukan jika kuota pendaftaran penuh atau gelombang pendaftaran sudah di tutup.
                                                </div>
                                            </li>
                                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                                <div class="timeline-time text-dark flex-shrink-0 text-end">Langkah Ke-3</div>
                                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                    <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                                </div>
                                                <div class="timeline-desc fs-4 text-dark mt-n1" style="text-align: justify">Silahkan isi formulir pendaftaran dengan data yang valid sesuai dengan yang data persyaratan pendaftaran.</div>
                                            </li>
                                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                                <div class="timeline-time text-dark flex-shrink-0 text-end">Langkah Ke-4</div>
                                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                    <span class="timeline-badge border-2 border border-warning flex-shrink-0 my-8"></span>
                                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                                </div>
                                                <div class="timeline-desc fs-4 text-dark mt-n1" style="text-align: justify">
                                                 Setelah mengisi formulir, data pendaftaran kamu sedang di periksa petugas, jika data telah diverifikasi, kamu akan mendapat notifikasi whatsApp.
                                            </li>
                                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                                <div class="timeline-time text-dark flex-shrink-0 text-end">Langkah Ke-5</div>
                                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                    <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-8"></span>
                                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                                </div>
                                                <div class="timeline-desc fs-4 text-dark mt-n1" style="text-align: justify">
                                                    Cek secara berkala dengan <a class="fs-4 text-primary" href="/loginsiswa">login</a> ke dashboard siswa. Jika status pendaftaran <strong>Diterima</strong>, silahkan tunggu informasi berikutnya.
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Pertanyaan Umum --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card w-100 pb-4">
                            <div class="card-body">
                                <h3 class="fs-8 fw-semibold text-center">PERTANYAAN UMUM</h3>
                                <p class="fw-normal fs-5 mb-7 text-center">Berikut merupakan pertanyaan yang sering ditanyakan calon siswa</p>
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-7">
                                        <div class="accordion accordion-flush mb-5 card position-relative overflow-hidden"id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button collapsed fs-4 fw-semibold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Apakah bisa login ke sistem setelah mendaftar?
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body fs-4 fw-normal">
                                                       Ya, bisa. Setelah Anda berhasil mengisi formulir pendaftaran, sistem akan otomatis membuatkan akun. Dengan akun ini Anda dapat:
                                                        <ol>
                                                           <li><strong>Mengedit formulir</strong> jika ada kesalahan data yang sudah dikirim.</li>
  <li><strong>Melihat pengumuman hasil seleksi</strong> (lulus / tidak lulus) secara berkala, karena proses verifikasi data oleh petugas bisa memakan waktu beberapa hari.</li>
  <li><strong>Melakukan daftar ulang</strong>. Jika tidak diterima pada gelombang pertama, Anda masih bisa login dan mendaftar ulang di gelombang selanjutnya.</li>
                                                        </ol>
                                                        <p>
  🔑 <strong>Cara Login:</strong><br>
  Username: <em>NIK (Nomor Induk Kependudukan)</em><br>
  Password: <em>Tanggal lahir dengan format tahun-bulan-tanggal (contoh: 2008-09-15)</em>
</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingTwo">
                                                    <button class="accordion-button collapsed fs-4 fw-semibold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                        Bagaimana jika pendaftaran saya tidak lulus?
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body fs-4 fw-normal">
                                                        Anda bisa melakukan pendaftaran kembali di gelombang pendaftaran yang akan di buka selanjutnya
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="#kontak_info">
                    <div class="col-lg-12">
                        <div class="card bg-primary-subtle rounded-2">
                            <div class="card-body text-center">
                                <h3 class="fw-semibold">Contacts Information</h3>
                                <p class="fw-normal fs-4">
                                    Untuk informasi lebi lanjut hubungi kami melalui kontak dibawah ini
                                </p>
                                {{-- <a href="javascript:void(0)" class="btn btn-primary mb-8">Chat with us</a> --}}
                                <ul style="list-style: none">
                                    <li class="fw-normal fs-4"><i class="fab fa-whatsapp fs-7"></i> {{ $sekolah->telpon }}</li>
                                    <li class="fw-normal fs-4"><i class="fab fa-wordpress fs-7"></i> <a href="https://{{ $sekolah->website }}" target="_blank">{{ $sekolah->website }}</a></li>
                                    <li class="fw-normal fs-4"><i class="far fa-envelope fs-7"></i> {{ $sekolah->email }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="offcanvas offcanvas-start modernize-lp-offcanvas" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header p-4">
                <img src="{{ url('assets/template/dist') }}/assets/images/logos/dark-logo.png" alt="" class="img-fluid" width="150"/>
            </div>
            <div class="offcanvas-body p-4">
                <ul class="navbar-nav justify-content-end flex-grow-1">
                    <li class="nav-item mt-3">
                        <a class="nav-link scroll-link" href="#cara_daftar" >Cara Mendaftar</a>
                    </li>
                </ul>
            <!-- Tombol Login -->
<form class="d-flex mt-3" role="search">
    <button type="button" class="btn btn-primary w-100 py-2" data-bs-toggle="modal" data-bs-target="#loginModal">
        Login
    </button>
</form>
            </div>
        </div>
    </div>

    <!-- Modal Pilihan Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title text-white" id="loginModalLabel">Pilih Login</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-4">Silakan pilih login sesuai peran Anda:</p>
        <div class="d-grid gap-3">
          <a href="{{ url('/auth/guru') }}" class="btn btn-outline-warning py-2">👨‍🏫 Login Sebagai Guru</a>
          <a href="{{ url('/auth/siswa') }}" class="btn btn-outline-success py-2">👩‍🎓 Login Sebagai Calon Siswa</a>
        </div>
      </div>
    </div>
  </div>
</div>
    <div class="dark-transparent sidebartoggler"></div>
    <!-- Import Js Files -->
    <script src="{{ url('assets/template/dist') }}/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('assets/template/dist') }}/assets/js/app.min.js"></script>
    <script src="{{ url('assets/template/dist') }}/assets/js/app.init.js"></script>
    <script src="{{ url('assets/template/dist') }}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('assets/template/dist') }}/assets/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="{{ url('assets/template/dist') }}/assets/js/sidebarmenu.js"></script>
    <script src="{{ url('assets/template/dist') }}/assets/js/theme.js"></script>
    <script src="{{ url('assets/template/dist') }}/assets/libs/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="{{ url('assets/template/dist') }}/assets/libs/aos/dist/aos.js"></script>
    <script src="{{ url('assets/template/dist') }}/assets/js/landingpage/landingpage.js"></script>
  </body>
<!-- Mirrored from bootstrapdemos.adminmart.com/modernize/dist/landingpage/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Feb 2024 06:22:57 GMT -->
</html>