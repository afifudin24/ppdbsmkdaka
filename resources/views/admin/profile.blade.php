@extends('l-p-t.m-p')
@section('content')
    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Profile Sekolah</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/admin') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Profile Sekolah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6">
            <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Edit Logo Sekolah</h5>
                    <div class="text-center">
                        <img src="{{ url('assets/files') }}/{{ $sekolah->foto }}" alt="" class="img-fluid" style="height: 200px">
                        <div class="d-flex align-items-center justify-content-center my-4 gap-6">
                            <form action="{{ url('/admin/profile/foto') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $sekolah->id }}">
                                <div class="input-group">
                                    <input type="file" name="foto" id="foto" class="form-control" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-success" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;">Upload</button>
                                    </div>
                                </div>
                                <input type="hidden" name="foto_lama" value="{{ $sekolah->foto }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Edit Akun</h5>
                    <form action="{{ url('/admin/profile/akun') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $sekolah->id }}">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $sekolah->username }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password" value="{{ $sekolah->password }}" required>
                        </div>
                        <button class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Edit Informasi Sekolah</h5>
                    <form action="{{ url('/admin/profile/info') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $sekolah->id }}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Sekolah</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $sekolah->nama }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kepsek" class="form-label">Nama Kepala sekolah</label>
                                    <input type="text" class="form-control" id="kepsek" name="kepsek" value="{{ $sekolah->kepsek }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kepsek" class="form-label">NIP Kepala sekolah</label>
                                    <input type="text" class="form-control" id="kepsek" name="nip_kepsek" value="{{ $sekolah->nip_kepsek }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ttd_kepsek" class="form-label">TTD Kepala Sekolah</label>
                                    <br>
                                    <img src="{{ url('assets/files') }}/{{ $sekolah->ttd_kepsek }}" class="img-thumbnail" alt="logo dark" style="width: 150px;">
                                    <br>
                                    <br>
                                    <input type="hidden" name="ttd_kepsek_lama" value="{{ $sekolah->ttd_kepsek }}">
                                    <input type="file" class="form-control" id="ttd_kepsek" name="ttd_kepsek" accept=".jpg, .png">
                                </div>
                                <div class="mb-3">
                                    <label for="panitia" class="form-label">Ketua Panitia PPDB</label>
                                    <input type="text" class="form-control" id="panitia" name="panitia" value="{{ $sekolah->panitia }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nip_panitia" class="form-label">NIP Ketua Panitia PPDB</label>
                                    <input type="text" class="form-control" id="nip_panitia" name="nip_panitia" value="{{ $sekolah->nip_panitia }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ttd_panitia" class="form-label">TTD Ketua Panitia</label>
                                    <br>
                                    <img src="{{ url('assets/files') }}/{{ $sekolah->ttd_panitia }}" class="img-thumbnail" alt="logo dark" style="width: 150px;">
                                    <br>
                                    <br>
                                    <input type="hidden" name="ttd_panitia_lama" value="{{ $sekolah->ttd_panitia }}">
                                    <input type="file" class="form-control" id="ttd_panitia" name="ttd_panitia" accept=".jpg, .png">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat Sekolah</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $sekolah->alamat }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="website" class="form-label">Telpon Sekolah</label>
                                    <input type="text" class="form-control" id="telpon" name="telpon" value="{{ $sekolah->telpon }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="website" class="form-label">Website Sekolah</label>
                                    <input type="text" class="form-control" id="website" name="website" value="{{ $sekolah->website }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Sekolah</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ $sekolah->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="logo_dark" class="form-label">Logo</label>
                                    <br>
                                    <img src="{{ url('assets/files') }}/{{ $sekolah->logo_dark }}" class="img-thumbnail" alt="logo dark" style="width: 175px;">
                                    <br>
                                    <br>
                                    <input type="hidden" name="logo_dark_lama" value="{{ $sekolah->logo_dark }}">
                                    <input type="file" class="form-control" id="logo_dark" name="logo_dark" accept=".jpg, .png">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {!! session('pesan') !!}
@endsection