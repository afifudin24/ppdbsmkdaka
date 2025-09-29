<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Green_Theme" data-layout="vertical">
  
<head>
    <!-- Required meta tags -->
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Favicon icon-->
<link
  rel="shortcut icon"
  type="image/png"
  href="{{ url('assets/files') }}/{{ $sekolah->favicon }}"
/>

<!-- Core Css -->
<link rel="stylesheet" href="{{ url('assets/template') }}/dist/assets/css/styles.css" />

    <title>{{ session()->get('role') }} | {{ $judul }}</title>
    <!-- Owl Carousel  -->
    <link
      rel="stylesheet"
      href="{{ url('assets/template') }}/dist/assets/libs/owl.carousel/dist/assets/owl.carousel.min.css"
    />
    <script src="{{ url('assets/template') }}/dist/assets/libs/jquery/dist/jquery.min.js"></script>

    <link rel="stylesheet" href="{{ url('assets/template') }}/dist/assets/libs/sweetalert2/dist/sweetalert2.min.css">
    <script src="{{ url('assets/template') }}/dist/assets/libs/sweetalert2/dist/sweetalert2.min.js"></script>
    {!! $plugins !!}
  </head>

  <body>
    <!-- Preloader -->
    <div class="preloader">
      <img
        src="{{ url('assets/files') }}/{{ $sekolah->favicon }}"
        alt="loader"
        class="lds-ripple img-fluid"
      />
    </div>

    <div id="main-wrapper">
        <!-- Sidebar Start -->
        <aside class="left-sidebar with-vertical">
            <div><!-- ---------------------------------- -->
            <!-- Start Vertical Layout Sidebar -->
            <!-- ---------------------------------- -->
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="" class="text-nowrap logo-img">
                        <img src="{{ url('assets/files') }}/{{ $sekolah->logo_dark }}" class="dark-logo" alt="Logo-Dark" style="width: 175px"/>
                        {{-- <img src="{{ url('assets/template') }}/dist/assets/images/logos/light-logo.png" class="light-logo" alt="Logo-light" style="width: 175px"/> --}}
                    </a>
                    <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none" >
                        <i class="ti ti-x"></i>
                    </a>
                </div>

                <!-- ---------------------------------- -->
                <!-- Sidebar -->
                <!-- ---------------------------------- -->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar>
                    <ul id="sidebarnav">
                        <!-- ---------------------------------- -->
                        <!-- Judul Menu -> Home -->
                        <!-- ---------------------------------- -->
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        @if (session()->get('role') == 'siswa')
                            @include('l-p-t.n-p-s')
                        @endif
                        @if (session()->get('role') == 'admin')
                            @php
                                // $user = $sekolah;
                                $user = session('user');
                            @endphp
                            @include('l-p-t.n-p-a')
                        @endif
                    </ul>
                </nav>
                <!-- ---------------------------------- -->
                <!-- End Sidebar -->
                <!-- ---------------------------------- -->
            </div>
        </aside>
        <!-- Sidebar End -->

        <!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->
        <div class="page-wrapper">
            <!--  Header Start -->
            <header class="topbar" style="box-shadow: rgba(145, 158, 171, 0.2) 0px 0px 2px 0px, rgba(145, 158, 171, 0.12) 0px 12px 24px -4px;">
                <div class="with-vertical"><!-- ---------------------------------- -->
                    <!-- Start Vertical Layout Header -->
                    <!-- ---------------------------------- -->
                    <nav class="navbar navbar-expand-lg p-0">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)" >
                                    <i class="ti ti-menu-2"></i>
                                </a>
                            </li>
                        </ul>

                        <div class="d-block d-lg-none">
                            <a href="" class="text-nowrap logo-img">
                                <img src="{{ url('assets/files') }}/{{ $sekolah->logo_dark }}" class="dark-logo" alt="Logo-Dark" style="width: 175px"/>
                                {{-- <img src="{{ url('assets/template') }}/dist/assets/images/logos/light-logo.png" class="light-logo" alt="Logo-light" style="width: 175px"/> --}}
                            </a>
                        </div>

                        <a class="navbar-toggler nav-icon-hover p-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="p-2">
                                <i class="ti ti-dots fs-7"></i>
                            </span>
                        </a>

                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <div class="d-flex align-items-center justify-content-between">
                                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false" >
                                            <div class="d-flex align-items-center">
                                                <div class="user-profile-img">
                                                    @if(empty($user->foto_profil))
                                                        <img src="{{ url('assets/files') }}/default.png" class="rounded-circle" width="35" height="35" alt="" />
                                                    @else
                                                    <img src="{{ url('assets/files') }}/{{ $user->foto }}" class="rounded-circle" width="35" height="35" alt="" />
                                                        @endif
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1" >
                                            <div class="profile-dropdown position-relative" data-simplebar>
                                                <div class="py-3 px-7 pb-0">
                                                    <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                                </div>
                                                <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                                   @if(empty($user->foto_profil))
                                                        <img src="{{ url('assets/files') }}/default.png" class="rounded-circle" width="35" height="35" alt="" />
                                                    @else
                                                    <img src="{{ url('assets/files') }}/{{ $user->foto }}" class="rounded-circle" width="35" height="35" alt="" />
                                                        @endif
                                                    <div class="ms-3">
                                                        <h5 class="mb-1 fs-3">{{ session('user')->nama}}</h5>
                                                        <span class="mb-1 d-block" style="text-transform: uppercase">{{ session()->get('role') }}</span>
                                                        <p class="mb-0 d-flex align-items-center gap-2">
                                                            @if(session()->get('role') == 'siswa')
                                                            <i class="ti ti-mail fs-4"></i>{{ session('user')->nik }}
                                                            @else
                                                            <i class="ti ti-mail fs-4"></i>{{ session('user')->email }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="message-body">
                                                    @if (session()->get('role') == 'siswa')
                                                        @php $link = url('/siswa/profile') @endphp
                                                    @else
                                                        @php $link = url('/admin/profile') @endphp
                                                    @endif
                                                    <a href="{{ $link }}" class="py-8 px-7 mt-8 d-flex align-items-center">
                                                        <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6" >
                                                            <img src="{{ url('assets/template') }}/dist/assets/images/svgs/icon-account.svg" alt="" width="24" height="24" />
                                                        </span>
                                                        <div class="w-75 d-inline-block v-middle ps-3">
                                                            <h6 class="mb-1 fs-3 fw-semibold lh-base">My Profile</h6>
                                                            <span class="fs-2 d-block text-body-secondary">Account Settings</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="d-grid py-4 px-7 pt-8">
                                                    <div class="upgrade-plan bg-primary-subtle position-relative overflow-hidden rounded-4 p-4 mb-9" >
                                                        <a href="{{ url('/logout') }}" class="btn btn-outline-primary logout" >Log Out</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- ------------------------------- -->
                                    <!-- end profile Dropdown -->
                                    <!-- ------------------------------- -->
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
            <!-- ---------------------------------- -->
            <!-- End Vertical Layout Header -->
            <!-- ---------------------------------- -->

            <div class="body-wrapper">
                <div class="container-fluid">

                    @yield('content')
                    
                </div>
            </div>

            <script>
                function handleColorTheme(e) {
                  $("html").attr("data-color-theme", e);
                  $(e).prop("checked", !0);
                }
              </script>

            <button class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="icon ti ti-settings fs-7"></i>
            </button>

            <div class="offcanvas customizer offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                    <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">
                    Settings
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" data-simplebar style="height: calc(100vh - 80px)">
                    <h6 class="fw-semibold fs-4 mb-2">Theme</h6>
                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check" name="theme-layout" id="light-layout" autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary" for="light-layout">
                            <i class="icon ti ti-brightness-up fs-7 me-2"></i>Light
                        </label>
                        <input type="radio" class="btn-check" name="theme-layout" id="dark-layout" autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary" for="dark-layout">
                            <i class="icon ti ti-moon fs-7 me-2"></i>Dark
                        </label>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Direction</h6>
                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check" name="direction-l" id="ltr-layout" autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary" for="ltr-layout">
                            <i class="icon ti ti-text-direction-ltr fs-7 me-2"></i>LTR
                        </label>
                        <input type="radio" class="btn-check" name="direction-l" id="rtl-layout" autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary" for="rtl-layout">
                            <i class="icon ti ti-text-direction-rtl fs-7 me-2"></i>RTL
                        </label>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Colors</h6>
                    <div class="d-flex flex-row flex-wrap gap-3 customizer-box color-pallete" role="group">

                        <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme" autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Blue_Theme')"  for="Blue_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="BLUE_THEME">
                                <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-1">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout"  id="Aqua_Theme" autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Aqua_Theme')" for="Aqua_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="AQUA_THEME">
                                <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-2">
                                    <i class="ti ti-check text-white d-flex icon fs-5"></i>
                                </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme" autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Purple_Theme')"for="Purple_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="PURPLE_THEME">
                            <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-3">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i> 
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="green-theme-layout" autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Green_Theme')"for="green-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="GREEN_THEME">
                            <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-4">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout" autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Cyan_Theme')" for="cyan-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="CYAN_THEME">
                            <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-5">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                        <input type="radio" class="btn-check" name="color-theme-layout" id="orange-theme-layout" autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Orange_Theme')" for="orange-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ORANGE_THEME">
                            <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-6">
                                <i class="ti ti-check text-white d-flex icon fs-5"></i>
                            </div>
                        </label>

                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Layout Type</h6>
                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <div>
                            <input type="radio" class="btn-check" name="page-layout" id="vertical-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="vertical-layout">
                                <i class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Vertical
                            </label>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout" autocomplete="off" />
                            <label class="btn p-9 btn-outline-primary" for="horizontal-layout">
                                <i class="icon ti ti-layout-navbar fs-7 me-2"></i>Horizontal
                            </label>
                        </div>
                    </div>

                    <h6 class="mt-5 fw-semibold fs-4 mb-2">Container Option</h6>
                    <div class="d-flex flex-row gap-3 customizer-box" role="group">
                        <input type="radio" class="btn-check" name="layout" id="boxed-layout" autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary" for="boxed-layout">
                            <i class="icon ti ti-layout-distribute-vertical fs-7 me-2"></i>Boxed
                        </label>
                        <input type="radio" class="btn-check" name="layout" id="full-layout" autocomplete="off" />
                        <label class="btn p-9 btn-outline-primary" for="full-layout">
                            <i class="icon ti ti-layout-distribute-horizontal fs-7 me-2"></i>Full
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dark-transparent sidebartoggler"></div>
    
    <!-- Import Js Files -->
    <script src="{{ url('assets/template') }}/dist/assets/js/app.min.js"></script>
    <script src="{{ url('assets/template') }}/dist/assets/js/app.init.js"></script>
    <script src="{{ url('assets/template') }}/dist/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('assets/template') }}/dist/assets/libs/simplebar/dist/simplebar.min.js"></script>

    <script src="{{ url('assets/template') }}/dist/assets/js/sidebarmenu.js"></script>
    <script src="{{ url('assets/template') }}/dist/assets/js/theme.js"></script>
    <script src="{{ url('assets/template') }}/dist/assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
    <script>
        $('.logout').click(function (e) {
            e.preventDefault();
            var link = $(this).attr('href');
            Swal.fire({
                title: "Anda Yakin?",
                text: "anda harus login ulang untuk kembali!",
                icon: "warning",
                showCancelButton: true,
                // confirmButtonColor: "#3085d6",
                // cancelButtonColor: "#d33",
                confirmButtonText: "Ya, logout!",
                cancelButtonText: "Tidak!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = link
                }
            });
        });
    </script>
  </body>

</html>
