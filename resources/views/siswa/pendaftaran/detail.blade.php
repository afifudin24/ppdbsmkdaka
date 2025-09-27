@extends('l-p-t.m-p')
@section('content')
    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Detail Pendaftaran</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/siswa') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/siswa/pendaftaran') }}">Pendaftaran</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Detail Pendaftaran</li>
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
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="mb-0 text-center">BUKTI PENDAFTARAN</h4>
                    </div>

                    <img src="{{ url('/assets/files') }}/{{ $user->foto }}" alt="Profile" class="img-thumbnail" style="width: 200px;">

                    <table border="0" cellpadding="5" class="mt-4">
                        <tr>
                            <th>NO REGISTRASI</th>
                            <td style="width: 20px;"></td>
                            <td> : {{ $user->no_regis }}</td>
                        </tr>
                        <tr>
                            <th>TGL PENDAFTARAN</th>
                            <td style="width: 20px;"></td>
                            <td> : {{ $detail_pendaftaran->created_at }}</td>
                        </tr>
                        <tr>
                            <th>NISN</th>
                            <td style="width: 20px;"></td>
                            <td> : {{ $user->nisn }}</td>
                        </tr>
                        <tr>
                            <th>NIS</th>
                            <td style="width: 20px;"></td>
                            <td> : {{ $user->nis }}</td>
                        </tr>
                        <tr>
                            <th>NAMA LENGKAP</th>
                            <td style="width: 20px;"></td>
                            <td> : {{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <th>JENIS KELAMIN</th>
                            <td style="width: 20px;"></td>
                            <td> : {{ $user->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <th>TEMPAT, TANGGAL LAHIR</th>
                            <td style="width: 20px;"></td>
                            <td> : {{ $user->tempat_lahir }} {{ $user->tgl_lahir }}</td>
                        </tr>
                        <tr>
                            <th>AGAMA</th>
                            <td style="width: 20px;"></td>
                            <td> : {{ $user->agama }}</td>
                        </tr>
                        <tr>
                            <th>NAMA ORANGTUA / WALI</th>
                            <td style="width: 20px;"></td>
                            <td> : </td>
                        </tr>
                        <tr>
                            <th style="text-align: center">AYAH</th>
                            <td style="width: 20px;"></td>
                            <td> : {{ $user->nama_ayah }}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center">IBU</th>
                            <td style="width: 20px;"></td>
                            <td> : {{ $user->nama_ibu }}</td>
                        </tr>
                        <tr>
                            <th>NO. TELEPON/HP</th>
                            <td style="width: 20px;"></td>
                            <td> : {{ $user->hp }}</td>
                        </tr>
                        <tr>
                            <th>ALAMAT EMAIL</th>
                            <td style="width: 20px;"></td>
                            <td> : {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>ASAL SEKOLAH</th>
                            <td style="width: 20px;"></td>
                            <td> : {{ $user->sekolah_asal }}</td>
                        </tr>
                    </table>
                    <a href="{{ url('/siswa/pendaftaran') }}" class="btn btn-danger mt-3">Kembali</a>
                    <span class="text-white">-</span>
                    <a href="{{ url('/siswa/cetak_pendaftaran') }}/{{ $pendaftaran->id }}" class="btn btn-success mt-3" target="_blank"><i class="fas fa-print"></i> Cetak</a>
                </div>
            </div>
        </div>
    </div>
@endsection