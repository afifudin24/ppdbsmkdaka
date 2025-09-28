
<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

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
<link rel="stylesheet" href="{{ url('assets/template') }}/dist/assets/libs/sweetalert2/dist/sweetalert2.min.css">

  <title>Login Guru | SPMB ONLINE DAKA</title>
</head>

<body>
  <!-- Preloader -->
  <div class="preloader">
    <img src="{{ url('assets/files') }}/{{ $sekolah->favicon}}" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <div id="main-wrapper">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
      <div class="position-relative z-index-5">
        <div class="row">
          <div class="col-xl-7 col-xxl-8">
            <a href="{{ url('/') }}" class="text-nowrap logo-img d-block px-4 py-9 w-100">
              <img src="{{ url('assets/files') }}/{{ $sekolah->logo_dark }}" style="width: 150px;" class="dark-logo" alt="Logo-Dark" />
              {{-- <img src="{{ url('assets/template/dist') }}/assets/images/logos/light-logo.png" style="width: 150px;" class="light-logo" alt="Logo-light" /> --}}
            </a>
            <div class="d-none d-xl-flex align-items-center justify-content-center" style="height: calc(100vh - 80px);">
              <img src="{{ url('assets/template/dist') }}/assets/images/backgrounds/login-security.svg" alt="" class="img-fluid" width="500">
            </div>
          </div>
          <div class="col-xl-5 col-xxl-4">
            <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
              <div class="auth-max-width col-sm-8 col-md-6 col-xl-7 px-4">
                <h2 class="mb-1 fs-7 fw-bolder">Selamat Datang di SPMB ONLINE</h2>
                <p class="mb-6">Silahkan Log in</p>
                <form action="{{ url('/auth/login') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="email" class="form-label">Username (namalengkap)</label>
                    <input type="text" placeholder="contoh: afifwaliyudinkeren" class="form-control" id="username" name="username" aria-describedby="username" required>
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password (tahun-bulan-tanggal lahir)</label>
                    <input type="password" placeholder="yyyy-mm-dd contoh: 2000-01-01" class="form-control" id="password" name="password" required>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <a class="text-primary fw-medium fs-3" href="">Lupa Password?</a>
                  </div>
                  <button type="submit" class="btn btn-success w-100 py-8 mb-4 rounded-2">Log In</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-medium">Belum daftar?</p>
                    <a class="text-primary fw-medium ms-2" href="{{ url('/inputdaftar') }}">Daftar Disini</a>
                  </div>
                </form>
              </div>
            </div>
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
<script src="{{ url('assets/template') }}/dist/assets/libs/sweetalert2/dist/sweetalert2.min.js"></script>
{!! session('pesan') !!}
</body>

</html>