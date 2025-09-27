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
                                <a class="text-muted text-decoration-none" href="{{ url('/admin') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-lg-4 col-xl-2">
            <a href="{{ url('/admin/siswa') }}" class="p-4 text-center bg-primary-subtle card shadow-none rounded-2">
                <img src="{{ url('assets/template') }}/dist/assets/images/svgs/icon-user-male.svg" width="50" height="50" class="mb-6 mx-auto" alt="">
                <p class="fw-semibold text-primary mb-1">Calon Siswa</p>
                <h4 class="fw-semibold text-primary mb-0">{{ $data_siswa->count() }}</h4>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 col-xl-2">
            <a href="{{ url('/admin/pendaftaran') }}" class="p-4 text-center bg-warning-subtle card shadow-none rounded-2">
                <img src="{{ url('assets/template') }}/dist/assets/images/svgs/icon-briefcase.svg" width="50" height="50" class="mb-6 mx-auto" alt="">
                <p class="fw-semibold text-warning mb-1">Pendaftaran</p>
                <h4 class="fw-semibold text-warning mb-0">{{ $data_pendaftaran->count() }}</h4>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 col-xl-2">
            <a href="{{ url('/admin/pendaftaran') }}" class="p-4 text-center bg-info-subtle card shadow-none rounded-2">
                <img src="{{ url('assets/template') }}/dist/assets/images/svgs/icon-account.svg" width="50" height="50" class="mb-6 mx-auto" alt="">
                <p class="fw-semibold text-info mb-1">Lulus</p>
                <h4 class="fw-semibold text-info mb-0">{{ $total_lulus->count() }}</h4>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 col-xl-2">
            <a href="{{ url('/admin/pendaftaran') }}" class="p-4 text-center bg-danger-subtle card shadow-none rounded-2">
                <img src="{{ url('assets/template') }}/dist/assets/images/svgs/icon-account.svg" width="50" height="50" class="mb-6 mx-auto" alt="">
                <p class="fw-semibold text-danger mb-1">Tidak Lulus</p>
                <h4 class="fw-semibold text-danger mb-0">{{ $total_tidak_lulus->count() }}</h4>
            </a>
        </div>
    </div>
@endsection