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
                                <a class="text-muted text-decoration-none" href="{{ url('/siswa') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Data Pendaftaran</li>
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
                    <h5 class="card-title fw-semibold">Edit Foto Profile</h5>
                    <div class="text-center">
                        <img src="{{ url('assets/files') }}/{{ $user->foto }}" alt="" class="img-fluid rounded-circle" width="120" height="120">
                        <div class="d-flex align-items-center justify-content-center my-4 gap-6">
                            <form action="{{ url('/siswa/edit_foto') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <input type="file" name="foto" id="foto" class="form-control" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-success" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;">Upload</button>
                                    </div>
                                </div>
                                <input type="hidden" name="foto_lama" value="{{ $user->foto }}">
                            </form>
                        </div>
                        <p class="mb-0">file yang didukung JPG,PNG</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Edit Akun</h5>
                    <form action="{{ url('/siswa/profile') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password" value="{{ $user->password }}" required>
                        </div>
                        <button class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {!! session('pesan') !!}
@endsection