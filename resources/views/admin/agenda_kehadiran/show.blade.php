@extends('l-p-t.m-p')
@section('content')

    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Data Kehadiran</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/admin') }}">Master Data</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Data Kehadiran</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Jurusan --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        
                        {{-- filter siswa  --}}
                      <div class="row">
    <div class="col-md-6 my-3">
        <div class="p-3 ps-4 border-start border-4 border-primary bg-light rounded">
            <h6 class="text-secondary mb-1 fw-semibold">Agenda Kehadiran</h6>
            <h5 class="fw-bold text-dark mb-1">{{ $agenda->nama_agenda }}</h5>
            <small class="text-muted">
                <i class="bi bi-calendar3 me-1"></i>
                {{ format_tanggal_indo($agenda->tanggal) }}
            </small>
        </div>
    </div>
       <div class="input-group-append">
                                        <a href="" class="btn btn-success cetak-excel" target="_blank"><i class="ti ti-save-alt"></i> EXPORT EXCEL</a>
                                    </div>
</div>

                    </div>

                    <div class="table-responsive">
                        <table id="zero_config" class="table border table-bordered text-nowrap align-middle">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                    <th>No Regis</th>
                                    <th>Jam Datang</th>
                                   
                                </tr>
                                <!-- end row -->
                            </thead>
                          <tbody>
        @foreach ($datakehadiran as $dk)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dk->siswa->nama }}</td>
                <td>{{ $dk->siswa->jurusan }}</td>
                <td>{{ $dk->siswa->no_regis }}</td>
                <td>{{ \Carbon\Carbon::parse($dk->created_at)->format('H:i') }}
</td>
               
          
            </tr>


            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $dk->siswa->id }}" tabindex="-1" aria-labelledby="editLabel{{ $dk->siswa->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ url('/admin/siswa/' . $dk->siswa->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title" id="editLabel{{ $dk->siswa->id }}">Edit Data Siswa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $dk->siswa->nama }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jurusan</label>
                                    <input type="text" name="jurusan" class="form-control" value="{{ $dk->siswa->jurusan }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">No Registrasi</label>
                                    <input type="text" name="no_regis" class="form-control" value="{{ $dk->siswa->no_regis }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

      {!! session('pesan') !!}
      <script>
        $("#zero_config").DataTable();
            $('.cetak-excel').click(function (e) {
            e.preventDefault();
            var status = $('select[name=cetak]').val();
            var url = "{{ url('/admin/agendakehadiran/cetak') }}/{{ $agenda->id }}/";

            document.location.href = url;
        });

        $('.hapus').click(function (e) {
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