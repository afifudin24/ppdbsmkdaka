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
  href="{{ url('assets/files') }}/{{ $sekolah->favicon}}"
/>

<!-- Core Css -->
<link rel="stylesheet" href="{{ url('assets/template') }}/dist/assets/css/styles.css" />

    <title>{{ $judul }}</title>
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
        
        <div class="">
            <!--  Header Start -->
            <header class="topbar" style="width: 100% !important; box-shadow: rgba(145, 158, 171, 0.2) 0px 0px 2px 0px, rgba(145, 158, 171, 0.12) 0px 12px 24px -4px;">
                <div class="with-vertical ">
                    <!-- Start Vertical Layout Header -->
                    <!-- ---------------------------------- -->
                    <nav class="navbar navbar-expand-lg p-0 ">
                       

                        <div class="d-block">
                            <a href="" class="text-nowrap logo-img">
                                <img src="{{ url('assets/files') }}/{{ $sekolah->logo_dark }}" class="dark-logo" alt="Logo-Dark" style="width: 175px"/>
                                {{-- <img src="{{ url('assets/template') }}/dist/assets/images/logos/light-logo.png" class="light-logo" alt="Logo-light" style="width: 175px"/> --}}
                            </a>
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
