@extends('l-p-t.m-p')
@section('content')
    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Edit Pendaftaran</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/siswa') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/siswa/pendaftaran') }}">Pendaftaran</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Edit Pendaftaran</li>
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

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body wizard-content">
                  <h4 class="card-title">Edit Form Pendaftaran</h4>
                  <p class="card-subtitle mb-3"> Pastikan data yang diisi valid atau sesuai </p>
                  <form action="{{ url('/siswa/pendaftaran_edit') }}/{{ $pendaftaran->id }}" class="validation-wizard wizard-circle mt-5" id="form-pendaftaran" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Step 1 sampe email -->
                    <h6>Data Siswa</h6> 
                    <section>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="no_regis"> No Registrasi :
                            </label>
                            <input type="text" class="form-control" id="no_regis" name="no_regis" readonly value="{{ $user->no_regis }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="nama"> Nama : <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control required" id="nama" name="nama" value="{{ $user->nama }}"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="nisn"> NISN : <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control required" id="nisn" name="nisn" value="{{ $user->nisn }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="nis">NIS :</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control required" id="nis" name="nis" value="{{ $user->nis }}"/>
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
                                <option value="{{ $j->nama }}" {{ ($user->jurusan == $j->nama) ? 'selected' : ''; }}>{{ $j->nama }}</option>
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
                              <option value="Laki - Laki" {{ ($user->jenis_kelamin == 'Laki - Laki') ? 'selected' : ''; }}>Laki - Laki</option>
                              <option value="Perempuan" {{ ($user->jenis_kelamin == 'Perempuan') ? 'selected' : ''; }}>Perempuan</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="tempat_lahir"> Tempat Lahir : <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control required" id="tempat_lahir" name="tempat_lahir" value="{{ $user->tempat_lahir }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="tgl_lahir">Tanggal Lahir :</label> <span class="text-danger">*</span>
                            <input type="date" class="form-control required" id="tgl_lahir" name="tgl_lahir" value="{{ $user->tgl_lahir }}"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="agama"> Agama : <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control required" id="agama" name="agama" value="{{ $user->agama }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="anak_ke">Anak Ke :</label> <span class="text-danger">*</span>
                            <input type="number" class="form-control required" id="anak_ke" name="anak_ke" value="{{ $user->anak_ke }}"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="jumlah_saudara"> Jumlah Saudara : <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control required" id="jumlah_saudara" name="jumlah_saudara" value="{{ $user->jumlah_saudara }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="hobi">Hobi :</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control required" id="hobi" name="hobi" value="{{ $user->hobi }}"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="cita_cita"> Cita Cita : <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control required" id="cita_cita" name="cita_cita" value="{{ $user->cita_cita }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="hp">No HP :</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control required" id="hp" name="hp" value="{{ $user->hp }}"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="email"> Email : <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control required" id="email" name="email" value="{{ $user->email }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="foto"> Foto :
                            </label>
                            <input type="hidden" name="foto_lama" value="{{ $user->foto }}">
                            <input type="file" class="form-control" id="foto" name="foto" accept=".jpg, .png"/>
                          </div>
                        </div>
                      </div>
                    </section>
                    <!-- Step 2 sampe transportasi -->
                    <h6>Data Alamat</h6>
                    <section>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="jenis_tempat_tinggal">Jenis Tempat Tinggal : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="jenis_tempat_tinggal" name="jenis_tempat_tinggal"  value="{{ $user->jenis_tempat_tinggal }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="alamat">Alamat :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="alamat" name="alamat" value="{{ $user->alamat }}"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="desa">Desa : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="desa" name="desa"  value="{{ $user->desa }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="kecamatan">Kecamatan :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="kecamatan" name="kecamatan" value="{{ $user->kecamatan }}"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="kabupaten">Kabupaten : <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="kabupaten" name="kabupaten"  value="{{ $user->kabupaten }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="provinsi">Provinsi :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="provinsi" name="provinsi" value="{{ $user->provinsi }}"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="pos">Kode Pos : <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required" id="pos" name="pos"  value="{{ $user->pos }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="jarak">Jarak dari Rumah :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="jarak" name="jarak" value="{{ $user->jarak }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="transportasi">Transportasi :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="transportasi" name="transportasi" value="{{ $user->transportasi }}"/>
                          </div>
                        </div>
                      </div>
                    </section>
                    <!-- Step 3 sampe pendidikan ibu-->
                    <h6>Data Orang Tua / Wali</h6>
                    <section>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="no_kk">No KK :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="no_kk" name="no_kk" value="{{ $user->no_kk }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="kepala_kk">Kepala keluarga :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="kepala_kk" name="kepala_kk" value="{{ $user->kepala_kk }}"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="nama_ayah">Nama Ayah/Wali :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="nama_ayah" name="nama_ayah" value="{{ $user->nama_ayah }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="nik_ayah">NIK Ayah/Wali :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="nik_ayah" name="nik_ayah" value="{{ $user->nik_ayah }}"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="tahun_lahir_ayah">Thn Lahir Ayah/Wali :  <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required" id="tahun_lahir_ayah" name="tahun_lahir_ayah" value="{{ $user->tahun_lahir_ayah }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="pekerjaan_ayah">Pekerjaan Ayah/Wali :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ $user->pekerjaan_ayah }}"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="penghasilan_ayah">Penghasilan Ayah/Wali :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="penghasilan_ayah" name="penghasilan_ayah" value="{{ $user->penghasilan_ayah }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="pendidikan_ayah">Pendidikan Ayah/Wali :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="pendidikan_ayah" name="pendidikan_ayah" value="{{ $user->pendidikan_ayah }}"/>
                          </div>
                        </div>
                      </div>
                      {{-- IBU/WALI --}}
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="nama_ibu">Nama Ibu/Wali :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="nama_ibu" name="nama_ibu" value="{{ $user->nama_ibu }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="nik_ibu">NIK Ibu/Wali :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="nik_ibu" name="nik_ibu" value="{{ $user->nik_ibu }}"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="tahun_lahir_ibu">Thn Lahir Ibu/Wali :  <span class="text-danger">*</span></label>
                            <input type="number" class="form-control required" id="tahun_lahir_ibu" name="tahun_lahir_ibu" value="{{ $user->tahun_lahir_ibu }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="pekerjaan_ibu">Pekerjaan Ibu/Wali :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ $user->pekerjaan_ibu }}"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="penghasilan_ibu">Penghasilan Ibu/Wali :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="penghasilan_ibu" name="penghasilan_ibu" value="{{ $user->penghasilan_ibu }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="pendidikan_ibu">Pendidikan Ibu/Wali :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="pendidikan_ibu" name="pendidikan_ibu" value="{{ $user->pendidikan_ibu }}"/>
                          </div>
                        </div>
                      </div>
                    </section>
                    <!-- Step 4 -->
                    <h6>Data Sekolah</h6>
                    <section>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="sekolah_asal">Asal Sekolah :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="sekolah_asal" name="sekolah_asal" value="{{ $user->sekolah_asal }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="jenjang_sekolah">Jenjang Sekolah : </label>
                            <input type="text" class="form-control" id="jenjang_sekolah" name="jenjang_sekolah" value="{{ $user->jenjang_sekolah }}"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="npsn_sekolah">NPSN Sekolah :  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="npsn_sekolah" name="npsn_sekolah" value="{{ $user->npsn_sekolah }}"/>
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