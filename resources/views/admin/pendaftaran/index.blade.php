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
                                <a class="text-muted text-decoration-none" href="{{ url('/admin') }}">Master Data</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Pendaftaran</li>
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
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="mb-0">Data Pendaftaran</h5>
                    </div>
                    <p class="card-subtitle mb-3">
                        List data-data gelombang pendaftaran
                    </p>
                    <button class="btn me-1 mb-1 bg-primary-subtle text-primary px-4 fs-4 font-medium" data-bs-toggle="modal" data-bs-target="#modal-tambah-pendaftaran">
                        Tambah Data
                    </button>

                    {{-- Modal Tambah --}}
                    <div class="modal fade" id="modal-tambah-pendaftaran" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header d-flex align-items-center">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Tambah Pendaftaran
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('/admin/pendaftaran') }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="tahun_angkatan">Tahun Angkatan : </label>
                                                <input type="number" class="form-control" name="tahun_angkatan" id="tahun_angkatan" required>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="gelombang">Gelombang Ke : </label>
                                                <input type="number" class="form-control" name="gelombang" id="gelombang" required min="1">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="kuota">Kuota Pendaftaran : </label>
                                                <input type="number" class="form-control" name="kuota" id="kuota" required min="1">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn bg-success-subtle text-success font-medium waves-effect">
                                                Simpan
                                            </button>
                                            <button type="button" class="btn bg-danger-subtle text-danger font-medium waves-effect" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                    </div>

                    {{-- Modal Edit --}}
                    <div class="modal fade" id="modal-edit-pendaftaran" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header d-flex align-items-center">
                                    <h4 class="modal-title" id="myModalLabel">
                                        Edit Pendaftaran
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('/admin/pendaftaran') }}" method="post" id="form-edit">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="tahun_angkatan">Tahun Angkatan : </label>
                                            <input type="number" class="form-control" name="etahun_angkatan" id="tahun_angkatan" required>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="gelombang">Gelombang Ke : </label>
                                            <input type="number" class="form-control" name="egelombang" id="gelombang" required min="1">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="kuota">Kuota Pendaftaran : </label>
                                            <input type="number" class="form-control" name="ekuota" id="kuota" required min="1">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="tutup">Status Pendaftaran : </label>
                                            <select class="form-control" name="tutup" id="tutup" required>
                                                <option value="0">Di Buka</option>
                                                <option value="1">Di Tutup</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn bg-success-subtle text-success font-medium waves-effect">
                                            Simpan
                                        </button>
                                        <button type="button" class="btn bg-danger-subtle text-danger font-medium waves-effect" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </form>
                            </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <div class="table-responsive mt-3">
                        <table id="zero_config" class="table border table-bordered text-nowrap align-middle">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th class="text-center">Thn Angkatan</th>
                                    <th class="text-center">Gelombang</th>
                                    <th class="text-center">Kuota</th>
                                    <th class="text-center">Total Pendaftar</th>
                                    <th class="text-center">Status</th>
                                    {{-- <th class="text-center">Tgl Dibuat</th> --}}
                                    <th class="text-center">Opsi</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                                @foreach ($data_pendaftaran as $pendaftaran)
                                    <!-- start row -->
                                    <tr class="text-center">
                                        <td>Tahun {{ $pendaftaran->tahun_angkatan }}</td>
                                        <td>Gelombang Ke-{{ $pendaftaran->gelombang }}</td>
                                        <td>{{ $pendaftaran->kuota }} Orang</td>
                                        <td>{{ $pendaftaran->detail_pendaftaran->count() }} Orang</td>
                                        <td>
                                            @if ($pendaftaran->tutup == 0)
                                                <span class="badge bg-success-subtle text-success fw-bold">Buka</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger fw-bold">Tutup</span>
                                            @endif
                                        </td>
                                        {{-- <td>{{ $pendaftaran->created_at }}</td> --}}
                                        <td>
                                            <a href="{{ url('/admin/pendaftaran') }}/{{ $pendaftaran->id }}" class="mb-1 badge font-medium bg-info-subtle text-info">Lihat</a>
                                            <a href="javascript:void(0);" class="mb-1 badge font-medium bg-success-subtle text-success edit" 
                                                data-url="{{ url('/admin/pendaftaran') }}/{{ $pendaftaran->id }}"
                                                data-tahun_angkatan="{{ $pendaftaran->tahun_angkatan }}"
                                                data-gelombang="{{ $pendaftaran->gelombang }}"
                                                data-kuota="{{ $pendaftaran->kuota }}"
                                                data-tutup="{{ $pendaftaran->tutup }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-edit-pendaftaran">
                                                Edit
                                            </a>
                                            <form action="{{ url('/admin/pendaftaran') }}/{{ $pendaftaran->id }}" method="post" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="mb-1 badge font-medium bg-danger-subtle text-danger hapus" style="outline: none; border: none;">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- end row -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          <!-- ---------------------
                end Zero Configuration
            ---------------- -->
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

        $('.edit').click(function () {
            $('input[name=etahun_angkatan]').val($(this).data('tahun_angkatan'));
            $('input[name=egelombang]').val($(this).data('gelombang'));
            $('input[name=ekuota]').val($(this).data('kuota'));
            $('select[name=tutup]').val($(this).data('tutup'));

            $('#form-edit').attr('action', $(this).data('url'));
        })
      </script>

@endsection