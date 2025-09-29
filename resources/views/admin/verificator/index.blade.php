@extends('l-p-t.m-p')
@section('content')
    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Data Verificator</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/admin') }}">Master Data</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Verificator</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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

    {{-- Data Jurusan --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="mb-0">Data Verificator</h5>

                    </div>
                    <button class="btn me-1 my-2 btn-success px-4 fs-4 font-medium" data-bs-toggle="modal"
                        data-bs-target="#modal-tambah-guru">
                        <i class="ti ti-plus"></i> Tambah Data
                    </button>
                    <div class="table-responsive">
                        <table id="zero_config" class="table border table-bordered text-nowrap align-middle">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Start Char</th>
                                    <th>End Char</th>
                             

                                    <th>Opsi</th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>
                                @foreach ($data_verificator as $verificator)
                                    <!-- start row -->
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $verificator->guru->nama }}</td>
                                        <td>{{ $verificator->start_char }}</td>
                                        <td>{{ $verificator->end_char }}</td>
                                    

                                        <td>
                                            <!-- Tombol hapus -->
                                          <button type="button"
    class="mb-1 badge font-medium bg-danger-subtle text-danger border-0 shadow-none"
    style="outline: none;"
    data-bs-toggle="modal" 
    data-bs-target="#modalHapus{{ $verificator->id }}">
    Hapus
</button>


                                            <!-- Modal Konfirmasi -->
                                            <div class="modal fade" id="modalHapus{{ $verificator->id }}" tabindex="-1"
                                                aria-labelledby="modalHapusLabel{{ $verificator->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title"
                                                                id="modalHapusLabel{{ $verificator->id }}">Konfirmasi Hapus
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus verificator
                                                            <b>{{ $verificator->guru->nama }}</b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>

                                                            <form action="{{ url('/admin/delete_verificator/' . $verificator->id) }}"
                                                                method="post" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Ya,
                                                                    Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <!-- end row -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
      {{-- Modal Tambah --}}
  {{-- Modal Tambah --}}
<div class="modal fade" id="modal-tambah-guru" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myModalLabel">
                    Tambah Verificator
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/store_verificator') }}" method="post">
                @csrf
                <div class="modal-body">

                    {{-- Pilih Guru --}}
                    <div class="form-group my-3">
                        <label for="guru_id">Pilih Guru : </label>
                        <select class="form-control" name="guru_id" id="guru_id" required>
                            <option value="">-- Pilih Guru --</option>
                            @foreach($guru as $g)
                                <option value="{{ $g->id }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Start Char --}}
                    <div class="form-group my-3">
                        <label for="start_char">Start Char : </label>
                        <input type="text" class="form-control" name="start_char" id="start_char" maxlength="1" required>
                    </div>

                    {{-- End Char --}}
                    <div class="form-group my-3">
                        <label for="end_char">End Char : </label>
                        <input type="text" class="form-control" name="end_char" id="end_char" maxlength="1" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn bg-success-subtle text-success font-medium waves-effect">
                        Simpan
                    </button>
                    <button type="button" class="btn bg-danger-subtle text-danger font-medium waves-effect"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


    {!! session('pesan') !!}
    <script>
        $("#zero_config").DataTable();

        $('.hapus').click(function(e) {
            e.preventDefault();
            var tombol_ini = $(this);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
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
