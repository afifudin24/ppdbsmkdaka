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
                                <a class="text-muted text-decoration-none" href="{{ url('/admin/pendaftaran') }}">Pendaftaran</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/admin/pendaftaran') }}/{{ $pendaftaran->id }}">Detail Pendaftaran</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Form Pendaftaran Siswa</li>
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
            <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Data Calon Siswa</h5>
                    <div class="row mt-3">
                        <div class="col-lg-2">
                            <img src="{{ url('/assets/files') }}/{{ $pendaftaran_siswa->siswa->foto }}" alt="" class="img-fluid" style="width: 100%">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <table border="0" cellpadding="4">
                                <tr>
                                    <th style="vertical-align: top !important;">Nama</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->nama }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Jenis Kelamin</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">NISN</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->nisn }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">NIS</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->nis }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">No. Registrasi</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->no_regis }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Jurusan Dipilih</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->jurusan }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-4">
                            <table border="0" cellpadding="4">
                                <tr>
                                    <th style="vertical-align: top !important;">No. registrasi</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->no_regis }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Tempat Lahir</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->tempat_lahir }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Tanggal Lahir</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->tgl_lahir }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Agama</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->agama }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Anak Ke</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->anak_ke }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Jumlah Saudara</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->jumlah_saudara }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-4">
                            <table border="0" cellpadding="4">
                                <tr>
                                    <th style="vertical-align: top !important;">Hobi</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->hobi }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Cita - Cita</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->cita_cita }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">No. Hp/Telepon</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->tgl_lahir }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Alamat Email</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->email }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Password Login</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->password }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <h5 class="card-title fw-semibold">Data Alamat</h5>
                    <div class="row">
                        <div class="col-lg-4">
                            <table border="0" cellpadding="4">
                                <tr>
                                    <th style="vertical-align: top !important;">Jenis Tempat Tinggal</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->jenis_tempat_tinggal }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Alamat</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->alamat }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Desa</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->desa }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Kecamatan</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->kecamatan }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Kabupaten</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->kabupaten }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Provinsi</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->provinsi }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table border="0" cellpadding="4">
                                <tr>
                                    <th style="vertical-align: top !important;">Kode Pos</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->pos }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Jarak Dari Rumah</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->jarak }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Transportasi</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->transportasi }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <h5 class="card-title fw-semibold">Data Orangtua/Wali</h5>
                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <table border="0" cellpadding="4">
                                <tr>
                                    <th style="vertical-align: top !important;">No KK</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->no_kk }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Kepala Keluarga</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->kepala_kk }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Nama Ayah/Wali</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->nama_ayah }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">NIK Ayah/Wali</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->nik_ayah }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Tahun Lahir Ayah/Wali</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->tahun_lahir_ayah }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Penghasilan Ayah/Wali</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->penghasilan_ayah }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Pendidikan Ayah/Wali</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->pendidikan_ayah }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-4">
                            <table border="0" cellpadding="4">
                                <tr>
                                    <th style="vertical-align: top !important;">Nama Ibu/Wali</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->nama_ibu }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">NIK Ibu/Wali</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->nik_ibu }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Tahun Lahir Ibu/Wali</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->tahun_lahir_ibu }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Penghasilan Ibu/Wali</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->penghasilan_ibu }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Pendidikan Ibu/Wali</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->pendidikan_ibu }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <h5 class="card-title fw-semibold">Data Sekolah Asal</h5>
                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <table border="0" cellpadding="4">
                                <tr>
                                    <th style="vertical-align: top !important;">Nama Sekolah</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->sekolah_asal }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">Jenjang Sekolah</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->jenjang_sekolah }}</td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top !important;">NPSN Sekolah</th>
                                    <td style="vertical-align: top !important;"> : </td>
                                    <td style="vertical-align: top !important;">{{ $pendaftaran_siswa->siswa->npsn_sekolah }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>
                    <a href="{{ url('/admin/pendaftaran') }}/{{ $pendaftaran->id }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>

      {!! session('pesan') !!}
      <script>
        $("#zero_config").DataTable();

        $('.hapus').click(function (e) {
            e.preventDefault();
            var tombol_ini = $(this);
            Swal.fire({
                title: "Anda Yakin?",
                text: "data yang dihapus tidak dapat kembali!",
                icon: "warning",
                showCancelButton: true,
                // confirmButtonColor: "#3085d6",
                // cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Tidak!"
            }).then((result) => {
                if (result.isConfirmed) {
                    tombol_ini.parent('form').submit();
                }
            });
        });

      </script>

@endsection