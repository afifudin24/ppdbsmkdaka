@extends('l-p-t.m-p')
@section('content')
    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Input Pendaftaran</h4>
                </div>
                {{-- <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ url('assets/template') }}/dist/assets/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body wizard-content">
                
                  <p class="card-subtitle mb-3"> Pastikan data yang diisi valid atau sesuai dengan ketentuan </p>
                  {{-- Alert Error Validasi --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan!</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                  <form action="{{ url('/siswa/pendaftaran') }}" class="validation-wizard wizard-circle mt-5" id="form-pendaftaran" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Step 1 sampe email -->
                    <h6>Data Siswa</h6> 
                    <section>
                      <div class="row">
                      
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="nama"> Nama : <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control required" id="nama" name="nama"/>
                          </div>
                        </div>
                      <input  type="hidden" disabled 
       name="referral_id" 
       value="{{ session('user')->id ?? '' }}" 
       class="form-control">

                         <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="nik">NIK :</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control required" id="nik" name="nik"/>
                          </div>
                        </div>
                      </div>
                     
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="jurusan"> Jurusan : <span class="text-danger">*</span>
                            </label>
                            <select class="form-select required" id="jurusan" name="jurusan">
                              <option value="">Pilih</option>
                              @foreach ($jurusan as $j)
                              <option value="{{ $j->nama }}">{{ $j->nama }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="jenis_kelamin"> Jenis Kelamin : <span class="text-danger">*</span>
                            </label>
                            <select class="form-select required" id="jenis_kelamin" name="jenis_kelamin">
                              <option value="">Pilih</option>
                              <option value="L">Laki - Laki</option>
                              <option value="P" >Perempuan</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="tempat_lahir"> Tempat Lahir : <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control required" id="tempat_lahir" name="tempat_lahir"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="tgl_lahir">Tanggal Lahir :</label> <span class="text-danger">*</span>
                            <input type="date" class="form-control required" id="tgl_lahir" name="tgl_lahir"/>
                          </div>
                        </div>
                      </div>
                      {{-- <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="agama"> Agama : <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control required" id="agama" name="agama"/>
                          </div>
                        </div>
                       
                      </div> --}}
                     
                      <div class="row">
                     
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="hp">No HP :</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control required" id="hp" name="hp" placeholder="628xxxxxxxxx"/>
                          </div>
                        </div>
                         <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="agama">Agama :</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control required" id="agama" name="agama" placeholder="Islam"/>
                          </div>
                        </div>
                      </div>
                    
                    </section>
                    <!-- Step 2 sampe transportasi -->
                    <h6>Data Alamat</h6>
                    <section>
                      <div class="row">
                     
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label" for="alamat">Alamat :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="alamat" name="alamat" />
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="desa">Desa : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="desa" name="desa"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="kecamatan">Kecamatan :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="kecamatan" name="kecamatan"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="kabupaten">Kabupaten : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="kabupaten" name="kabupaten"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="provinsi">Provinsi :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="provinsi" name="provinsi"/>
                          </div>
                        </div>
                      </div>
                
                    </section>
                    <!-- Step 3 sampe pendidikan ibu-->
                    <h6>Data Lainnya</h6>
                    <section>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="no_kk">No KK :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="no_kk" name="no_kk"/>
                          </div>
                        </div>
                      
                         <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="sekolah_asal">Asal Sekolah :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="sekolah_asal" name="sekolah_asal"/>
                          </div>
                        </div>
                    
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="nama_ayah">Nama Ayah/Wali :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="nama_ayah" name="nama_ayah"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="nama_ibu">Nama Ibu/Wali :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="nama_ibu" name="nama_ibu"/>
                          </div>
                        </div>
                     
                      </div>
                   
                    </section>
                       <!-- Step 4 Dokumen-->
                    <h6>Lampiran Dokumen</h6>
                    <section>
                      <div class="row">
                         <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="foto"> Foto Diri : (Opsional)
                            </label>
                            
                            <input type="file" class="form-control" id="foto" name="foto" accept=".jpg, .png"/>
                          </div>
                        </div>
                      
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="kk"> Foto Kartu Keluarga : <span class="text-danger">*</span>
                            </label>
                   
                            <input type="file" required class="form-control" id="kk" name="kk" accept=".jpg, .png"/>
                          </div>
                        </div>
                    
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="akta"> Foto Akta Kelahiran : <span class="text-danger">*</span>
                            </label>
                       
                            <input type="file" class="form-control" required id="akta" name="akta" accept=".jpg, .png"/>
                          </div>
                        </div>
                     <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="kip"> KIP : (Jika Ada)
                            </label>
                            <input type="file" required class="form-control" id="kip" name="kip" accept=".jpg, .png"/>
                          </div>
                        </div>
                     
                      </div>
                   
                    
                
                  
                    </section>
                
                  </form>
                </div>
              </div>
        </div>
    </div>
    <script src="{{ url('assets/template') }}/dist/assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="{{ url('assets/template') }}/dist/assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
    {{-- <script src="{{ url('assets/template') }}/dist/assets/js/forms/form-wizard.js"></script> --}}
    <script>
      var form = $(".validation-wizard").show();
      $(".validation-wizard").steps({
          headerTag: "h6",
          bodyTag: "section",
          transitionEffect: "fade",
          titleTemplate: '<span class="step">#index#</span> #title#',
          labels: {
              finish: "Submit",
          },
          onStepChanging: function (event, currentIndex, newIndex) {
              return (
                  currentIndex > newIndex ||
                  (!(3 === newIndex && Number($("#age-2").val()) < 18) &&
                      (currentIndex < newIndex &&
                          (form.find(".body:eq(" + newIndex + ") label.error").remove(),
                              form.find(".body:eq(" + newIndex + ") .error").removeClass("error")),
                          (form.validate().settings.ignore = ":disabled,:hidden"),
                          form.valid()))
              );
          },
          onFinishing: function (event, currentIndex) {
              return (form.validate().settings.ignore = ":disabled"), form.valid();
          },
          onFinished: function (event, currentIndex) {
            Swal.fire({
                title: "Are you sure?",
                text: "Pastikan data yang di input sudah valid atau sesuai!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Kirim!",
                cancelButtonText: "Nanti"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-pendaftaran').submit();
                }
            });
          },
      }),
          $(".validation-wizard").validate({
              ignore: "input[type=hidden]",
              errorClass: "text-danger",
              successClass: "text-success",
              highlight: function (element, errorClass) {
                  $(element).removeClass(errorClass);
              },
              unhighlight: function (element, errorClass) {
                  $(element).removeClass(errorClass);
              },
              errorPlacement: function (error, element) {
                  error.insertAfter(element);
              },
              rules: {
                  email: {
                      email: !0,
                  },
              },
          });
    </script>
@endsection