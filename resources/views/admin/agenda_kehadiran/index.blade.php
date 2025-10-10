@extends('l-p-t.m-p')
@section('content')
    {{-- Breadcrumb --}}
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Data Agenda Kehadiran</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ url('/admin') }}">Master Data</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Agenda Kehadiran</li>
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
                <h5 class="mb-0">Data Agenda Kehadiran</h5>
              </div>
               <button class="btn me-1 my-2 bg-primary-subtle text-primary px-4 fs-4 font-medium" data-bs-toggle="modal" data-bs-target="#modal-jurusan">
                Tambah Data
              </button>
       

         
                    <div class="table-responsive">
                        <table id="zero_config" class="table border table-bordered text-nowrap align-middle">
                    <thead>
                        <!-- start row -->
                        <tr>
                            <th>No</th>
                            <th>Agenda Kehadiran</th>
                            <th>Tanggal</th>
                            <th>Opsi</th>
                        </tr>
                        <!-- end row -->
                    </thead>
                        <tbody>
                            @foreach ($agendakehadiran as $agenda)
                                <!-- start row -->
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $agenda->nama_agenda }}</td>
                                    <td>
                                        {{ format_tanggal_indo($agenda->tanggal) }}

                                    </td>
                                    <td>
                                        <a href="{{ url('guru/agenda-kehadiran/'.$agenda->id.'/detail') }}" class="btn btn-primary btn-sm"><i class="fa fa-info"></i> Lihat Kehadiran </a>
                                             <a href="javascript:void(0);" class="mb-1 badge font-medium bg-success-subtle text-success edit" data-url="{{ url('/admin/agendakehadiran') }}/{{ $agenda->id }}" data-nama="{{ $agenda->nama_agenda }}" data-tanggal="{{ $agenda->tanggal }}"  data-bs-toggle="modal" data-bs-target="#modal-edit-jurusan">Edit</a>
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

      
              {{-- Modal Tambah --}}
              <div class="modal fade" id="modal-jurusan" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-flex align-items-center">
                                <h4 class="modal-title" id="myModalLabel">
                                    Tambah Agenda Kehadiran
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ url('/admin/agendakehadiran') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama_agenda">Nama Agenda Kehadiran : </label>
                                        <input type="text́" class="form-control" name="nama_agenda" id="nama_agenda" required>
                                      </div>
                                    <div class="form-group">
                                        <label for="tanggal">Nama Agenda Kehadiran : </label>
                                        <input type="date" class="form-control" name="tanggal" id="tanggal" required>
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
              <div class="modal fade" id="modal-edit-jurusan" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-flex align-items-center">
                                <h4 class="modal-title" id="myModalLabel">
                                    Edit Agenda Kehadiran
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ url('/admin/agendakehadiran') }}" method="post" id="form-jurusan">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="enama">Nama Agenda : </label>
                                        <input type="text́" class="form-control" name="nama_agenda" id="enama" required>
                                      </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Agenda : </label>
                                        <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                                      </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn bg-success-subtle text-success font-medium waves-effect">
                                        Edit
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

      {!! session('pesan') !!}
      <script>
        $("#zero_config").DataTable();
        $('.edit').click(function () {
            var nama = $(this).data('nama');
            var tanggal = $(this).data('tanggal');
            $('input[name=nama_agenda]').val(nama);
            $('input[name=tanggal]').val(tanggal);
            $('#form-jurusan').attr('action', $(this).data('url'));
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